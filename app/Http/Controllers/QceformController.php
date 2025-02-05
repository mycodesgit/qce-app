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

class QceformController extends Controller
{
    public function indexformpdf()
    {
        return view('formpdf.qceform');
    }

    public function qceformprintpdf()
    {
        $inst = QCEinstruction::orderBy('inst_scale', 'DESC')->get();

        $quest = QCEquestion::join('qcecategory', 'qcequestion.catName_id', '=', 'qcecategory.id')
                ->select('qcecategory.catName', 'qcequestion.*')
                ->get();


        $data = [
            'inst' => $inst,
            'quest' => $quest
        ];
        
        $pdf = PDF::loadView('formpdf.qceformpdf', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function qceformprintpdfrated()
    {
        $inst = QCEinstruction::orderBy('inst_scale', 'DESC')->get();

        $quest = QCEquestion::join('qcecategory', 'qcequestion.catName_id', '=', 'qcecategory.id')
                ->select('qcecategory.catName', 'qcequestion.*')
                ->get();

        $facrated = QCEfevalrate::all();


        $data = [
            'inst' => $inst,
            'quest' => $quest,
            'facrated' => $facrated
        ];
        
        $pdf = PDF::loadView('formpdf.qceformpdfrated', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
