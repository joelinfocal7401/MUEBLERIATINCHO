<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
      /** Redirige a Google.  */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /*** Callback de Google. */
    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'nombre'        => $googleUser->user['given_name'] ?? '',
                    'apellido'      => $googleUser->user['family_name'] ?? '',
                    'email'         => $googleUser->getEmail(),
                    'google_id'     => $googleUser->getId(),
                    'provider'      => 'google',
                    'avatar_google' => $googleUser->getAvatar(),
                    'rol'           => 'cliente',
                    'estado'        => true,
                    'password'      => bcrypt(uniqid()),
                ]);
            } else {

                $user->update([
                    'google_id'     => $googleUser->getId(),
                    'provider'      => 'google',
                    'avatar_google' => $googleUser->getAvatar(),
                ]);
            }

            Auth::login($user);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {

            return redirect()->route('login')
                ->with('error', 'Error al iniciar sesión con Google.');
        }
    }  
}
