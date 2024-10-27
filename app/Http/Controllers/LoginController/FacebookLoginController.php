<?php

namespace App\Http\Controllers\LoginController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function redirect() {
        // dd('heeh');
        return Socialite::driver('facebook')->redirect();
    }   

    public function callback() {
        // dd('oke');
        $user = Socialite::driver('facebook')->user();
        dd($user);
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
                'google_id' => $user->id
            ]);
            // dd($new_user);
            Auth::login($new_user);
            return redirect()->route('index')->with('success','Login succesfully');
        }
    }
}
