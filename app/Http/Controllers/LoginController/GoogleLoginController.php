<?php

namespace App\Http\Controllers\LoginController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirect() {
        // dd('heeh');
        return Socialite::driver('google')->redirect();
    }   

    public function callback() {
        // dd('oke');
        $user = Socialite::driver('google')->user();
        // dd($user);
        $user_real = User::where('google_id',$user->id)->first();
        if($user_real != null) {
            Auth::login($user_real);
            return redirect()->route('index')->with('success','Login succesfully');;
        }
        else {
            $new_user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt('123'),
                'google_id' => $user->id,
                'email_verified_at' => now()
            ]);
            $new_user->email_verified_at = now();
            $new_user->save();
            // dd($new_user);
            Auth::login($new_user);
            return redirect()->route('index')->with('success','Login succesfully');
        }
    }
}
