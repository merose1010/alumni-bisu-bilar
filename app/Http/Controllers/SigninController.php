<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signin;
use App\Models\User;
use Session;
use Hash;
use Spatie\Permission\Models\Role;

class SigninController extends Controller
{
    public function route_main_signin()
    {
        return view('main.signin');
    }

    public function post_main_signin(Request $request)
    {

    $this->validate($request, [
        'last_name' => 'required',
        'first_name' => 'required',
        'middle_name' => 'required',
        'course' => 'required',
        'email' => 'required|email',
        'password' => 'required|alphaNum|min:8',
        'gender' => 'required',
        'address' => 'required',
        ], [
        'last_name.required' => 'Please enter your Last Name.',
        'first_name.required' => 'Please enter your First Name.',
        'middle_name.required' => 'Please enter your Middle Name.',
        'course.required' => 'Please enter your Course.',
        'email.required' => 'Please enter your Email.',
        'password.required' => 'Please enter your Password.',
        'gender.required' => 'Please select your Gender.',
        'address.required' => 'Please enter your Adrress.',
        ]);

        $user = $request->all();
        $user['password'] = Hash::make($user['password']);
        $newUser = User::create($user);
    
        $role = Role::where('name', 'Student')->first();
        $newUser->roles()->attach($role);

        Session::flash('successregister','Succesful Signin try to LOG-IN.');
        return redirect('/');

        // Session::flash('successregister','Succesful Signin try to LOG-IN.');
        // return redirect('/login')->with('signin', $signin); 
    }
}
