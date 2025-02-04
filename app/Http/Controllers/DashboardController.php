<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getGuard()
    {
        if(\Auth::guard('web')->check()) {
            return 'web';
        } elseif(\Auth::guard('faculty')->check()) {
            return 'faculty';
        }
    }

    public function dash()
    {
        return view('home.dashboard');
    }

    public function logout()
    {
        // if (\Auth::guard('web')->check() || \Auth::guard('faculty')->check()) {
        //     auth()->guard('web')->logout();
        //     auth()->guard('faculty')->logout();
        //     return redirect()->route('login')->with('success', 'You have been Successfully Logged Out');
        // } else {
        //     return redirect()->route('home')->with('error', 'No authenticated user to log out');
        // }

        if (\Auth::guard('web')->check()) {
            auth()->guard('web')->logout();
            //auth()->guard('faculty')->logout();
            return redirect()->route('login')->with('success', 'You have been Successfully Logged Out');
        } else {
            return redirect()->route('dash')->with('error', 'No authenticated user to log out');
        }

    }
}
