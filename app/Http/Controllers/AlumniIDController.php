<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlumniID;
use App\Models\User;
use App\Models\Payment;
use App\Models\Admin_Notifications;
use App\Models\Client_Notifications;
use Session;
use DB;
use Auth;
use Illuminate\Support\Facades\File;

class AlumniIDController extends Controller
{
    public function db_route_alumni_id()
    {   

        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();
        $alumni_id = AlumniID::all();
        
        // DAY
        $daily_alumni_id = DB::table('alumni_id')
        ->select(DB::raw('COUNT(*) as count, DATE(created_at) as day'))
        ->groupBy('day')
        ->get();

        $days = [];
        $day_counts = [];

        foreach ($daily_alumni_id as $aid) {
            $days[] = date("F j, Y", strtotime($aid->day));
            $day_counts [] = $aid->count;
        }


        // WEEK
        $weekly_alumni_id = DB::table('alumni_id')
            ->select(DB::raw('COUNT(*) as count, DATE(DATE_FORMAT(created_at, "%Y-%m-%d") - INTERVAL DAYOFWEEK(created_at) - 1 DAY) as week_start_date'))
            ->groupBy('week_start_date')
            ->get();

        $weeks = [];
        $week_counts  = [];

        foreach ($weekly_alumni_id as $aid) {
            $weeks[] = 'Week of '.date("F j, Y", strtotime($aid->week_start_date));
            $week_counts [] = $aid->count;
        }

        // MONTH
        $monthly_alumni_id = DB::table('alumni_id')
            ->select(DB::raw('COUNT(*) as count, DATE(DATE_FORMAT(created_at, "%Y-%m-01")) as month_start_date'))
            ->groupBy('month_start_date')
            ->get();

        $months = [];
        $month_counts  = [];

        foreach ($monthly_alumni_id as $aid) {
            $months[] = date("F Y", strtotime($aid->month_start_date));
            $month_counts [] = $aid->count;
        }

        // YEAR
        $yearly_alumni_id = DB::table('alumni_id')
        ->select(DB::raw('COUNT(*) as count, YEAR(created_at) as year'))
        ->groupBy('year')
        ->get();

        $years = [];
        $year_counts = [];

        foreach ($yearly_alumni_id as $aid) {
        $years[] = $aid->year;
        $year_counts[] = $aid->count;
        }

        return view ('dashboard.alumni-id', compact('notificationsUnread','alumni_id', 'day_counts', 'week_counts', 'month_counts','year_counts','days', 'weeks', 'months','years',));
        }


    public function route_alumni_id()
    {
       
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        $payment = Payment::first();
        return view('main.alumni-id',compact('payment','notificationsUnread'));
    }

    public function post_alumni_id(Request $request)
    {

        $this->validate($request, [
            'id_no' => 'required',
            'name' => 'required',
            'bday' => 'required',
            'course' => 'required',
            'address' => 'required',
            'signature' => 'required|image|max:1024'
            ], [
            'id_no.required' => 'Please enter your ID no.',
            'name.required' => 'Please enter your name.',
            'bday.required' => 'Please enter your birthday.',
            'course.required' => 'Please enter your course.',
            'address.required' => 'Please enter your address.',
            'signature.required' => '(Please select signature.)',
            'signature.image' => '(Please select an image.)',
            'signature.max' => '(File size must be less than 1 MB).'
            ]);
          
            
        $aid = $request->all();

        // Add the user_id to the form data
        $aid['user_id'] = $request->user()->id;
    
        // Get the selected year from the form data
        $year = $aid['id_no'];
    
        // Get the number of existing alumni IDs for the selected year
        $count = AlumniID::where('id_no', $year)->count();
    
        // Generate the next alumni ID for the selected year
        if ($count == 0) {
            // If there are no existing alumni IDs for the selected year, set the count to 1
            $count = 1;
        } else {
            // Otherwise, get the latest alumni ID for the selected year and increment the count by 1
            $latest_alumni_id = AlumniID::where('id_no', $year)->latest()->first();
            $count = intval(substr($latest_alumni_id->a_no, -4)) + 1;
        }
    
        // Generate the next alumni ID based on the year and count
        $alumni_id = $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    
        // Add the generated alumni ID to the form data
        $aid['a_no'] = $alumni_id;
    
        if ($image = $request->file('signature')) {
            $destinationPath = 'images/alumni_id/signature/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $aid['signature'] = "$profileImage";
        }


        // Determine the payment method selected by the client
        $pay_med = $request->input('pay_med');

        // Update the status of the alumni application based on the payment method
        if ($pay_med === 'Pay Cash') {
            $aid['status'] = 'In Progress';
        } else if ($pay_med === 'Pay G-Cash') {
            $aid['status'] = 'In Progress';
        }


        $alumniID = AlumniID::create($aid);

        // Update the user's alumni_id_applied column to true
        $user = User::find($request->user()->id);
        $user->alumni_id_applied = true;
        $user->save();

        $admin_notification = new Admin_Notifications();
        $admin_notification->user_id = Auth::user()->id;
        $admin_notification->alumniid_id = $alumniID->id;
        $admin_notification->message = 'Applied for Alumni ID';
        $admin_notification->save();
        
        Session::flash('success_reissuance','Succesful.');
        return redirect('/success-alumni-id')->with('aid', $aid)->withInput();
    }

