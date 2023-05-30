<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Admin_Notifications;
use Session;
use Mail;
use DB;

class AnnouncementController extends Controller
{

    public function route_announcement()
    {
        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();
        $announce = Announcement::all();
        return view('dashboard.announcement',compact('notificationsUnread','announce')); 
    }


    public function post_announcement(Request $request)
    {
        $data = [
            'subject' => $request->subject,
            'description' => $request->description,
            'date' => $request->date,
          ];

          $announce = new Announcement;
          $announce->subject = $data['subject'];
          $announce->description = $data['description'];
          $announce->date = $data['date'];
          $announce->save();

            // Get all email addresses from the users table
            $emails = DB::table('users')->pluck('email')->toArray();

            Mail::send('dashboard.email-template', ['data' => $data], function($message) use ($data, $emails) {
                // Send email to all email addresses
                $message->to($emails);
                $message->subject($data['subject']);
            });

        Session::flash('status','You`ve successfully added a announcement!');
        return redirect('/announcement')->with('announce', $announce); 

          
    }



    public function delete_announcement($id)
    {
        $delete_annnouncement = Announcement::find($id);
        $delete_annnouncement -> delete();
        Session::flash('status','You`ve successfully deleted a Announcement!');
        return redirect('/announcement')->with('delete_annnouncement', $delete_annnouncement); 
    }

    public function update_announcement(Request $request)
    {

        $data = [
            'subject' => $request->subject,
            'description' => $request->description,
            'date' => $request->date,
          ];

        $id = $request->input('aid');
        $announce = Announcement::find($id);
        if (!$announce) {
            return response()->json(['error' => 'Announcement not found'], 404);
        }
        $announce->subject = $request->input('subject');
        $announce->description = $request->input('description');
        $announce->date = $request->input('date');
        $announce->update();

        // Get all email addresses from the users table
        $emails = DB::table('signin')->pluck('email')->toArray();

        Mail::send('dashboard.email-template', ['data' => $data], function($message) use ($data, $emails) {
            // Send email to all email addresses
            $message->to($emails);
            $message->subject($data['subject']);
        });

        Session::flash('status', 'You have successfully edited an announcement!');
        return redirect('/announcement')->with('announce', $announce);
    }
    

    public function db_announcement_ajaxview($id)
    {
        $announce = Announcement::find($id);
        return response()->json([
            'status' => 200,
            'announce' => $announce,
        ]);
    }

    public function db_announcement_ajaxedit($id)
    {
        $announce = Announcement::find($id);
        return response()->json([
            'status' => 200,
            'announce' => $announce,
        ]);
    }


}
