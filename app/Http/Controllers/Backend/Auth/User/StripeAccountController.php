<?php

namespace App\Http\Controllers\Backend\Auth\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StripeAccount;
use App\Models\Auth\User;
use Illuminate\Support\Facades\URL;

class StripeAccountController extends Controller
{
    //
    //

    public function index()
    {
        // Set your secret key. Remember to switch to your live secret key in production!
        // // See your keys here: https://dashboard.stripe.com/account/apikeys
         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
         $stripe_id = User::where('id',2)->get()[0]->stripe_id;
         $retrieved_account = \Stripe\Account::retrieve(
            $stripe_id,
            []
        );

       if (! $retrieved_account->details_submitted){
         $account_links = \Stripe\AccountLink::create([
           'account' => $stripe_id,
           'refresh_url' => URL::current(),
           'return_url' => URL::current(),
           'type' => 'account_onboarding',
        ]);
         return redirect($account_links->url);
       }
         return view('backend.account.stripe', ['stripeaccount' => $retrieved_account]);
        /*
        $logged_in_user = auth()->id();
        $num_linked = StripeAccount::where('user_id', $logged_in_user)->count();
        if ($num_linked == 0) 
        {
            // Set to dot env file
            \Stripe\Stripe::setApiKey('');

            $account = \Stripe\Account::create([
                //TO-DO, Add Country
                    'type' => 'express',
                ]);
            $new_link = new StripeAccount;
            $new_link->user_id = $logged_in_user;
            $new_link->stripe_id = $account->id;
            $new_link->save();
            return redirect('user/stripeaccount');
        }

        else
        {
            $linked_account = StripeAccount::where('user_id', $logged_in_user)->get()[0];
            //return view('backend.account.index');
            return "test";
        }
         */
    }
}
