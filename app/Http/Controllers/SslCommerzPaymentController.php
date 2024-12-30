<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Request as PaymentRequest;

class SslCommerzPaymentController extends Controller
{
    public function index(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = $request->grand_total;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid();

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = Auth::user()->name;
        $post_data['cus_email'] = Auth::user()->email;
        $post_data['cus_add1'] = count(Auth::user()->addresses) > 0 ? Auth::user()->addresses[0] : 'N-A';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = Auth::user()->phone;
        ;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_order = Order::query()
            ->create([
                'sub_total' => $request->sub_total,
                'grand_total' => $request->grand_total,
                'payment_method' => "SSL Commerz",
                'user_id' => Auth::id(),
                'address_id' => $request->address_id,
                'transcaction_id' => $post_data['tran_id'],
                'order_date' => Carbon::now('Asia/Dhaka'), // Set order date to Bangladesh time
                'delivery_type_id' => Carbon::now('Asia/Dhaka')->hour < 11 ? 2 : 1, // Set delivery_type_id based on BD time
            ]);

        $orderDetails = [];
        foreach ($request->orders as $key => $item) {
            $orderDetails[] = [
                'order_id' => $update_order->id,
                'product_id' => $item['id'],
                'quantity' => $item["buyQty"] ?? 1,
            ];
            $product = Product::query()->find($item['id']);
            $product->visited = $product->visited + 1;
            $product->save();
        }
        $update_order->orderdetails()->createMany($orderDetails);
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        $res = json_decode($payment_options);
        if ($res->status == 'fail') {
            return $res;
        } else {
            return $res;
        }
    }



    public function success(Request $request)
    {
        // Retrieve the transaction ID, amount, and currency from the request
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        // Create SSLCommerzNotification instance
        $sslc = new SslCommerzNotification();

        // Validate the payment with SSLCommerz
        $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

        if ($validation) {
            // Fetch the order using the transaction ID (ensure the field is correct in your DB)
            $order = Order::where('order_code', $tran_id)->first();  // Assuming 'order_code' is used as the transaction ID

            if ($order) {
                // Start database transaction
                \DB::beginTransaction();

                try {
                    // Update the order's payment status to 'paid'
                    $order->update([
                        'payment_status' => 'paid',
                        'order_status' => 'confirmed' // Optional: set order status to confirmed when payment is successful
                    ]);

                    // Add course to the pivot table (student_courses)
                    $student = Auth::user(); // Get the authenticated student
                    $student->courses()->syncWithoutDetaching([$order->course_id]); // Add the course without detaching other courses

                    // Commit the transaction
                    \DB::commit();

                    // Redirect the user to a success page with the transaction ID
                    return redirect()->to(env('FRONTEND_URL') . "/payment/success?trx_id=$order->order_code");
                } catch (\Exception $e) {
                    // If any error occurs, rollback the transaction
                    \DB::rollBack();

                    // Return error response
                    return response()->json([
                        "status" => 500,
                        "message" => "Error occurred while processing the payment and updating the course data.",
                        "error" => $e->getMessage()
                    ], 500);
                }
            }
        }

        // If validation fails, return a failure message
        return response()->json([
            "status" => 500,
            'message' => "Order Complete, Payment Not Successful...!"
        ], 500);
    }



    public function fail()
    {
        return response()->json('Failed');
        $trx = Transaction::query()->with('course:id')
            ->where('trx', Request::input('tran_id'))
            ->first();
        if ($trx) {
            $trx->delete();
            $trx->order->delete();
            $trx->order->orderDetails->delete();
        }
        return redirect()->to(env('FRONTEND_URL') . "/payment/failed");
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $update_order = DB::table('orders')
            ->where('transcaction_id', $tran_id)
            ->update(['payment_status' => 'cancelled']);

        return redirect()->to(env('FRONTEND_URL') . "/payment/failed");

    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
