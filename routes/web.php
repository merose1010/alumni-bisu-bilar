<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ReissueanceController;
use App\Http\Controllers\AlumniIDController;
use App\Http\Controllers\AlumniMemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// DASHBOARD

Route::middleware(['preventBackHistory'])->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/dashboard-login', [AdminController::class,'route_db_login'])->name('dashboard_login');

        Route::get('/forgot-password', function () {
            return view('dashboard.forgot-password');
        });

    });

    Route::middleware(['auth','admin'])->group(function () {

        // Route::post('/dashboard-check-login', [AdminController::class,'db_check_login']);

        Route::get('/dashboard', [AdminController::class,'route_dashboard'])->name('dashboard');


        Route::get('/alumni-membership', [AlumniMemController::class,'db_route_alumni_mem']);
        Route::get('/alumni_mem/{id}/ajaxview', [AlumniMemController::class, 'db_alumni_mem_ajaxview']);
        Route::get('/delete_alumni_mem/{id}', [AlumniMemController::class, 'db_delete_alumni_mem']);
        Route::post('/confirm_amem/{id}', [AlumniMemController::class, 'confirmAmem']);
        Route::get('/alumni-membership/{id}/ajaxedit', [AlumniMemController::class, 'db_alumni_mem_ajaxedit']);
        Route::put('/update-student-amem-db', [AlumniMemController::class,'db_update_alumni_mem']);



        Route::get('/alumni-id', [AlumniIDController::class,'db_route_alumni_id']);
        Route::get('/alumni_id/{id}/ajaxview', [AlumniIDController::class, 'db_alumni_id_ajaxview']);
        Route::get('/delete_alumni_id/{id}', [AlumniIDController::class, 'db_delete_alumni_id']);
        Route::post('/confirm_aid/{id}', [AlumniIDController::class, 'confirmAid']);
        Route::get('/alumni_id/{id}/ajaxedit', [AlumniIDController::class, 'db_alumni_id_ajaxedit']);
        Route::put('/update-student-aid-db', [AlumniIDController::class,'db_update_alumni_id']);



        Route::get('/user-roles', [AdminController::class,'route_user_role']);
        Route::post('/create-user-role', [AdminController::class,'create_user_role']);
        Route::get('/user-roles/{id}/ajaxview', [AdminController::class, 'db_users_ajaxview']);
        Route::get('/user-roles/{id}/ajaxedit', [AdminController::class, 'db_users_ajaxedit']);
        Route::get('/delete_user/{id}', [AdminController::class, 'delete_user']);
        Route::put('/update_user', [AdminController::class, 'update_user_role']);

        Route::get('/record-of-alumni', [StudentController::class,'route_user_role']);
        Route::get('/record-of-alumni/{id}/ajaxview', [StudentController::class, 'db_record_ajaxview']);
        Route::get('/delete_student/{id}', [StudentController::class, 'delete_student']);


        Route::put('/change-admin-password', [AdminController::class,'adminpassword_update']);
        Route::put('/change-admin-info', [AdminController::class,'admininfo_update']);
        Route::put('/change-admin-pp', [AdminController::class,'adminpp_update']);
        

        Route::get('/reissueance', [ReissueanceController::class,'db_route_reissuance']);
        Route::get('/reissueance/{id}/ajaxview', [ReissueanceController::class, 'db_reissueance_ajaxview']);
        Route::get('/delete_reissueance/{id}', [ReissueanceController::class, 'db_delete_reissueance']);
        Route::get('/reissueance/{id}/ajaxedit', [ReissueanceController::class, 'db_reissueance_ajaxedit']);
        Route::put('/update-student-reissueance-db', [ReissueanceController::class,'db_update_reissueance']);


        Route::get('/announcement', [AnnouncementController::class,'route_announcement']);
        Route::post('/post_announcement', [AnnouncementController::class,'post_announcement']);
        Route::put('/update_announcement', [AnnouncementController::class, 'update_announcement']);
        Route::get('/delete_announcement/{id}', [AnnouncementController::class, 'delete_announcement']);
        Route::get('/announcement/{id}/ajaxview', [AnnouncementController::class, 'db_announcement_ajaxview']);
        Route::get('/announcement/{id}/ajaxedit', [AnnouncementController::class, 'db_announcement_ajaxedit']);

        Route::get('/payment_settings', [AdminController::class,'route_payment_settings']);
        Route::put('/update_payment', [AdminController::class, 'db_payment_update']);

        Route::get('/sales_report', [AdminController::class,'route_sales_report']);

        Route::get('/admin_notification', [NotificationController::class,'db_notification']);
        Route::put('/mark_as_read_admin/{id}', [NotificationController::class, 'markNotificationAsRead_admin']);
        Route::get('/delete_admin_notification/{id}', [NotificationController::class,'deleteNotification_admin']);        

        Route::post('/notify-alumni-id/{id}', [AlumniIDController::class,'notify_alumni_id']);
        Route::post('/notify-alumni-mem/{id}', [AlumniMemController::class,'notify_alumni_mem']);
        Route::post('/notify-reissueance/{id}', [ReissueanceController::class,'notify_reissueance']);

        
        
        Route::get('/settings', [AdminController::class,'route_db_settings']);

        // Route::get('/settings', function () {
        //     return view('dashboard.settings');
        // });
    });
});


