<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Stripe\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    //
    public function stripePost(Request $request) {
        try {
            $stripe = new \Stripe\StripeClient(
                'sk_test_51M6wWDAU8713blMt5MED9qpZIVjltjmArfW3DhwNZVaDWL6i8jrgt1qISpI0jsoU2CxpRp9wboIJ0mbekXDcqbdm00czlG8snv'
              );
            $res =  $stripe->tokens->create([
                'card' => [
                  'number' => $request->card_number,
                  'exp_month' =>$request->month,
                  'exp_year' => $request->year,
                  'cvc' => $request->cvc,
                ],
              ]);
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $uid = Auth::id();
            $user = User::findOrFail($uid);
            $kq = $stripe->charges->create([
                'amount' => '500',
                'currency' => 'usd',
                'source' =>$res->id,
                'description' => $user->name,
            ]);
            
            if(empty($user->vip_expried)) {
              $now = Carbon::now();
              $expried = $now->addDays(30);
            } else {
              $now = new Carbon($user->vip_expried);
              $expried = $now->addDays(30);
            }
            $user->update(['vip' => 1,'vip_expried' => $expried]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    } 
}
