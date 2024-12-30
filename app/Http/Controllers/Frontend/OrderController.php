<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Services\SslCommerzPaymentService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use \App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(OrderRequest $request, SslCommerzPaymentService $paymentService)
    {
        if (!Auth::check()) {
            throw new AuthenticationException();
        }
        $OrderData = $request->validated();

        $OrderData['order_code'] = 
        $paymentResponse = $paymentService->initiatePayment($OrderData);

        if (isset($paymentResponse['status']) && $paymentResponse['status'] == 'fail') {
            return response()->json(['message' => 'Payment initiation failed'], 400);
        }

		$response = json_decode($paymentResponse, true);
		return response()->json($response);
        // return Inertia::location(route('course.checkout', ['id' => $OrderData['course_id']]));

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
