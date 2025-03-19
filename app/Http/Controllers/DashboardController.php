<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\EnrollmentDB\StudEnrolmentHistory;
use App\Models\ScheduleDB\EnPrograms;
use App\Models\SettingDB\ConfigureCurrent;
use App\Models\EvaluationDB\QCEfevalrate;

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

        // $evalcountprog = QCEfevalrate::count();
        // dd($evalcountprog);

        return view('home.dashboard', compact('enrlstudcountfirst', 'enrlstudcountsecond', 'enrlstudcountthird', 'enrlstudcountfourth'));
    }

    public function getEvalData()
    {
        // Step 1: Fetch all student IDs from QCEfevalrate
        $studentIds = DB::table('qceformevalrate')
            ->pluck('studidno'); // Get only student IDs

        if ($studentIds->isEmpty()) {
            return response()->json(['labels' => [], 'data' => []]);
        }

        // Step 2: Get corresponding progCod, studYear, and studSec from program_en_history (enrollment database)
        $studentPrograms = DB::connection('enrollment')->table('program_en_history')
            ->whereIn('studentID', $studentIds)
            ->select('studentID', 'progCod', 'studYear', 'studSec')
            ->get(); // Get all relevant data

        if ($studentPrograms->isEmpty()) {
            return response()->json(['labels' => [], 'data' => []]);
        }

        // Step 3: Get program acronyms from programs (schedule database)
        $programs = DB::connection('schedule')->table('programs')
            ->whereIn('progCod', $studentPrograms->pluck('progCod')->unique())
            ->pluck('progAcronym', 'progCod'); // Map progAcronym to progCod

        // Step 4: Count occurrences per unique program + year + section
        $programCounts = [];

        foreach ($studentPrograms as $record) {
            $progAcronym = $programs[$record->progCod] ?? null;
            if ($progAcronym) {
                // Format: "progAcronym - progCod (studYear-studSec)"
                $label = "{$progAcronym} {$record->studYear}-{$record->studSec}";

                if (!isset($programCounts[$label])) {
                    $programCounts[$label] = 0;
                }
                $programCounts[$label]++;
            }
        }

        return response()->json([
            'labels' => array_keys($programCounts),
            'data' => array_values($programCounts),
        ]);
    }

    public function getEvalFacData()
    {
        // Step 1: Fetch all qcefacID values from QCEfevalrate
        $facultyIds = DB::table('qceformevalrate')
            ->pluck('qcefacID'); // Get only qcefacID values

        if ($facultyIds->isEmpty()) {
            return response()->json(['labels' => [], 'data' => []]);
        }

        // Step 2: Get matching faculty names from the faculty table (schedule database)
        $facultyNames = DB::connection('schedule')->table('faculty')
            ->whereIn('id', $facultyIds)
            ->pluck('lname', 'id'); // facultyName mapped to facultyID

        if ($facultyNames->isEmpty()) {
            return response()->json(['labels' => [], 'data' => []]);
        }

        // Step 3: Count occurrences per faculty
        $facultyCounts = [];
        foreach ($facultyIds as $facultyID) {
            $facultyName = $facultyNames[$facultyID] ?? null;
            if ($facultyName) {
                if (!isset($facultyCounts[$facultyName])) {
                    $facultyCounts[$facultyName] = 0;
                }
                $facultyCounts[$facultyName]++;
            }
        }

        return response()->json([
            'labels' => array_keys($facultyCounts), // Faculty Names as Labels
            'data' => array_values($facultyCounts), // Count of evaluations per faculty
        ]);
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
