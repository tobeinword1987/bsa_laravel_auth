<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Overtrue\Socialite\SocialiteManager;
use Overtrue\LaravelSocialite\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider(Request $request)
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {

            //find social user
            $socialuser = Socialite::driver('github')->user();

            //find in DB
            $user=User::where(['email' => $socialuser->email])->first();

            //create if is not exist

            if (is_null($user))
            {
                $user=User::create(
                    [
                        'firstname' => $socialuser->login,
                        'email' => $socialuser->email,
                        'password' => bcrypt($socialuser->password)
                    ]
                );
            }
        Auth::login($user);

        return redirect('/home');
    }
}