Route::middleware(['preventBackHistory'])->group(function () {

    Route::get('/adminlogout', [AdminController::class,'adminlogout']);





    Route::middleware(['guest'])->group(function () {
        Route::get('/', function () {
            return view('main.login');
        });

        Route::get('/welcome', function () {
            return view('welcome');
        });


        Route::get('/student_login', [LoginController::class,'route_login'])->name('student_login');


        Route::get('/signin', function () {
            return view('main.signin');
        });

        Route::get('/signin', [SigninController::class,'route_main_signin']);
        Route::post('/post_signin', [SigninController::class,'post_main_signin']);
    });


    Route::middleware(['auth','student'])->group(function () {

        Route::get('/home-alumni-id', [AlumniIDController::class,'route_alumni_id']);
        Route::post('/home-alumni-id-post', [AlumniIDController::class,'post_alumni_id']);
        Route::get('/success-alumni-id', [AlumniIDController::class,'success_alumni_id']);


        Route::get('/home-alumni-membership', [AlumniMemController::class,'route_alumni_mem']);
        Route::post('/home-alumni-membership-post', [AlumniMemController::class,'post_alumni_mem']);
        Route::get('/success-alumni-mem', [AlumniMemController::class,'success_alumni_mem']);

        Route::get('/home-account', [StudentController::class,'route_user_settings']);

        Route::get('/success-alumni-mem', [AlumniMemController::class,'success_alumni_mem']);


        Route::put('/change-student-password', [StudentController::class,'student_password_update']);
        Route::put('/change-student-info', [StudentController::class,'student_info_update']);
        Route::put('/change-student-pp', [StudentController::class,'student_pp_update']);


        Route::get('/home-reissuance', [ReissueanceController::class,'route_reissuance']);
        Route::post('/home-reissuance-post', [ReissueanceController::class,'post_reissuance']);
        Route::get('/success-reissueance', [ReissueanceController::class,'success_reissueance']);

        
        Route::get('/records-of-students', [StudentController::class,'route_student_record']);
        Route::get('/records-of-students/{id}/ajaxview_aid', [StudentController::class, 'student_alumni_id_ajaxview']);
        Route::get('/records-of-students/{id}/ajaxview_amem', [StudentController::class, 'student_alumni_mem_ajaxview']);
        Route::get('/records-of-students/{id}/ajaxview_reissue', [StudentController::class, 'student_reissueance_ajaxview']);


        Route::get('/records-of-students/{id}/ajaxedit_aid', [StudentController::class, 'student_alumni_id_ajaxview']);
        Route::get('/records-of-students/{id}/ajaxedit_amem', [StudentController::class, 'student_alumni_mem_ajaxview']);
        Route::get('/records-of-students/{id}/ajaxedit_reissue', [StudentController::class, 'student_reissueance_ajaxedit']);
        
        Route::put('/update-student-aid', [StudentController::class,'update_alumni_id_student']);
        Route::put('/update-student-amem', [StudentController::class,'update_alumni_mem_student']);
        Route::put('/update-student-reissueance', [StudentController::class,'update_reissueance_student']);


        
        // NOTIFICATION
        Route::get('/my_notification', [NotificationController::class,'user_notification']);
        Route::put('/mark_as_read_user/{id}', [NotificationController::class, 'markNotificationAsRead_user']);
        Route::get('/delete_user_notification/{id}', [NotificationController::class,'deleteNotification_user']);    


        Route::get('/home-announcements', [StudentController::class,'route_user_announcements']);
        Route::get('/home-about', [StudentController::class,'route_user_about']);


        Route::get('/home', [ClientController::class,'route_home'])->name('client');
    });
    Route::get('/clientlogout', [ClientController::class,'clientlogout']);


});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
