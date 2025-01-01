<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentService
{
    public function initiatePayment(array $data)
    {
        $post_data = [
            'total_amount' => $data['totals_amount'],
            'currency' => "BDT",
            'tran_id' => uniqid(),
            // Customer Information
            'cus_name' => Auth::user()->name,
            'cus_email' => Auth::user()->email,
            'cus_add1' => $data['address'] ?? 'N/A',
            'cus_country' => "Bangladesh",
            'cus_phone' => '35467890',
            // Shipment Information
            'shipping_method' => 'NO',
            'ship_name' => "Store Test",
            'ship_add1' => "Dhaka",
            'ship_city' => "Dhaka",
            'ship_postcode' => "1000",
            'ship_country' => "Bangladesh",
            // Product Profile
            'product_name' => $data['product_name'] ?? 'Unknown',
            'product_category' => "Goods",
            'product_profile' => "physical-goods",
            // Optional
            'value_a' => "ref001",
            'value_b' => "ref002",
        ];

        // Create Order with Pending status
        $order = Order::create([
            'order_code' => 'ORD-' . strtoupper(Str::random(8)) . '-' . now()->format('YmdHis'),
            'totals_amount' => $data['totals_amount'],
            'course_id' => $data['course_id'],
            'payment_method' => "SSL Commerz",
            'student_id' => Auth::id(),
            'payment_status' => 'pending',
            'transaction_id' => $post_data['tran_id'],
            'order_date' => Carbon::now('Asia/Dhaka'),
            'delivery_type_id' => Carbon::now('Asia/Dhaka')->hour < 11 ? 2 : 1,
        ]);

        // Attach the course to the student in the pivot table and include student_id explicitly
        Auth::user()->courses()->attach($data['course_id'], [
            'student_id' => Auth::id(), // explicitly add student_id in pivot
            'created_at' => now(), // optional: set the created_at timestamp for the pivot
        ]);
        // Initiate SSLCommerz Payment
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        return $payment_options;
    }
}