    public function notify_alumni_id(Request $request)
    {
        $client_notification = new Client_Notifications();
        $client_notification->user_id = $request->input('user_id');
        $client_notification->message = 'Your Alumni ID is Ready';
        $client_notification->save();
        Session::flash('status','Notified Succesfully.');
        return redirect('/alumni-id');
    }

    
    

    public function db_alumni_id_ajaxview($id)
    {
        $alumni_id = AlumniID::find($id);
        $image_url = asset('images/alumni_id/signature/' . $alumni_id->signature);
        return response()->json([
            'status' => 200,
            'alumni_id' => $alumni_id,
            'image_url' => $image_url,
        ]);
    }
    

    public function db_delete_alumni_id($id)
    {
        $delete_alumni_id = AlumniID::find($id);
        $destinationPath = 'images/alumni_id/signature/'.$delete_alumni_id->signature;
        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }
        $delete_alumni_id -> delete();
        Session::flash('status','You`ve successfully deleted an ID!');
        return redirect('/alumni-id')->with('delete_alumni_id', $delete_alumni_id); 
    }

    public function success_alumni_id()
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        return view('main.success-alumni-id',compact('notificationsUnread'));
    }

    public function confirmAid($id)
    {
        $aid = AlumniID::find($id);

        if ($aid) {
            $aid->status = 'Paid';
            $aid->save();

            return redirect()->back()->with('status', 'Alumni ID confirmed successfully.');
        }

        return redirect()->back()->with('status', 'Alumni ID not found.');
    }

    public function db_alumni_id_ajaxedit($id)
    {
        $alumni_id = AlumniID::find($id);
        $image_url = asset('images/alumni_id/signature/' . $alumni_id->signature);
        return response()->json([
            'status' => 200,
            'alumni_id' => $alumni_id,
            'image_url' => $image_url,
        ]);
    }

    public function db_update_alumni_id(Request $request)
    {
        $id = $request->input('aid_id');
        $aid = AlumniID::find($id);
        $aid->name = $request->input('name');
        $aid->id_no = $request->input('id_no');
        $aid->address = $request->input('address');
        $aid->citizenship = $request->input('citizenship');
        $aid->month_grad = $request->input('month_grad');
        $aid->bday = $request->input('bday');
        $aid->course = $request->input('course');
        $aid->reference_no = $request->input('reference_no');

    
        // Get the selected year from the form data
        $year = $aid['id_no'];
    
        // Get the number of existing alumni IDs for the selected year
        $count = AlumniID::where('id_no', $year)->count();
    
        // Generate the next alumni ID for the selected year
        if ($count == 0) {
            // If there are no existing alumni IDs for the selected year, set the count to 1
            $count = 1;
        } else {
            // Otherwise, get the latest alumni ID for the selected year and increment the count by 1
            $latest_alumni_id = AlumniID::where('id_no', $year)->latest()->first();
            $count = intval(substr($latest_alumni_id->a_no, -4)) + 1;
        }
    
        // Generate the next alumni ID based on the year and count
        $alumni_id = $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    
        // Add the generated alumni ID to the form data
        $aid->a_no = $alumni_id;
    
        if ($request->hasFile('signature')) {
            // Delete the old signature image if it exists
            $oldImage = $aid->signature;
            if (!empty($oldImage) && file_exists(public_path('images/alumni_id/signature/'.$oldImage))) {
                unlink(public_path('images/alumni_id/signature/'.$oldImage));
            }
    
            // Save the new signature image
            $image = $request->file('signature');
            $destinationPath = 'images/alumni_id/signature/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $aid->signature = $profileImage;
        }
    

        $aid->save();

        
        Session::flash('status','Succesfully Edited.');
        return redirect('/alumni-id')->with('aid', $aid)->withInput();
    }
    


      
}
