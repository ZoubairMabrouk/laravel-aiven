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
        Stripe::setApiKey('sk_test_51QGHbXAr6uUDgl43agmclY2f0R4ngyI2WKwsxVUJxHqvZ1f9LMCME8PlRyFXUs5revKxF69bvVHMX9Hozo7SVIuC00TMa3sH0k');
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
