<?php


namespace App\Services;

use App\Models\Order;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentService
{
    public function initiatePayment(array $data)
    {
        // Fetch the credentials from the environment file
        $store_id = env('SSLCZ_STORE_ID');
        $store_password = env('SSLCZ_STORE_PASSWORD');

        // Prepare post data for SSLCommerz API
        $post_data = [
            'total_amount' => "100",
            'currency' => "BDT",
            'tran_id' => uniqid(), // Unique transaction ID

            // Customer Information
            'cus_name' => "Tarek",
            'cus_email' => "tarek@gmail.com",
            'cus_add1' => "Dhaka",
            'cus_country' => "Bangladesh",
            'cus_phone' => "018000000", // Ensure valid phone number is used

            // Shipment Information
            'shipping_method' => 'NO',
            'ship_name' => "Store Test",
            'ship_add1' => "Dhaka",
            'ship_city' => "Dhaka",
            'ship_postcode' => "1000",
            'ship_country' => "Bangladesh",

            // Product Profile
            'product_name' => "SSLProduct",
            'product_category' => "Goods",
            'product_profile' => "physical-goods",

            // Optional Fields
            'value_a' => "ref001",
            'value_b' => "ref002",

            // SSLCommerz Credentials
            'store_id' => $store_id,
            'store_passwd' => $store_password,
        ];

        // Begin a transaction
        \DB::beginTransaction();

        try {
            // Create Order with Pending status in the database
            $order = Order::create([
                'course_id' => $data['course_id'],
                'student_id' => Auth::id(),
                'totals_amount' => $data['totals_amount'],
                'payment_method' => $data['payment_method'],
                'order_status' => 'pending',  // Pending status initially
                'payment_status' => 'pending',  // Pending payment status
                'order_code' => $data['order_code'],
            ]);

            // Add course to pivot table (student-course relationship)
            $student = Auth::user(); // Get the authenticated student
            $student->courses()->syncWithoutDetaching([$data['course_id']]);

            // Initiate SSLCommerz Payment
            $sslc = new SslCommerzNotification();
            $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

            \DB::commit(); // Commit transaction

            return $payment_options;
        } catch (\Exception $e) {
            \DB::rollBack(); // Rollback transaction on failure

            throw new \Exception("An error occurred during payment initiation: " . $e->getMessage());
        }
    }
}



