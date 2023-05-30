<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlumniMem;
use App\Models\Payment;
use App\Models\User;
use App\Models\Admin_Notifications;
use App\Models\Client_Notifications;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\File;

class AlumniMemController extends Controller
{
    public function route_alumni_mem()
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        $payment = Payment::first();
        return view('main.alumni-membership',compact('payment','notificationsUnread'));
    }

    public function db_route_alumni_mem()
    {

        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();

        $amem = AlumniMem::all();
        
        // DAY
        $daily_membership = DB::table('alumni_mem')
        ->select(DB::raw('COUNT(*) as count, DATE(created_at) as day'))
        ->groupBy('day')
        ->get();
    
        $days = [];
        $day_counts = [];

        foreach ($daily_membership as $membership) {
            $days[] = date("F j, Y", strtotime($membership->day));
            $day_counts [] = $membership->count;
        }


        // WEEK
        $weekly_membership = DB::table('alumni_mem')
            ->select(DB::raw('COUNT(*) as count, DATE(DATE_FORMAT(created_at, "%Y-%m-%d") - INTERVAL DAYOFWEEK(created_at) - 1 DAY) as week_start_date'))
            ->groupBy('week_start_date')
            ->get();

        $weeks = [];
        $week_counts  = [];

        foreach ($weekly_membership as $membership) {
            $weeks[] = 'Week of '.date("F j, Y", strtotime($membership->week_start_date));
            $week_counts [] = $membership->count;
        }

        // MONTH
        $monthly_membership = DB::table('alumni_mem')
            ->select(DB::raw('COUNT(*) as count, DATE(DATE_FORMAT(created_at, "%Y-%m-01")) as month_start_date'))
            ->groupBy('month_start_date')
            ->get();

        $months = [];
        $month_counts  = [];

        foreach ($monthly_membership as $membership) {
            $months[] = date("F Y", strtotime($membership->month_start_date));
            $month_counts [] = $membership->count;
        }

        // YEAR
        $yearly_membership = DB::table('alumni_mem')
        ->select(DB::raw('COUNT(*) as count, YEAR(created_at) as year'))
        ->groupBy('year')
        ->get();

        $years = [];
        $year_counts = [];

        foreach ($yearly_membership as $membership) {
        $years[] = $membership->year;
        $year_counts[] = $membership->count;
        }

        return view ('dashboard.alumni-membership', compact('notificationsUnread','amem', 'day_counts', 'week_counts', 'month_counts','year_counts','days', 'weeks', 'months','years',));
        }

        // public function db_route_alumni_mem()
        // {   
        //     $amem = AlumniMem::all();
        
        //     // use dd() to see the contents of $alumni_id
        //     dd($amem);
            
        //     // rest of the code...
        // }

        public function post_alumni_mem(Request $request)
        {

            $this->validate($request, [
                'name' => 'required',
                'bday' => 'required',
                'con_num' => 'required|numeric',
                'address' => 'required',
                ], [
                'name.required' => 'Please enter your name.',
                'bday.required' => 'Please enter your birthday.',
                'con_num.required' => 'Please enter your contact no.',
                'con_num.numeric' => 'Please enter a number.',
                'address.required' => 'Please enter your address.',
                ]);

            $amem = $request->all();
            // Add the user_id to the form data
            $amem['user_id'] = $request->user()->id;
        
            if ($image = $request->file('signature')) {
                $destinationPath = 'images/alumni_mem/signature/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $amem['signature'] = "$profileImage";
            }
        
            // Determine the payment method selected by the client
            $pay_med = $request->input('pay_med');
        
            // Update the status of the alumni application based on the payment method
            if ($pay_med === 'Pay Cash') {
                $amem['status'] = 'In Progress';
            } else if ($pay_med === 'Pay G-Cash') {
                $amem['status'] = 'In Progress';
            }
        
            $alumniMem = AlumniMem::create($amem);

            // Update the user's alumni_mem_applied column to true
            $user = User::find($request->user()->id);
            $user->alumni_mem_applied = true;
            $user->save();


            // Create notification
            $admin_notification = new Admin_Notifications();
            $admin_notification->user_id = Auth::user()->id;
            $admin_notification->alumnimem_id = $alumniMem->id;
            $admin_notification->message = 'Applied for Alumni Membership';
            $admin_notification->save();
        
            Session::flash('success_reissuance','Succesful.');
            return redirect('/success-alumni-mem')->with('amem', $amem)->withInput();
        }
        
        public function notify_alumni_mem(Request $request)
        {
            $client_notification = new Client_Notifications();
            $client_notification->user_id = $request->input('user_id');
            $client_notification->message = 'Your Alumni Membership is Done';
            $client_notification->save();
            Session::flash('status','Notified Succesfully.');
            return redirect('/alumni-membership');
        }


    public function db_alumni_mem_ajaxview($id)
    {
        $amem = AlumniMem::find($id);
        $image_url = asset('images/alumni_mem/signature/' . $amem->signature);
        return response()->json([
            'status' => 200,
            'amem' => $amem,
            'image_url' => $image_url,
        ]);
    }
    

    public function db_delete_alumni_mem($id)
    {
        $delete_amem = AlumniMem::find($id);
        $destinationPath = 'images/alumni_mem/signature/'.$delete_amem->signature;
        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }
        $delete_amem -> delete();
        Session::flash('status','You`ve successfully deleted a membership!');
        return redirect('/alumni-membership')->with('delete_amem', $delete_amem); 
    }

    public function success_alumni_mem()
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        return view('main.success-alumni-mem',compact('notificationsUnread'));
    }

    public function confirmAmem($id)
    {
        $amem = AlumniMem::find($id);

        if ($amem) {
            $amem->status = 'Paid';
            $amem->save();

            return redirect()->back()->with('status', 'Alumni Membership confirmed successfully.');
        }

        return redirect()->back()->with('status', 'Alumni Membership not found.');
    }

    public function db_alumni_mem_ajaxedit($id)
    {
        $amem = AlumniMem::find($id);
        $image_url = asset('images/alumni_mem/signature/' . $amem->signature);
        return response()->json([
            'status' => 200,
            'amem' => $amem,
            'image_url' => $image_url,
        ]);
    }

    public function db_update_alumni_mem(Request $request)
    {
        $id = $request->input('mem_id');
        $amem = AlumniMem::find($id);
        $amem->name = $request->input('name');
        $amem->address = $request->input('address');
        $amem->bday = $request->input('bday');
        $amem->con_num = $request->input('con_num');
        $amem->fb = $request->input('fb');
        $amem->reference_no = $request->input('reference_no');
    
        if ($request->hasFile('signature')) {
            // Delete the old signature image if it exists
            $oldImage = $amem->signature;
            if (!empty($oldImage) && file_exists(public_path('images/alumni_mem/signature/'.$oldImage))) {
                unlink(public_path('images/alumni_mem/signature/'.$oldImage));
            }
    
            // Save the new signature image
            $image = $request->file('signature');
            $destinationPath = 'images/alumni_mem/signature/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $amem->signature = $profileImage;
        }
    
        $amem->save();
    
        Session::flash('status','Succesfully Edited.');
        return redirect('/alumni-membership')->with('amem', $amem)->withInput();
    }
}
