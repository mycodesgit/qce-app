<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {
        return view('adminlogin');
    }

    public function studentLogin()
    {
        return view('studlogin');
    }

    public function empstudlogin(Request $request)
    {
        $request->validate([
            // 'email' => 'required|email',
            // 'password' => 'required|min:5|max:20',
            'email' => 'required_without:studid|email',
            'studid' => 'required_without:email',
        ]);

        // Attempt login for both 'web' and 'faculty' guards
        $validatedUser = auth()->guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // $validatedFaculty = auth()->guard('faculty')->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        $validatedStudent = auth()->guard('kioskstudent')->attempt([
            'studid' => $request->studid,
            'password' => $request->password,
        ]);
        //dd($validatedStudent);

        // if(\Auth::guard('web')->check()) {
        //     return 'web';
        // } elseif(\Auth::guard('faculty')->check()) {
        //     return 'faculty';
        // }

        if ($validatedUser) {
            return redirect()->route('dash')->with('success', 'You have successfully logged in.');
        } 
        // elseif($validatedFaculty) {
        //     return redirect()->route('homefaculty')->with('success', 'You have successfully logged in.');
        // } 
        elseif($validatedStudent) {
            return redirect()->route('dash')->with('success', 'You have successfully logged in.');
        } 
        else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
}
