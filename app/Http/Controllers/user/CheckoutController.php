<?php

namespace App\Http\Controllers\User;

use App\Models\CheckoutModel;
use Illuminate\Http\Request;

class CheckoutController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipment_locations = ["NB" => "Nairobi", "MB" => "Mombasa", "NK" => "Nakuru", "UG" => "UasinGishu", "ND" => "Nandi", "BG" => "Bungoma", "KS" => "Kisumu", "VH" => "Vihiga", "KK" => "Kakamega"];
        return view("user.cart.checkout", ["shipment_locations" => $shipment_locations]);
    }
    private function auth_token()
    {
        $consumerKey = env('SAFARICOM_CONSUMER_KEY');
        $consumerSecret = env('SAFARICOM_CONSUMER_SECRET');
        $credentials = base64_encode($consumerKey . ':' . $consumerSecret);

        $guzzle = new \GuzzleHttp\Client();
        $response = $guzzle->request('GET', 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials', [
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type' => 'application/json',
            ],
        ]);
        $result = json_decode($response->getBody());
        return $result->access_token;
    }

    private function initiate_payment(string $amount, string $phone_number)
    {
        $access_token = $this->auth_token();
        $timestamp = date('YmdHis');
        $shortcode = env('SAFARICOM_SHORTCODE');
        $passkey = env('SAFARICOM_PASSKEY');
        $password = base64_encode($shortcode . $passkey . $timestamp);

        $guzzle = new \GuzzleHttp\Client();
        $response = $guzzle->request('POST', 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'BusinessShortCode' => $shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone_number,
                'PartyB' => $shortcode,
                'PhoneNumber' => $phone_number,
                'CallBackURL' => route('checkout.callback'),
                'AccountReference' => 'YourAccountReference',
                'TransactionDesc' => 'Payment for goods',
            ],
        ]);
        return json_decode($response->getBody());
    }
    private function handle_callback(Request $request)
    {
        $data = $request->all();
        $this->callback($data);
        return response()->json(['status' => 'success']);
    }
    function callback($data)
    {
        // Handle the callback data here
        // You can log it, store it in the database, or perform any other necessary actions
        \Log::info('MPESA Callback Data: ', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckoutModel $checkoutModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CheckoutModel $checkoutModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckoutModel $checkoutModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckoutModel $checkoutModel)
    {
        //
    }
}
