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
        Stripe::setApiKey(env('SECRET_STRIPE'));
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
