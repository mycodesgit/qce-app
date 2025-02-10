<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

use App\Models\EvaluationDB\QCEinstruction;
use App\Models\EvaluationDB\QCEcategory;
use App\Models\EvaluationDB\QCEquestion;
use App\Models\EvaluationDB\QCEsemester;
use App\Models\EvaluationDB\QCEfevalrate;

use App\Models\EnrollmentDB\Grade;
use App\Models\EnrollmentDB\KioskUser;
use App\Models\EnrollmentDB\StudEnrolmnentHistory;
use App\Models\EnrollmentDB\Student;

use App\Models\ScheduleDB\Addressee;
use App\Models\ScheduleDB\ClassEnroll;
use App\Models\ScheduleDB\ClassessSubjects;
use App\Models\ScheduleDB\College;
use App\Models\ScheduleDB\Department;
use App\Models\ScheduleDB\EnPrograms;
use App\Models\ScheduleDB\Faculty;
use App\Models\ScheduleDB\Subject;
use App\Models\ScheduleDB\SubjectOffered;

class ReportsController extends Controller
{
    public function subprintStore()
    {
        //$currsem = QCEsemester::all();
        $currsem = QCEsemester::select('id', 'qceschlyear')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('qceschlyearsem')
                    ->groupBy('qceschlyear');
            })
            ->orderBy('id', 'DESC')
            ->get();
        return view('reports.reportsqceprint', compact('currsem'));
    }

    public function subprint_searchresultStore()
    {
        //$currsem = QCEsemester::all();
        $currsem = QCEsemester::select('id', 'qceschlyear')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('qceschlyearsem')
                    ->groupBy('qceschlyear');
            })
            ->orderBy('id', 'DESC')
            ->get();
        return view('reports.reportsqceprint_searchresult', compact('currsem'));
    }

    public function getevalsubratelistRead(Request $request) 
    {
        $semester = $request->query('semester');
        $schlyear = $request->query('schlyear');
        $campus = $request->query('campus');
        $progCodRaw = $request->query('progCod');

        // Convert spaces back to `+` to restore the original value
        $progCodRaw = str_replace(' ', '+', $progCodRaw);

        // Extract only the part before "+"
        $progCod = explode('+', $progCodRaw)[0];
        $progCodSec = explode('+', $progCodRaw)[1];


        $data = QCEfevalrate::leftJoin('coasv2_db_enrollment.program_en_history', 'qceformevalrate.studidno', '=', 'coasv2_db_enrollment.program_en_history.studentID')
                ->where('coasv2_db_enrollment.program_en_history.semester', $semester)
                ->where('coasv2_db_enrollment.program_en_history.schlyear', $schlyear)
                ->where('coasv2_db_enrollment.program_en_history.campus', $campus)
                ->where('coasv2_db_enrollment.program_en_history.progCod', $progCod)
                ->where('qceformevalrate.statprint', 1)
                ->where('qceformevalrate.semester', $semester)
                ->where('qceformevalrate.schlyear', $schlyear)
                ->where('qceformevalrate.campus', $campus)
                ->get();

        return response()->json(['data' => $data]);
    }

    public function getevalsubrateprintedlistRead(Request $request) 
    {
        $semester = $request->query('semester');
        $schlyear = $request->query('schlyear');
        $campus = $request->query('campus');

        $data = QCEfevalrate::where('statprint', 2)
                ->where('semester', $semester)
                ->where('schlyear', $schlyear)
                ->where('campus', $campus)
                ->get();

        return response()->json(['data' => $data]);
    }

    public function getCoursesyearsec(Request $request)
    {
        $semester = $request->semester;
        $schlyear = $request->schlyear;
        $campus = $request->campus;

        $courses = ClassEnroll::join('programs', 'class_enroll.progCode', '=', 'programs.progCod')
            ->where('class_enroll.semester', $semester)
            ->where('class_enroll.schlyear', $schlyear)
            ->where('class_enroll.campus', $campus)
            ->orderBy('class_enroll.progCode')
            ->orderBy('class_enroll.classSection')
            ->get();

        return response()->json($courses);
    }
}
