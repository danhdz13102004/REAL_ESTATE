<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Notification;

class NotificationController extends Controller
{

    public function index() {
        return Inertia('Notification/Index',[
            'notifications' => Auth::user()->notifications()->latest()->paginate(5)
        ]);
    }

    public function update($notification) {
       $notify =  Auth::user()->notifications()->find($notification);
       $notify->markAsRead();
    //    dd($notify->data);
       return redirect()->route('listings.offer.index',$notify->data['listing_id']);
    }

    public function markAll() {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('notification.index')->with('success','Mark all as read successfully!');
    }
}
