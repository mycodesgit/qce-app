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
}
