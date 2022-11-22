<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Exception;
use Illuminate\Http\Request;

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
                  'number' => '4242424242424242',
                  'exp_month' => 11,
                  'exp_year' => 2023,
                  'cvc' => '314',
                ],
              ]);
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $kq = $stripe->charges->create([
                'amount' => '555',
                'currency' => 'usd',
                'source' =>$res->id,
                'description' => 'hahaha'
            ]);
            return $kq;
        } catch (Exception $e) {
            return "false";
        }
    } 
}
