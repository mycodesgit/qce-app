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


class QCEevalformController extends Controller
{
    public function evalsubjfacStore()
    {
        $mysubj = Grade::join('coasv2_db_schedule.sub_offered', 'studgrades.subjID', '=', 'coasv2_db_schedule.sub_offered.id')
                        ->leftJoin('coasv2_db_schedule.subjects', 'coasv2_db_schedule.sub_offered.subCode', '=', 'coasv2_db_schedule.subjects.sub_code')
                        ->leftJoin('coasv2_db_schedule.scheduleclass', 'studgrades.subjID', '=', 'coasv2_db_schedule.scheduleclass.subject_id')
                        ->leftJoin('coasv2_db_schedule.faculty', 'coasv2_db_schedule.scheduleclass.faculty_id', '=', 'coasv2_db_schedule.faculty.id')
                        ->select(
                            'studgrades.*',
                            'studgrades.id as stugdeID',
                            'coasv2_db_schedule.subjects.sub_name',
                            'coasv2_db_schedule.sub_offered.subSec',
                            'coasv2_db_schedule.sub_offered.schlyear',
                            'coasv2_db_schedule.sub_offered.semester',
                            'coasv2_db_schedule.sub_offered.campus',
                            'coasv2_db_schedule.faculty.fname',
                            'coasv2_db_schedule.faculty.lname',
                            'coasv2_db_schedule.faculty.id',
                        )
                        ->where('coasv2_db_schedule.sub_offered.semester', 2)
                        ->where('coasv2_db_schedule.sub_offered.schlyear', '=', '2024-2025')
                        ->where('studgrades.studID', '=', Auth::guard('kioskstudent')->user()->studid)
                        ->groupBy('studgrades.subjID')
                        ->get();
        return view('studevalform.formevalsubjfac', compact('mysubj'));
    }

    public function evalformStore()
    {
        $inst = QCEinstruction::orderBy('inst_scale', 'DESC')->get();
        $currsem = QCEsemester::where('qcesemstat', 2)->get();

        $question = QCEquestion::join('qcecategory', 'qcequestion.catName_id', '=', 'qcecategory.id')
                ->select('qcecategory.catName', 'qcequestion.id', 'qcequestion.questiontext')
                ->orderBy('qcecategory.catName') // Order categories
                ->orderBy('qcequestion.id') // Order questions properly
                ->get()
                ->groupBy('catName');

        return view('studevalform.form_eval', compact('inst', 'currsem', 'question'));
    }

    public function facevalrateformCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                // 'qceschlyearsemID' => 'required',
                // 'schlyear' => 'required',
                // 'semester' => 'required',
                // 'ratingfromto' => 'required',
                // 'question' => 'required|array',
                // 'question_rate' => 'required|array',
                // 'evaluatorname' => 'required',
                // 'evaluatorID' => 'required',
                'qcecomments' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (str_word_count($value) > 50) {
                            $fail("The $attribute must not be more than 50 words.");
                        }
                    }
                ],
            ]);
            
            //try {
                // $existingSurvey = QCEfevalrate::where([
                //     ['title_id', '=', $request->input('title_id')],
                //     ['name', '=', $request->input('name')],
                //     ['office', '=', $request->input('office')],
                //     ['contact_information', '=', $request->input('contact_information')],
                // ])->first();

                // if ($existingSurvey) {
                //     return redirect()->route('formRead')->with('error', 'Duplicate entry detected');
                // }

                QCEfevalrate::create([
                    'qceschlyearsemID' => $request->input('qceschlyearsemID'),
                    'schlyear' => $request->input('schlyear'),
                    'semester' => $request->input('semester'),
                    'ratingfromto' => $request->input('ratingfromto'),
                    'qcefacID' => $request->input('qcefacID'),
                    'qcefacname' => $request->input('qcefacname'),
                    'qceevaluator' => $request->input('qceevaluator'),
                    'question' => json_encode($request->input('question')),
                    'question_rate' => json_encode($request->input('question_rate')),
                    'qcecomments' => $request->input('qcecomments'),
                    'evaluatorname' => $request->input('evaluatorname'),
                    'evaluatorID' => Auth::guard('kioskstudent')->user()->id,
                ]);

                return redirect()->route('successfacevalrateform')->with('success', 'Survey Submitted Successfully');
            //} catch (\Exception $e) {
                return back()->with('error', 'Failed to Submit Survey');
            //}
        }
    }

    public function successfacevalrateform()
    {
        return view('studevalform.form_evalsuccess');
    }

    // public function previewStore()
    // {
    //     $question = QCEquestion::join('qcecategory', 'qcequestion.catName_id', '=', 'qcecategory.id')
    //             ->select('qcecategory.catName', 'qcequestion.id', 'qcequestion.questiontext')
    //             ->orderBy('qcecategory.catName') // Order categories
    //             ->orderBy('qcequestion.id') // Order questions properly
    //             ->get()
    //             ->groupBy('catName');

    //     return view('studevalform.preview', compact('question'));
    // }

    
}
