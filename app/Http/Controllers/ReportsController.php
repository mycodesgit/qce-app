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

        // Convert spaces back to `+`
        $progCodRaw = str_replace(' ', '+', $progCodRaw);

        // Extract only the part before "+"
        $progCodParts = explode('+', $progCodRaw);
        $progCod = $progCodParts[0]; // Extract 'CSS-INT-001'

        // Ensure $progCodParts[1] exists before using it
        $progCodSection = isset($progCodParts[1]) ? $progCodParts[1] : null;

        // Extract studYear (integer) and studSec (letter) using regex
        $studYear = null;
        $studSec = null;

        if ($progCodSection) {
            preg_match('/^(\d+)-([A-Z]+)$/', $progCodSection, $matches);
            if (!empty($matches)) {
                $studYear = $matches[1]; // Extracts '1' from '1-A'
                $studSec = $matches[2];  // Extracts 'A' from '1-A'
            }
        }

        //\Log::info('Extracted progCod:', [$progCod]);
        //\Log::info('Extracted studYear:', [$studYear]);
        //\Log::info('Extracted studSec:', [$studSec]);

        try {
            $studentIds = DB::connection('enrollment')->table('program_en_history')
                ->where('semester', $semester)
                ->where('schlyear', $schlyear)
                ->where('campus', $campus)
                ->where('progCod', $progCod)
                ->when($studYear, function ($query) use ($studYear) {
                    return $query->where('studYear', '=', $studYear);
                })
                ->when($studSec, function ($query) use ($studSec) {
                    return $query->where('studSec', '=', $studSec);
                })
                ->select('program_en_history.*')
                ->pluck('studentID');

            if ($studentIds->isEmpty()) {
                return response()->json(['data' => [], 'message' => 'No students found'], 200);
            }

            $data = DB::table('qceformevalrate')
                ->whereIn('studidno', $studentIds)
                ->where('statprint', 1)
                ->where('semester', $semester)
                ->where('schlyear', $schlyear)
                ->where('campus', $campus)
                ->get();

            return response()->json(['data' => $data]);

        } catch (\Exception $e) {
            //\Log::error('Database Query Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getevalsubrateprintedlistRead(Request $request) 
    {
        $semester = $request->query('semester');
        $schlyear = $request->query('schlyear');
        $campus = $request->query('campus');
        $progCodRaw = $request->query('progCod');

        // Convert spaces back to `+`
        $progCodRaw = str_replace(' ', '+', $progCodRaw);

        // Extract only the part before "+"
        $progCodParts = explode('+', $progCodRaw);
        $progCod = $progCodParts[0]; // Extract 'CSS-INT-001'

        // Ensure $progCodParts[1] exists before using it
        $progCodSection = isset($progCodParts[1]) ? $progCodParts[1] : null;

        // Extract studYear (integer) and studSec (letter) using regex
        $studYear = null;
        $studSec = null;

        if ($progCodSection) {
            preg_match('/^(\d+)-([A-Z]+)$/', $progCodSection, $matches);
            if (!empty($matches)) {
                $studYear = $matches[1]; // Extracts '1' from '1-A'
                $studSec = $matches[2];  // Extracts 'A' from '1-A'
            }
        }

        //\Log::info('Extracted progCod:', [$progCod]);
        //\Log::info('Extracted studYear:', [$studYear]);
        //\Log::info('Extracted studSec:', [$studSec]);

        try {
            $studentIds = DB::connection('enrollment')->table('program_en_history')
                ->where('semester', $semester)
                ->where('schlyear', $schlyear)
                ->where('campus', $campus)
                ->where('progCod', $progCod)
                ->when($studYear, function ($query) use ($studYear) {
                    return $query->where('studYear', '=', $studYear);
                })
                ->when($studSec, function ($query) use ($studSec) {
                    return $query->where('studSec', '=', $studSec);
                })
                ->pluck('studentID');

            if ($studentIds->isEmpty()) {
                return response()->json(['data' => [], 'message' => 'No students found'], 200);
            }

            $data = DB::table('qceformevalrate')
                ->whereIn('studidno', $studentIds)
                ->where('statprint', 2)
                ->where('semester', $semester)
                ->where('schlyear', $schlyear)
                ->where('campus', $campus)
                ->get();

            return response()->json(['data' => $data]);

        } catch (\Exception $e) {
            //\Log::error('Database Query Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
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

    public function exportPrintEvalPDF(Request $request)
    {
        $semester = $request->query('semester');
        $schlyear = $request->query('schlyear');
        $campus = $request->query('campus');
        $progCod = $request->query('progCod');
        $studYear = $request->query('studYear'); // Fix: Read studYear
        $studSec = $request->query('studSec');
        $studidno = $request->query('studidno');   // Fix: Read studSec

        // Debugging logs
        // \Log::info("Received Parameters: ", [
        //     'progCod' => $progCod,
        //     'studYear' => $studYear,
        //     'studSec' => $studSec,
        //     'schlyear' => $schlyear,
        //     'semester' => $semester,
        //     'campus' => $campus,
        // ]);

        // Check if required parameters are missing
        if (!$progCod || !$studYear || !$studSec || !$schlyear || !$semester || !$campus) {
            return response()->json(['error' => 'Missing required parameters'], 400);
        }

        $inst = QCEinstruction::orderBy('inst_scale', 'DESC')->get();
        $currsem = QCEsemester::where('qcesemstat', 2)->get();
        $quest = QCEquestion::join('qcecategory', 'qcequestion.catName_id', '=', 'qcecategory.id')
                ->select('qcecategory.catName', 'qcequestion.*')
                ->get();
        $facratedQuery = QCEfevalrate::where('semester', $semester)
            ->where('schlyear', $schlyear)
            ->where('campus', $campus);

        if (!empty($studidno)) {
            $facratedQuery->where('studidno', '=', $studidno);
        }

        $facrated = $facratedQuery->get();

        // Load PDF
        $pdf = PDF::loadView('formpdf.qceformpdfrated', compact(
            'inst', 'currsem', 'quest', 'facrated', 'progCod', 'studYear', 'studSec', 'schlyear', 'semester', 'campus'
        ))->setPaper('Legal', 'portrait');

        return $pdf->stream('evaluation.pdf');
    }
}
