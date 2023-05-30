<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reissueance;
use App\Models\User;
use Session;
use DB;
use App\Models\Admin_Notifications;
use App\Models\Client_Notifications;
use Auth;
use Illuminate\Support\Facades\File;

class ReissueanceController extends Controller
{
    public function route_reissuance()
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        return view('main.reissuance',compact('notificationsUnread'));
    }

    public function post_reissuance(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'id_no' => 'required',
            'degree' => 'required',
            'reason' => 'required',
            'or_no' => 'required',
            'signature' => 'required|image|max:1024'
            ], [
            'name.required' => 'Please enter your name.',
            'id_no.required' => 'Please enter your ID no.',
            'degree.required' => 'Please enter your degree.',
            'reason.required' => 'Please tell us your reason.',
            'or_no.required' => 'Please enter your OR no.',
            'signature.required' => '(Please select signature.)',
            'signature.image' => '(Please select an image.)',
            'signature.max' => '(File size must be less than 1 MB).'
            ]);
        
        $reissuance = $request->all();

        // Add the user_id to the form data
        $reissuance['user_id'] = $request->user()->id;


        if ($image = $request->file('signature')) {
            $destinationPath = 'images/reissueance/signature/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $reissuance['signature'] = "$profileImage";
        }
        $ReissueanceID = Reissueance::create($reissuance);

        // Update the user's alumni_id_applied column to true
        $user = User::find($request->user()->id);
        $user->reissueance_applied = true;
        $user->save();

        $admin_notification = new Admin_Notifications();
        $admin_notification->user_id = Auth::user()->id;
        $admin_notification->reissueance_id = $ReissueanceID->id;
        $admin_notification->message = 'Applied for Reissueance';
        $admin_notification->save();

        Session::flash('success_reissuance','Succesful.');
        return redirect('/success-reissueance')->with('reissuance', $reissuance)->withInput();
    }

    public function notify_reissueance(Request $request)
    {
        $client_notification = new Client_Notifications();
        $client_notification->user_id = $request->input('user_id');
        $client_notification->message = 'Your Re-issueance is Done';
        $client_notification->save();
        Session::flash('status','Notified Succesfully.');
        return redirect('/alumni-membership');
    }

    public function db_route_reissuance()
    {
        $reissueance = Reissueance::all();
        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();


        // DAY
        $daily_reissuance = DB::table('reissueances')
        ->select(DB::raw('COUNT(*) as count, DATE(created_at) as day'))
        ->groupBy('day')
        ->get();

        $days = [];
        $day_counts = [];

        foreach ($daily_reissuance as $reissuance) {
            $days[] = date("F j, Y", strtotime($reissuance->day));
            $day_counts [] = $reissuance->count;
        }


        // WEEK
        $weekly_reissuance = DB::table('reissueances')
            ->select(DB::raw('COUNT(*) as count, DATE(DATE_FORMAT(created_at, "%Y-%m-%d") - INTERVAL DAYOFWEEK(created_at) - 1 DAY) as week_start_date'))
            ->groupBy('week_start_date')
            ->get();

        $weeks = [];
        $week_counts  = [];

        foreach ($weekly_reissuance as $reissuance) {
            $weeks[] = 'Week of '.date("F j, Y", strtotime($reissuance->week_start_date));
            $week_counts [] = $reissuance->count;
        }

        // MONTH
        $monthly_reissuance = DB::table('reissueances')
            ->select(DB::raw('COUNT(*) as count, DATE(DATE_FORMAT(created_at, "%Y-%m-01")) as month_start_date'))
            ->groupBy('month_start_date')
            ->get();

        $months = [];
        $month_counts  = [];

        foreach ($monthly_reissuance as $reissuance) {
            $months[] = date("F Y", strtotime($reissuance->month_start_date));
            $month_counts [] = $reissuance->count;
        }

        // YEAR
        $yearly_reissuance = DB::table('reissueances')
        ->select(DB::raw('COUNT(*) as count, YEAR(created_at) as year'))
        ->groupBy('year')
        ->get();

        $years = [];
        $year_counts = [];

        foreach ($yearly_reissuance as $reissuance) {
        $years[] = $reissuance->year;
        $year_counts[] = $reissuance->count;
        }

        return view ('dashboard.reissueance', compact('notificationsUnread','reissueance', 'day_counts', 'week_counts', 'month_counts','year_counts','days', 'weeks', 'months','years',));
        }

    public function db_reissueance_ajaxview($id)
    {
        $reissueance = Reissueance::find($id);
        $image_url = asset('images/reissueance/signature/' . $reissueance->signature);
        return response()->json([
            'status' => 200,
            'reissueance' => $reissueance,
            'image_url' => $image_url,
        ]);
    }
    
    

    public function db_delete_reissueance($id)
    {
        $delete_reissueance = Reissueance::find($id);
        $destinationPath = 'images/reissueance/signature/'.$delete_reissueance->signature;
        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }
        $delete_reissueance -> delete();
        Session::flash('status','You`ve successfully deleted a reissueance!');
        return redirect('/reissueance')->with('delete_reissueance', $delete_reissueance); 
    }

    public function success_reissueance()
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        return view('main.success-reissueance',compact('notificationsUnread'));
    }

    public function db_reissueance_ajaxedit($id)
    {
        $reissueance = Reissueance::find($id);
        $image_url = asset('images/reissueance/signature/' . $reissueance->signature);
        return response()->json([
            'status' => 200,
            'reissueance' => $reissueance,
            'image_url' => $image_url,
        ]);
    }

    public function db_update_reissueance(Request $request)
    {
        $id = $request->input('r_id');
        $reissueance = Reissueance::find($id);
        $reissueance->name = $request->input('name');
        $reissueance->id_no = $request->input('id_no');
        $reissueance->degree = $request->input('degree');
        $reissueance->reason = $request->input('reason');
        $reissueance->or_no = $request->input('or_no');
    
        if ($request->hasFile('signature')) {
            // Delete the old signature image if it exists
            $oldImage = $reissueance->signature;
            if (!empty($oldImage) && file_exists(public_path('images/reissueance/signature/'.$oldImage))) {
                unlink(public_path('images/reissueance/signature/'.$oldImage));
            }
    
            // Save the new signature image
            $image = $request->file('signature');
            $destinationPath = 'images/reissueance/signature/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $reissueance->signature = $profileImage;
        }
    
        $reissueance->save();
    
        Session::flash('status','Succesfully Edited.');
        return redirect('/reissueance')->with('reissueance', $reissueance)->withInput();
    }

}
