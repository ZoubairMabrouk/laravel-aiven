<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;
class StripeController extends Controller
{
    public function processpayment(Request $request)
    {
        Stripe::setApiKey('pk_test_51QGHbXAr6uUDgl43kfsSNH6vNilg84TkMnJrsCJuHAf0C0qcK8siHBMQ9XZ0LKCxdOFZMBX5rwK0QryjjxgiikPa00AktwsgzP');
        try {
            $charge = Charge::create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'description' => 'Paiement via Stripe', // Description facultative
                'source' => $request->token,
            ]);
            // Le paiement a réussi
            return response()->json(['message' => 'Paid Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
