<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function pay()
    {
        return view('pay');
    }

    public function payment(Request $request)
    {
        // Creates a new instance of Razorpay's API using your Razorpay test key and secret, which are stored in config/services.php
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        // After this, $api gives you access to Razorpay's features (like orders, payments, refunds, etc.)
        
        // This accesses the order module of Razorpay.
        $order = $api->order->create([
            'receipt' => '123',
            'amount' => 100 * 100, // ₹100 in paise
            'currency' => 'INR'
        ]);
        //$order will return object with detail like amount, datetime, amount paid,....etc

        return view('payment-page', [
            'order_id' => $order['id'],
            'amount' => 100
        ]);
    }

public function verifyPayment(Request $request)
{
    $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

    try {
        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        // The signature is like a digital seal or a tamper-proof stamp Razorpay gives after payment to prove: that payment is real and untampered. So, Razorpay gives you the verifyPaymentSignature() function — it checks if that seal (signature) is valid.



        // ✅ Verify payment signature
        $api->utility->verifyPaymentSignature($attributes);

        // ✅ Fetch full payment details using Razorpay payment ID
        $payment = $api->payment->fetch($request->razorpay_payment_id);

        // You can log or store this payment in DB if needed

        return view('payment-result', [
            'success' => true,
            'payment_id' => $payment->id,
            'amount' => $payment->amount / 100,
            'currency' => $payment->currency,
            'email' => $payment->email,
            'contact' => $payment->contact,
            'name' => $payment->method === 'card' ? $payment->card['name'] ?? '' : '',
            'method' => $payment->method,
            'created_at' => date('d M Y, h:i A', $payment->created_at),
            'receiver' => 'Your Business Name' // hardcoded or dynamic from Razorpay dashboard
        ]);

    } catch (\Exception $e) {
        return view('payment-result', ['success' => false, 'error' => $e->getMessage()]);
    }
}


     public function paymentResult()
    {
        return view('payment-result');
    }
}
