<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class authController extends Controller
{

    function index() {
        return view('auth.index');
    }

    function redirect() {
        return Socialite::driver('google')->redirect();
    }

    function callback() {
        $user = Socialite::driver('google')->user();
        $id = $user->id;
        $email = $user->email;
        $name = $user->name;

        $cek = User::where('email', $email)->count();
        if ($cek > 0) {
            $user = User::UpdateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'google_id' => $id
                ]
                );
                Auth::login($user);
                return redirect()->to('dashboard')->with('success', 'Login Success');
        } else {
            return redirect()->to('auth')->with('error', 'Email not registered as Admin');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->to('auth');
    }
}
