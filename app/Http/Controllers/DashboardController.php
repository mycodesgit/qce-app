<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\EnrollmentDB\StudEnrolmentHistory;
use App\Models\SettingDB\ConfigureCurrent;

class DashboardController extends Controller
{
    public function getGuard()
    {
        if(\Auth::guard('web')->check()) {
            return 'web';
        // } elseif(\Auth::guard('faculty')->check()) {
        //     return 'faculty';
        } elseif(\Auth::guard('kioskstudent')->check()) {
            return 'kioskstudent';
        }
    }

    public function dash()
    {
        $userCampus = Auth::guard('web')->user()->campus;

        // Fetch the active configuration with set_status = 2
        $activeConfig = ConfigureCurrent::where('set_status', 2)->first();
        if (!$activeConfig) {
            return back()->with('error', 'No active school year found.');
        }
        $activeConfigId = $activeConfig->id;
        
        $previousConfig = ConfigureCurrent::where('id', '<', $activeConfigId) // Ensure it's before the current active one
            ->orderBy('id', 'desc') // Get the most recent one
            ->first();

        $schlyearactiveYear = $activeConfig->schlyear;
        $schlyearactive = $activeConfig->schlyear;
        $semesteractive = $activeConfig->semester;
        $prevsemesteractive = $previousConfig->semester;

        $previousSchlyearYear = $previousConfig ? $previousConfig->schlyear : null;

        if (!$previousSchlyearYear) {
            return back()->with('error', 'No previous school year found.');
        }
        $enrlstudcountfirst = StudEnrolmentHistory::where('program_en_history.studentID', 'NOT LIKE', '%-G%')
                            ->where('program_en_history.schlyear', 'LIKE', $schlyearactive)
                            ->where('program_en_history.semester', 'LIKE', $semesteractive)
                            ->where('program_en_history.studYear', '=', '1')
                            ->where('program_en_history.campus', '=', $userCampus)
                            ->count();


        $enrlstudcountsecond = StudEnrolmentHistory::where('program_en_history.studentID', 'NOT LIKE', '%-G%')
                            ->where('program_en_history.schlyear', 'LIKE', $schlyearactive)
                            ->where('program_en_history.semester', 'LIKE', $semesteractive)
                            ->where('program_en_history.studYear', '=', '2')
                            ->where('program_en_history.campus', '=', $userCampus)
                            ->count();

        $enrlstudcountthird = StudEnrolmentHistory::where('program_en_history.studentID', 'NOT LIKE', '%-G%')
                            ->where('program_en_history.schlyear', 'LIKE', $schlyearactive)
                            ->where('program_en_history.semester', 'LIKE', $semesteractive)
                            ->where('program_en_history.studYear', '=', '3')
                            ->where('program_en_history.campus', '=', $userCampus)
                            ->count();

        $enrlstudcountfourth = StudEnrolmentHistory::where('program_en_history.studentID', 'NOT LIKE', '%-G%')
                            ->where('program_en_history.schlyear', 'LIKE', $schlyearactive)
                            ->where('program_en_history.semester', 'LIKE', $semesteractive)
                            ->where('program_en_history.studYear', '=', '4')
                            ->where('program_en_history.campus', '=', $userCampus)
                            ->count();
        return view('home.dashboard', compact('enrlstudcountfirst', 'enrlstudcountsecond', 'enrlstudcountthird', 'enrlstudcountfourth'));
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
            return redirect()->route('login')->with('success', 'You have been Successfully Logged Out');
        } elseif (\Auth::guard('kioskstudent')->check()) {
            auth()->guard('kioskstudent')->logout();
            return redirect()->route('studentLogin')->with('success', 'You have been Successfully Logged Out');
        } else {
            return redirect()->route('home')->with('error', 'No authenticated user to log out');
        }

    }
}
