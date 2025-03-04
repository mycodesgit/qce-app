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
use App\Models\ScheduleDB\FacDesignation;
use App\Models\ScheduleDB\Subject;
use App\Models\ScheduleDB\SubjectOffered;

class ReportsSummaryEvalController extends Controller
{
    public function  summaryEvalStore()
    {
        $currsem = QCEsemester::select('id', 'qceschlyear')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('qceschlyearsem')
                    ->groupBy('qceschlyear');
            })
            ->orderBy('id', 'DESC')
            ->get();

        return view('reports.reportsqcesummary', compact('currsem'));
    }

    public function  summaryEvalFilter(Request $request)
    {
        $currsem = QCEsemester::select('id', 'qceschlyear')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('qceschlyearsem')
                    ->groupBy('qceschlyear');
            })
            ->orderBy('id', 'DESC')
            ->get();

        return view('reports.reportsqcesummary_searchresult', compact('currsem'));
    }

    public function getFacultycamp(Request $request)
    {
        $campus = $request->campus;

        $faclty = Faculty::join('addressee', 'faculty.adrID', '=', 'addressee.id')
            ->join('college', 'faculty.dept', '=', 'college.college_abbr')
            ->where('faculty.campus', $campus)
            ->select('faculty.*', 'faculty.id as fctyid', 'faculty.campus as fcamp', 'college.*', 'addressee.*', 'addressee.id as adrid')
            ->orderBy('faculty.lname')
            ->get();

        return response()->json($faclty);
    }

    public function gensummaryevalPDF(Request $request)
    {
        $campus = $request->query('campus');
        $schlyear = $request->query('schlyear');
        $semester = $request->query('semester');
        $faclty = $request->query('faclty');

        $fcs = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->first(); // Use get() to handle multiple records

        // Fetch all evaluations where the evaluator role is 'Student'
        $facsum = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->where('qceevaluator', 'Student') // Ensure only Student responses are fetched
            ->get(); // Use get() to handle multiple records

        if ($facsum->isEmpty()) {
            return response()->json(['error' => 'No Student records found'], 404);
        }

        // Initialize an array to store students' data
        $students = [];

        // Define categories with corresponding question IDs
        $categories = [
            'Commitment' => [1, 2, 3, 4, 5],
            'Knowledge of Subject' => [8, 9, 10, 11, 12],
            'Teaching for Independent Learning' => [13, 14, 15, 16, 17],
            'Management of Learning' => [18, 19, 20, 21, 22],
        ];

        // Initialize category totals
        $category_totals = [
            'Commitment' => 0,
            'Knowledge of Subject' => 0,
            'Teaching for Independent Learning' => 0,
            'Management of Learning' => 0,
        ];

        // Loop through each student's evaluation record
        foreach ($facsum as $record) {
            $ratings = json_decode($record->question_rate, true); // Convert JSON to array
            $student_data = [
                'id' => $record->studidno, // Use `studidno` for student ID
            ];

            $total_score = 0;

            // Sum ratings per category for the student
            foreach ($categories as $category => $question_ids) {
                $category_sum = 0;
                foreach ($question_ids as $question_id) {
                    if (isset($ratings[$question_id])) {
                        $category_sum += $ratings[$question_id];
                    }
                }
                $student_data[$category] = $category_sum;
                $category_totals[$category] += $category_sum; // Add to totals
                $total_score += $category_sum;
            }

            $student_data['TOTAL'] = $total_score;
            $students[] = $student_data;
        }

        // Calculate the average for TOTAL row
        $num_students = count($students);
        if ($num_students > 0) {
            foreach ($category_totals as $category => $sum) {
                $category_totals[$category] = round($sum / $num_students, 2); // Get average
            }
        }

        $total_student_eval = array_sum($category_totals);

        // Fetch supervisor's evaluation (assuming role is 'Supervisor')
        $supervisor_record = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->where('qceevaluator', 'Supervisor') // Fetch supervisor role
            ->first();

        $supervisor = [
            'Commitment' => 0,
            'Knowledge of Subject' => 0,
            'Teaching for Independent Learning' => 0,
            'Management of Learning' => 0,
            'TOTAL' => 0,
        ];

        $supervisor_total = 0;

        if ($supervisor_record) {
            $ratings = json_decode($supervisor_record->question_rate, true);
            $supervisor_total = 0;
            foreach ($categories as $category => $question_ids) {
                $category_sum = 0;
                foreach ($question_ids as $question_id) {
                    if (isset($ratings[$question_id])) {
                        $category_sum += $ratings[$question_id];
                    }
                }
                $supervisor[$category] = $category_sum;
                $supervisor_total += $category_sum;
            }
            $supervisor['TOTAL'] = $supervisor_total;
        }

        session([
            'total_student_eval' => $total_student_eval,
            'supervisor_total' => $supervisor_total,
            'semester' => $semester,
        ]);

        // Pass data to view
        $data = [
            'fcs' => $fcs,
            'students' => $students,
            'category_totals' => $category_totals,
            'supervisor' => $supervisor,
            'total_student_eval' => $total_student_eval,
            'supervisor_total' => $supervisor_total,
        ];

        $pdf = PDF::loadView('reports.formpdf.pdfsummaryeval', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function gencommentsevalPDF(Request $request)
    {
        $campus = $request->query('campus');
        $schlyear = $request->query('schlyear');
        $semester = $request->query('semester');
        $faclty = $request->query('faclty');

        $facsum = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->first();

        if (!$facsum) {
            return response()->json(['error' => 'No record found'], 404);
        }

        $studcomments = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->where('qceevaluator', 'Student')
            ->get();
        
        $supercomments = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->where('qceevaluator', 'Supervisor')
            ->get();

        $data = [
            'facsum' => $facsum,
            'studcomments' => $studcomments,
            'supercomments' => $supercomments,
        ];

        $pdf = PDF::loadView('reports.formpdf.pdfComments', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function genpointsevalPDF(Request $request)
    {
        $campus = $request->query('campus');
        $schlyear = $request->query('schlyear');
        $semester = $request->query('semester');
        $faclty = $request->query('faclty');

        $facId = DB::connection('schedule')->table('faculty')
            ->where('id', $faclty)
            ->first();
                    
        $facDean = QCEfevalrate::where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->first();
        
        $facDesignateId = DB::connection('schedule')->table('fac_designation')
            ->join('college', 'fac_designation.facdept', '=', 'college.college_abbr')
            ->join('faculty', 'fac_designation.fac_id', '=', 'faculty.id')
            ->where('fac_designation.schlyear', $schlyear)
            ->where('fac_designation.semester', $semester)
            ->where('fac_designation.facdept', $facDean->prog)
            ->first();

        $fcs = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->first(); // Use get() to handle multiple records

        // Fetch all evaluations where the evaluator role is 'Student'
        $facsum = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->where('qceevaluator', 'Student') // Ensure only Student responses are fetched
            ->get(); // Use get() to handle multiple records

        if ($facsum->isEmpty()) {
            return response()->json(['error' => 'No Student records found'], 404);
        }

        // Initialize an array to store students' data
        $students = [];

        // Define categories with corresponding question IDs
        $categories = [
            'Commitment' => [1, 2, 3, 4, 5],
            'Knowledge of Subject' => [8, 9, 10, 11, 12],
            'Teaching for Independent Learning' => [13, 14, 15, 16, 17],
            'Management of Learning' => [18, 19, 20, 21, 22],
        ];

        // Initialize category totals
        $category_totals = [
            'Commitment' => 0,
            'Knowledge of Subject' => 0,
            'Teaching for Independent Learning' => 0,
            'Management of Learning' => 0,
        ];

        // Loop through each student's evaluation record
        foreach ($facsum as $record) {
            $ratings = json_decode($record->question_rate, true); // Convert JSON to array
            $student_data = [
                'id' => $record->studidno, // Use `studidno` for student ID
            ];

            $total_score = 0;

            // Sum ratings per category for the student
            foreach ($categories as $category => $question_ids) {
                $category_sum = 0;
                foreach ($question_ids as $question_id) {
                    if (isset($ratings[$question_id])) {
                        $category_sum += $ratings[$question_id];
                    }
                }
                $student_data[$category] = $category_sum;
                $category_totals[$category] += $category_sum; // Add to totals
                $total_score += $category_sum;
            }

            $student_data['TOTAL'] = $total_score;
            $students[] = $student_data;
        }

        // Calculate the average for TOTAL row
        $num_students = count($students);
        if ($num_students > 0) {
            foreach ($category_totals as $category => $sum) {
                $category_totals[$category] = round($sum / $num_students, 2); // Get average
            }
        }

        $total_student_eval = array_sum($category_totals);

        // Fetch supervisor's evaluation (assuming role is 'Supervisor')
        $supervisor_record = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->where('qceevaluator', 'Supervisor') // Fetch supervisor role
            ->first();

        $supervisor = [
            'Commitment' => 0,
            'Knowledge of Subject' => 0,
            'Teaching for Independent Learning' => 0,
            'Management of Learning' => 0,
            'TOTAL' => 0,
        ];

        $supervisor_total = 0;

        if ($supervisor_record) {
            $ratings = json_decode($supervisor_record->question_rate, true);
            $supervisor_total = 0;
            foreach ($categories as $category => $question_ids) {
                $category_sum = 0;
                foreach ($question_ids as $question_id) {
                    if (isset($ratings[$question_id])) {
                        $category_sum += $ratings[$question_id];
                    }
                }
                $supervisor[$category] = $category_sum;
                $supervisor_total += $category_sum;
            }
            $supervisor['TOTAL'] = $supervisor_total;
        }

        session([
            'total_student_eval' => $total_student_eval,
            'supervisor_total' => $supervisor_total,
            'semester' => $semester,
        ]);

        // Pass data to view
        $data = [
            'fcs' => $fcs,
            'students' => $students,
            'category_totals' => $category_totals,
            'supervisor' => $supervisor,
            'total_student_eval' => $total_student_eval,
            'supervisor_total' => $supervisor_total,
            'facId' => $facId,
            'facDesignateId' => $facDesignateId,
        ];

        $pdf = PDF::loadView('reports.formpdf.pdfPoints', $data)->setPaper('Legal', 'landscape');
        return $pdf->stream();
    }

    public function gensumsheetevalPDF(Request $request)
    {
        $campus = $request->query('campus');
        $schlyear = $request->query('schlyear');
        $semester = $request->query('semester');
        $faclty = $request->query('faclty');

        $fcs = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->first(); // Use get() to handle multiple records

        // Fetch all evaluations where the evaluator role is 'Student'
        $facsum = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->where('qceevaluator', 'Student') // Ensure only Student responses are fetched
            ->get(); // Use get() to handle multiple records

        if ($facsum->isEmpty()) {
            return response()->json(['error' => 'No Student records found'], 404);
        }

        // Initialize an array to store students' data
        $students = [];

        // Define categories with corresponding question IDs
        $categories = [
            'Commitment' => [1, 2, 3, 4, 5],
            'Knowledge of Subject' => [8, 9, 10, 11, 12],
            'Teaching for Independent Learning' => [13, 14, 15, 16, 17],
            'Management of Learning' => [18, 19, 20, 21, 22],
        ];

        // Initialize category totals
        $category_totals = [
            'Commitment' => 0,
            'Knowledge of Subject' => 0,
            'Teaching for Independent Learning' => 0,
            'Management of Learning' => 0,
        ];

        // Loop through each student's evaluation record
        foreach ($facsum as $record) {
            $ratings = json_decode($record->question_rate, true); // Convert JSON to array
            $student_data = [
                'id' => $record->studidno, // Use `studidno` for student ID
            ];

            $total_score = 0;

            // Sum ratings per category for the student
            foreach ($categories as $category => $question_ids) {
                $category_sum = 0;
                foreach ($question_ids as $question_id) {
                    if (isset($ratings[$question_id])) {
                        $category_sum += $ratings[$question_id];
                    }
                }
                $student_data[$category] = $category_sum;
                $category_totals[$category] += $category_sum; // Add to totals
                $total_score += $category_sum;
            }

            $student_data['TOTAL'] = $total_score;
            $students[] = $student_data;
        }

        // Calculate the average for TOTAL row
        $num_students = count($students);
        if ($num_students > 0) {
            foreach ($category_totals as $category => $sum) {
                $category_totals[$category] = round($sum / $num_students, 2); // Get average
            }
        }

        // Fetch supervisor's evaluation (assuming role is 'Supervisor')
        $supervisor_record = QCEfevalrate::where('campus', $campus)
            ->where('schlyear', $schlyear)
            ->where('semester', $semester)
            ->where('qcefacID', $faclty)
            ->where('qceevaluator', 'Supervisor') // Fetch supervisor role
            ->first();

        $supervisor = [
            'Commitment' => 0,
            'Knowledge of Subject' => 0,
            'Teaching for Independent Learning' => 0,
            'Management of Learning' => 0,
            'TOTAL' => 0,
        ];

        if ($supervisor_record) {
            $ratings = json_decode($supervisor_record->question_rate, true);
            $supervisor_total = 0;
            foreach ($categories as $category => $question_ids) {
                $category_sum = 0;
                foreach ($question_ids as $question_id) {
                    if (isset($ratings[$question_id])) {
                        $category_sum += $ratings[$question_id];
                    }
                }
                $supervisor[$category] = $category_sum;
                $supervisor_total += $category_sum;
            }
            $supervisor['TOTAL'] = $supervisor_total;
        }

        // Pass data to view
        $data = [
            'fcs' => $fcs,
            'students' => $students,
            'category_totals' => $category_totals,
            'supervisor' => $supervisor,
        ];

        $pdf = PDF::loadView('reports.formpdf.pdfSumSheet', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
