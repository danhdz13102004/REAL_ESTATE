<?php

namespace App\Http\Controllers;

use App\Jobs\SendingEmailJob;
use App\Mail\VerificationMail;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use PhpParser\Node\Stmt\UseUse;

class AuthController extends Controller
{
    public function register() {
        return Inertia('Auth/Register');
    }
    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|confirmed'
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('validate',$validator->errors()->messages());
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        SendingEmailJob::dispatch($user);

        return redirect()->route('login_view')->with('success','Created successfully!');
    }

    public function login_view() {
        return Inertia('Auth/Login');
    }
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->with('validate',[
                'Email or password is incorrect!'
            ]);
        }

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session(['user' => Auth::user()]);
            $request->session()->put('user',Auth::user());
            // dd(Auth::user());
            return redirect()->route('listings.index')->with('success','Login sucessfully!');
        }
        return back()->with('validate',[
            'Email or password is incorrect!'
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login_view');
    }
}  
