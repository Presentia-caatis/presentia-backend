<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * This function will be redirect to google
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * This function will authenticate the user through the google account
     * @return void
     */
    public function googleAuthentication()
    {

        try {
        $googleUser = Socialite::driver('google')->user();


            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Redirect ke frontend dengan status "new_user"
                return redirect(env('APP_URL') . '/login?status=new_user&name=' . urlencode($googleUser->name) . '&email=' . urlencode($googleUser->email));
            }

            // Jika user sudah ada, buat token dan redirect ke dashboard
            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect(env('APP_URL') . '/login?status=existing_user&token=' . $token);
        } catch (\Exception $e) {
            return redirect(env('APP_URL') . '/login?status=error&message=' . urlencode('Authentication failed.'));
        }
    }
}
