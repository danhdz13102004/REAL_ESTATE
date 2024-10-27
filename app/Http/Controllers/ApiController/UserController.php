<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user) {
        return $user->listings()->get();
        // return $user;
    }

    public function user_login() {
        // dd(Auth::user());
        dd(session('user'));
        return Auth::user();
    }
}
