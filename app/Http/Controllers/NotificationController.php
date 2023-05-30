<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin_Notifications;
use App\Models\Client_Notifications;
use Auth;

class NotificationController extends Controller
{

    public function user_notification()
    {
        $user_id = Auth::id();
    
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
    
        $notification = Client_Notifications::with(['user'])
            ->where('user_id', $user_id)
            ->get();
    
        return view('main.notifications', compact('notification', 'notificationsUnread'));
    }
    

    public function db_notification()
    {

        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();
        $notification = Admin_Notifications::with(['alumniid', 'alumnimem','reissueance','user'])
        ->get();
        return view ('dashboard.notification',compact('notification','notificationsUnread'));
    }

    public function markNotificationAsRead_admin($id)
    {
        $notification = Admin_Notifications::findOrFail($id);
        $notification->read_at = now();
        $notification->save();

        return redirect('/admin_notification')->with('status', 'Notification marked as read.');
    }

    public function deleteNotification_admin($id)
    {
        $notification = Admin_Notifications::findOrFail($id);
        $notification->status = 'Notification has been deleted';
        $notification->delete();

        return redirect('/admin_notification')->with('status', 'Notification has been deleted.');
    }

    public function markNotificationAsRead_user($id)
    {
        $notification = Client_Notifications::findOrFail($id);
        $notification->read_at = now();
        $notification->save();

        return redirect('/my_notification')->with('status', 'Notification marked as read.');
    }

    public function deleteNotification_user($id)
    {
        $notification = Client_Notifications::findOrFail($id);
        $notification->status = 'Notification has been deleted';
        $notification->delete();

        return redirect('/my_notification')->with('status', 'Notification has been deleted.');
    }



}
