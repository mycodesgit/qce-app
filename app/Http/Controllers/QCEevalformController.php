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
use App\Models\EvaluationDB\QCEfevalrate;

class QCEevalformController extends Controller
{
    public function evalformStore()
    {
        $inst = QCEinstruction::orderBy('inst_scale', 'DESC')->get();

        $question = QCEquestion::join('qcecategory', 'qcequestion.catName_id', '=', 'qcecategory.id')
                ->select('qcecategory.catName', 'qcequestion.id', 'qcequestion.questiontext')
                ->orderBy('qcecategory.catName') // Order categories
                ->orderBy('qcequestion.id') // Order questions properly
                ->get()
                ->groupBy('catName');

        return view('studevalform.form_eval', compact('inst', 'question'));
    }

    public function previewStore()
    {
        $question = QCEquestion::join('qcecategory', 'qcequestion.catName_id', '=', 'qcecategory.id')
                ->select('qcecategory.catName', 'qcequestion.id', 'qcequestion.questiontext')
                ->orderBy('qcecategory.catName') // Order categories
                ->orderBy('qcequestion.id') // Order questions properly
                ->get()
                ->groupBy('catName');

        return view('studevalform.preview', compact('question'));
    }

    public function facevalrateformCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'qceschlyearsemID' => 'required',
                'schlyear' => 'required',
                'semester' => 'required',
                'ratingfromto' => 'required',
                'question' => 'required|array',
                'question_rate' => 'required|array',
                'evaluatorname' => 'required',
                'evaluatorID' => 'required',
                'qcecomments' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (str_word_count($value) > 50) {
                            $fail("The $attribute must not be more than 50 words.");
                        }
                    }
                ],
            ]);
            
            try {
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
                    'qceschlyearsemID' => 1,
                    'schlyear' => '2024-2025',
                    'semester' => 2,
                    'ratingfromto' => $request->input('ratingfromto'),
                    'qcefacID' => 1,
                    'qcefacname' => $request->input('qcefacname'),
                    'qceevaluator' => $request->input('qceevaluator'),
                    'question' => json_encode($request->input('question')),
                    'question_rate' => json_encode($request->input('question_rate')),
                    'qcecomments' => $request->input('qcecomments'),
                    'evaluatorname' => 'Juan',
                    'evaluatorID' => 1,
                ]);

                return redirect()->route('dash')->with('success', 'Survey Submitted Successfully');
            } catch (\Exception $e) {
                return redirect()->route('dash')->with('error', 'Failed to Submit Survey');
            }
        }
    }
}
