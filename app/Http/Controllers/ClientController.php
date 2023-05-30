<?php

namespace App\Http\Controllers;
use App\Models\Announcement;
use App\Models\Client_Notifications;
use Auth;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function route_home(Request $request)
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        $announce = Announcement::all();
        return view('main.home',compact('notificationsUnread','announce')); 
    }

    public function clientlogout()
    {
     Auth::logout();
     return redirect('/student_login');
    }
}
