<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Signin;
use App\Models\AlumniID;
use App\Models\AlumniMem;
use App\Models\Admininfo;
use App\Models\User;
use App\Models\Payment;
use App\Models\Admin_Notifications;
use Spatie\Permission\Models\Role;
use Session;
use Hash;
use Mail;
use Auth;
use DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function route_db_login()
    {
       return view('dashboard.dashboard-login');
    }

    public function route_db_settings()
    {
        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();
       return view('dashboard.settings',compact('notificationsUnread'));
    }

    function db_check_login(Request $request)
    {
    $this->validate($request, [
       'email' => 'required|email',
       'password' => 'required|alphaNum|min:8'
       ], [
       'email.required' => 'Please enter your email address.',
       'email.email' => 'Please enter a valid email address.',
       'password.required' => 'Please enter your password.',
       'password.alpha_num' => 'Your password must contain only letters and numbers.',
       'password.min' => 'Your password must be at least 8 characters long.'
       ]);
         

     $user = Admininfo::where('email','=',$request->email)->first();
     if ($user) {
        if(Hash::check($request->password,$user->password)){
            $request->session()->put('loginId',$user->id);
            return redirect('/dashboard');
        }else{
         return back()->with('loginfail','This password doesn`t match!')->withInput();
        }
     } else {
        return back()->with('loginfail','This email doesn`t exist!')->withInput();
     }
     
   }

   public function route_payment_settings()
   {
        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();
        $payment = Payment::first();
        return view('dashboard.payment', compact('payment','notificationsUnread'));
   }

   public function route_sales_report()
   {
    // ALUMNI MEMBERSHIP SALES

        // DAY
        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();
        $amem_daily_payment = DB::table('alumni_mem')
        ->select(DB::raw('SUM(price) as total_sales, DATE(created_at) as day'))
        ->where('status', '=', 'Paid')
        ->groupBy('day')
        ->get();


        $days = [];
        $day_counts = [];
        
        foreach ($amem_daily_payment as $payment) {
            $days[] = date("F j, Y", strtotime($payment->day));
            $day_counts [] = $payment->total_sales;
        }
        


        // WEEK
        $amem_weekly_payment = DB::table('alumni_mem')
        ->select(DB::raw('SUM(price) as total_price, DATE(DATE_FORMAT(created_at, "%Y-%m-%d") - INTERVAL DAYOFWEEK(created_at) - 1 DAY) as week_start_date'))
        ->where('status', 'Paid')
        ->groupBy('week_start_date')
        ->get();
    
        $weeks = [];
        $week_counts  = [];
        
        foreach ($amem_weekly_payment as $payment) {
            $weeks[] = 'Week of '.date("F j, Y", strtotime($payment->week_start_date));
            $week_counts [] = $payment->total_price;
        }
    

        // MONTH
        $amem_monthly_payment = DB::table('alumni_mem')
            ->select(DB::raw('SUM(price) as sum, DATE(DATE_FORMAT(created_at, "%Y-%m-01")) as month_start_date'))
            ->where('status', 'Paid')
            ->groupBy('month_start_date')
            ->get();

        $months = [];
        $month_counts  = [];

        foreach ($amem_monthly_payment as $payment) {
            $months[] = date("F Y", strtotime($payment->month_start_date));
            $month_counts [] = $payment->sum;
        }



        // YEAR
        $amem_yearly_payment = DB::table('alumni_mem')
        ->select(DB::raw('SUM(price) as total_sales, YEAR(created_at) as year'))
        ->where('status', 'Paid')
        ->groupBy('year')
        ->get();
    
        $years = [];
        $year_counts = [];
        
        foreach ($amem_yearly_payment as $payment) {
            $years[] = $payment->year;
            $year_counts[] = $payment->total_sales;
        }

        // ALUMNI ID SALES

        // DAY
        $aid_daily_payment = DB::table('alumni_id')
        ->select(DB::raw('SUM(price) as total_sales, DATE(created_at) as day'))
        ->where('status', '=', 'Paid')
        ->groupBy('day')
        ->get();


        $aid_days = [];
        $aid_day_counts = [];
        
        foreach ($aid_daily_payment as $aid_payment) {
            $aid_days[] = date("F j, Y", strtotime($aid_payment->day));
            $aid_day_counts [] = $aid_payment->total_sales;
        }
        


        // WEEK
        $aid_weekly_payment = DB::table('alumni_id')
        ->select(DB::raw('SUM(price) as total_price, DATE(DATE_FORMAT(created_at, "%Y-%m-%d") - INTERVAL DAYOFWEEK(created_at) - 1 DAY) as week_start_date'))
        ->where('status', 'Paid')
        ->groupBy('week_start_date')
        ->get();
    
        $aid_weeks = [];
        $aid_week_counts  = [];
        
        foreach ($aid_weekly_payment as $aid_payment) {
            $aid_weeks[] = 'Week of '.date("F j, Y", strtotime($aid_payment->week_start_date));
            $aid_week_counts [] = $aid_payment->total_price;
        }
    

        // MONTH
        $aid_monthly_payment = DB::table('alumni_id')
            ->select(DB::raw('SUM(price) as sum, DATE(DATE_FORMAT(created_at, "%Y-%m-01")) as month_start_date'))
            ->where('status', 'Paid')
            ->groupBy('month_start_date')
            ->get();

        $aid_months = [];
        $aid_month_counts  = [];

        foreach ($aid_monthly_payment as $aid_payment) {
            $aid_months[] = date("F Y", strtotime($aid_payment->month_start_date));
            $aid_month_counts [] = $aid_payment->sum;
        }



        // YEAR
        $aid_yearly_payment = DB::table('alumni_id')
        ->select(DB::raw('SUM(price) as total_sales, YEAR(created_at) as year'))
        ->where('status', 'Paid')
        ->groupBy('year')
        ->get();
    
        $aid_years = [];
        $aid_year_counts = [];
        
        foreach ($aid_yearly_payment as $aid_payment) {
            $aid_years[] = $aid_payment->year;
            $aid_year_counts[] = $aid_payment->total_sales;
        }
        

      return view('dashboard.sales', 
      compact('notificationsUnread','day_counts', 'week_counts', 'month_counts','year_counts','days', 'weeks', 'months','years',
      'aid_day_counts', 'aid_week_counts', 'aid_month_counts','aid_year_counts','aid_days', 'aid_weeks', 'aid_months','aid_years',
    ));
   }

   public function db_payment_update(Request $request)
   {
       $id = $request->input('payment_id');
       $payment = Payment::find($id);
       $payment->reciever_name = $request->input('reciever_name');
       $payment->gcash_no = $request->input('gcash_no');
       $payment->alumni_id_price = $request->input('alumni_id_price');
       $payment->alumni_mem_price = $request->input('alumni_mem_price');




       if ($request->hasFile('gcash_qr')) {
           // Delete the old gcash_qr image if it exists
           $oldImage = $payment->signature;
           if (!empty($oldImage) && file_exists(public_path('images/qr/'.$oldImage))) {
               unlink(public_path('images/qr/'.$oldImage));
           }
   
           // Save the new gcash_qr image
           $image = $request->file('gcash_qr');
           $destinationPath = 'images/qr/';
           $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
           $image->move($destinationPath, $profileImage);
           $payment->gcash_qr = $profileImage;
       }
   

       $payment->save();

       
       Session::flash('status','Succesfully Edited.');
       return redirect('/payment_settings')->with('payment', $payment)->withInput();
   }
 
    public function route_dashboard()
 
    {
    $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();
     $numberOfAnnouncement = Announcement::count();
     $numberOfAlumniID = AlumniID::count();
     $numberOfAlumniMem = AlumniMem::count();
     $numberOfStudents = User::whereHas('roles', function ($query) {
        $query->where('name', 'Student');
    })->count();

    
    $last24Hours = Carbon::now()->subDay();

    $allusers = User::with('roles')
    ->whereHas('roles', function ($query) {
        $query->whereIn('name', ['Student']);
    })
    ->where('created_at', '>=', $last24Hours)
    ->orderBy('created_at')
    ->get();


    $monthly_signins = DB::table('users')
    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
    ->select(DB::raw('COUNT(*) as count, MONTH(users.created_at) as month'))
    ->where('roles.name', '=', 'Student')
    ->groupBy('month')
    ->get();

    $months = [];
    $signins = [];

    foreach ($monthly_signins as $signin) {
    $months[] = date("F", mktime(0, 0, 0, $signin->month, 1));
    $signins[] = $signin->count;
    }
    
     return view('dashboard.dashboard')->with([
        'numberOfAnnouncement' => $numberOfAnnouncement,
        'numberOfAlumniID' => $numberOfAlumniID,
        'numberOfAlumniMem' => $numberOfAlumniMem,
        'numberOfStudents' => $numberOfStudents,
        'months' => $months,
        'signins' => $signins,
        'allusers' => $allusers,
        'notificationsUnread' => $notificationsUnread,
    ]);

    }

    public function adminpassword_update(Request $request)
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
         return redirect('/settings')->with(compact('user'));

      } else {
         return back()
         ->withErrors(['old_password' => 'Old password does not match our records.'])
         ->withInput()
         ->with(session()->flash('failpassword', 'Password change failed!'));
      }
    }

    public function admininfo_update(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $user->update($input);
        Session::flash('accountstatus','You`ve successfully edited your account information!');
        return redirect('/settings')->with(compact('user'));
    }

    public function adminpp_update(Request $request)
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
        return redirect('/settings')->with(compact('user'));
        
    }

    public function create_user_role(Request $request)
    {
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        $user->save();
    
        $roleId = $request->input('role');
        $role = Role::findById($roleId);
        if (!$role) {
            return redirect('/user-roles')->with('failregister', 'Invalid role ID');
        }
    
        $user->assignRole($role);
    
        Session::flash('status', 'You`ve registered successfully, Try to LOG IN.');
        return redirect('/user-roles');
    }

    public function update_user_role(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    
        $roleId = $request->input('role');
        $role = Role::findById($roleId);
        if (!$role) {
            return redirect('/user-roles')->with('failregister', 'Invalid role ID');
        }
    
        $user->syncRoles([$role]);
    
        $user->update();
    
        Session::flash('status', 'User role updated successfully.');
        return redirect('/user-roles');
    }
    

    public function route_user_role()
    {
        $notificationsUnread = Admin_Notifications::whereNull('read_at')->get();
        $user_roles = User::with('roles')
        ->whereHas('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'ID Staff']);
        })
        ->get();
       return view('dashboard.users', compact('user_roles','notificationsUnread'));
    }


    public function db_users_ajaxview($id)
    {
        $user = User::with('roles')->find($id);
        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }

    public function db_users_ajaxedit($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }

    public function delete_user($id)
    {
        $delete_student = User::find($id);
        $delete_student -> delete();
        Session::flash('status','You`ve successfully deleted a User!');
        return redirect('/user-roles')->with('delete_student', $delete_student); 
    }

    public function adminlogout()
    {
     Auth::logout();
     return redirect('/dashboard-login');
    }
}
