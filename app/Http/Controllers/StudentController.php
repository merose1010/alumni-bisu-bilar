<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AlumniID;
use App\Models\AlumniMem;
use App\Models\Reissueance;
use App\Models\Announcement;
use App\Models\Admin_Notifications;
use App\Models\Client_Notifications;
use Session;
use DB;
use Auth;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{

    public function route_user_announcements()
    {
        $user_id = Auth::id();
        $announce = Announcement::all();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        return view('main.announce', compact('notificationsUnread','announce'));
    }

    public function route_user_about()
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        return view('main.contact', compact('notificationsUnread'));
    }

    public function route_user_settings()
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        return view('main.account', compact('notificationsUnread'));
    }
    public function route_user_role()
    {
        $user_roles = User::with('roles')
        ->whereHas('roles', function ($query) {
            $query->whereIn('name', ['Student']);
        })
        ->get();
        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();



    
        // // Get the user role names
        // $role_names = $user_roles->pluck('roles.0.name');
        
    
        // // DAY
        // $daily_students = DB::table('users')
        //     ->select(DB::raw('COUNT(*) as count, DATE(created_at) as day'))
        //     ->whereHas('roles', function ($query) {
        //         $query->whereIn('name', ['Student']);
        //     })
        //     ->groupBy('day')
        //     ->get();

        // $days = [];
        // $day_counts = [];

        // foreach ($daily_students as $students) {
        //     $days[] = date("F j, Y", strtotime($students->day));
        //     $day_counts [] = $students->count;
        // }


        // // WEEK
        // $weekly_student = DB::table('users')
        //     ->select(DB::raw('COUNT(*) as count, DATE(DATE_FORMAT(created_at, "%Y-%m-%d") - INTERVAL DAYOFWEEK(created_at) - 1 DAY) as week_start_date'))
        //     ->whereHas('roles', function ($query) {
        //         $query->whereIn('name', ['Student']);
        //     })
        //     ->groupBy('week_start_date')
        //     ->get();

        // $weeks = [];
        // $week_counts  = [];

        // foreach ($weekly_student as $students) {
        //     $weeks[] = 'Week of '.date("F j, Y", strtotime($students->week_start_date));
        //     $week_counts [] = $students->count;
        // }

        // // MONTH
        // $monthly_student = DB::table('users')
        //     ->select(DB::raw('COUNT(*) as count, DATE(DATE_FORMAT(created_at, "%Y-%m-01")) as month_start_date'))
        //     ->whereHas('roles', function ($query) {
        //         $query->whereIn('name', ['Student']);
        //     })
        //     ->groupBy('month_start_date')
        //     ->get();

        // $months = [];
        // $month_counts  = [];

        // foreach ($monthly_student as $students) {
        //     $months[] = date("F Y", strtotime($students->month_start_date));
        //     $month_counts [] = $students->count;
        // }

        // // YEAR
        // $yearly_student = DB::table('users')
        //     ->select(DB::raw('COUNT(*) as count, YEAR(created_at) as year'))
        //     ->whereHas('roles', function ($query) {
        //         $query->whereIn('name', ['Student']);
        //     })
        //     ->groupBy('year')
        //     ->get();

        // $years = [];
        // $year_counts = [];

        // foreach ($yearly_student as $students) {
        //     $years[] = $students->year;
        //     $year_counts[] = $students->count;
        // }
            
        return view('dashboard.record', compact('notificationsUnread','user_roles'));
    }

    public function db_record_ajaxview($id)
    {
        $user = User::with('roles')->find($id);
        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }

    public function delete_student($id)
    {
        $delete_student = User::find($id);
        $delete_student -> delete();
        Session::flash('status','You`ve successfully deleted a Student!');
        return redirect('/record-of-alumni')->with('delete_student', $delete_student); 
    }

    public function student_password_update(Request $request)
    {
      $request->validate([
         'old_password'=>'required|min:8|max:20|alphaNum',
         'new_password'=>'required|min:8|max:20|alphaNum',
         'confirm_password'=>'required|same:new_password',
      ]);
      $user = Auth::user();

      if (Hash::check($request->old_password, $user->password)) {
         
         $user->update([
               'password'=>bcrypt($request->new_password)
         ]);

         Session::flash('successpassword','You`ve successfully edited your password!');
         return redirect('/home-account')->with(compact('user'));

      } else {
         return back()
         ->withErrors(['old_password' => 'Old password does not match our records.'])
         ->withInput()
         ->with(session()->flash('failpassword', 'Password change failed!'));
      }
    }

    public function student_info_update(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $user->update($input);
        Session::flash('accountstatus','You`ve successfully edited your account information!');
        return redirect('/home-account')->with(compact('user'));
    }

    public function student_pp_update(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        if ($image = $request->file('profile_picture')) {

            $destinationPath = 'images/user_profile/'.$user->profile_picture;
            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }
            $destinationPath = 'images/user_profile/';
            $carImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $carImage);
            $input['profile_picture'] = "$carImage";
        }else{
            unset($input['profile_picture']);
        }
        $user->update($input);
        Session::flash('accountstatus','You`ve successfully edited your profile photo!');
        return redirect('/home-account')->with(compact('user'));
        
    }

    public function route_student_record()
    {
        $user_id = Auth::id();
        $notificationsUnread = Client_Notifications::where('user_id', $user_id)
            ->whereNull('read_at')
            ->get();
        $user_id = auth()->user()->id;
        $alumni_id = AlumniID::where('user_id', $user_id)->with('user')->get();
        $alumni_mem = AlumniMem::where('user_id', $user_id)->with('user')->get();
        $reissue = Reissueance::where('user_id', $user_id)->with('user')->get();

        return view('main.record', compact('notificationsUnread','alumni_id', 'alumni_mem', 'reissue'));
    }



    // AJAX VIEW

    public function student_alumni_id_ajaxview($id)
    {
        $alumni_id = AlumniID::find($id);
        $image_url = asset('images/alumni_id/signature/' . $alumni_id->signature);
        return response()->json([
            'status' => 200,
            'alumni_id' => $alumni_id,
            'image_url' => $image_url,
        ]);
    }
    

    public function student_alumni_mem_ajaxview($id)
    {
        $amem = AlumniMem::find($id);
        $image_url = asset('images/alumni_mem/signature/' . $amem->signature);
        return response()->json([
            'status' => 200,
            'amem' => $amem,
            'image_url' => $image_url,
        ]);
    }

    public function student_reissueance_ajaxview($id)
    {
        $reissueance = Reissueance::find($id);
        $image_url = asset('images/reissueance/signature/' . $reissueance->signature);
        return response()->json([
            'status' => 200,
            'reissueance' => $reissueance,
            'image_url' => $image_url,
        ]);
    }
    

    #AJAX EDIT

    public function student_alumni_id_ajaxedit($id)
    {
        $alumni_id = AlumniID::find($id);
        $image_url = asset('images/alumni_id/signature/' . $alumni_id->signature);
        return response()->json([
            'status' => 200,
            'alumni_id' => $alumni_id,
            'image_url' => $image_url,
        ]);
    }

    
    public function student_alumni_mem_ajaxedit($id)
    {
        $amem = AlumniMem::find($id);
        $image_url = asset('images/alumni_mem/signature/' . $amem->signature);
        return response()->json([
            'status' => 200,
            'amem' => $amem,
            'image_url' => $image_url,
        ]);
    }
    public function student_reissueance_ajaxedit($id)
    {
        $reissueance = Reissueance::find($id);
        $image_url = asset('images/reissueance/signature/' . $reissueance->signature);
        return response()->json([
            'status' => 200,
            'reissueance' => $reissueance,
            'image_url' => $image_url,
        ]);
    }

    // AJAX UPDATE
    public function update_alumni_mem_student(Request $request)
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
    
        Session::flash('success','Succesfully Edited.');
        return redirect('/records-of-students')->with('amem', $amem)->withInput();
    }

    public function update_reissueance_student(Request $request)
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
    
        Session::flash('success','Succesfully Edited.');
        return redirect('/records-of-students')->with('reissueance', $reissueance)->withInput();
    }

    public function update_alumni_id_student(Request $request)
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

        
        Session::flash('success','Succesfully Edited.');
        return redirect('/records-of-students')->with('aid', $aid)->withInput();
    }
    
    
}
