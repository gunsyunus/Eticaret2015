<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\SiteController;
use App\Models\SocialAccount;
use App\Models\User;
use App\Models\Customer;
use Socialite;
use Redirect;
use Auth;

class SocialAccountController extends SiteController
{
    /**
     * Connect to social network: Facebook.
     *
     * @return Response
     */
    public function connect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Social provider callback.
     *
     * @return Response
     */
    public function callback()
    {
        $providerUser = Socialite::driver('facebook')->fields(['first_name','last_name','email'])->user();

        if (empty($providerUser->getEmail())) {
            return Redirect::action('Site\CustomerController@index')->with('SOCIALERROR', '1');
        }

        $account = SocialAccount::with('user')->where('provider', '=', 'facebook')
                                              ->where('provider_user_id', '=', $providerUser->getId())
                                              ->first();
        
        if ($account) {
            $user = $account->user;
        } else {
            $user = new User;
            $customer = new Customer;

            $user->name = $providerUser->user['first_name'];
            $user->surname = $providerUser->user['last_name'];
            $user->email = $providerUser->getEmail();
            $user->password = str_random(8);
            $user->role = 2;

            $customer->newsletter_status = 1;
            $user->save();

            if ($user->save()) {
                $customer->user_id = $user->id_user;
                $customer->save();

                $account = new SocialAccount;
                $account->provider = 'facebook';
                $account->provider_user_id = $providerUser->getId();
                $account->user_id = $user->id_user;
                $account->save();
            }
        }

        Auth::login($user);
                
        return redirect('/');
    }
}
