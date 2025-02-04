<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\EvaluationDB\QCEcategory;
use App\Models\EvaluationDB\QCEquestion;


class QuestionController extends Controller
{
    public function questionStore($value='')
    {
        $qcecat = QCEcategory::all();
        return view('manage.question', compact('qcecat'));
    }

    public function getQuestionRead() 
    {
        $data = QCEquestion::join('qcecategory', 'qcequestion.catName_id', '=', 'qcecategory.id')
                ->select('qcecategory.catName', 'qcequestion.*')
                ->get();

        return response()->json(['data' => $data]);
    }

    public function questionCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'catName_id' => 'required',
                'questiontext' => 'required',
            ]);

            $questionName = $request->input('questiontext'); 
            $existingQuesttion = QCEquestion::where('questiontext', $questionName)->first();

            if ($existingQuesttion) {
                return response()->json(['error' => true, 'message' => 'Question already exists'], 404);
            }

            try {
                QCEquestion::create([
                    'catName_id' => $request->input('catName_id'),
                    'questiontext' => $questionName,
                    'postedBy' => 1,
                ]);

                return response()->json(['success' => true, 'message' => 'Category stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Category'], 404);
            }
        }
    }

    public function questionUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'catName_id' => 'required',
            'questiontext' => 'required',
        ]);

        try {
            $questionName = $request->input('questiontext'); 
            $existingQuesttion = QCEquestion::where('questiontext', $questionName)->where('id', '!=', $request->input('id'))->first();

            if ($existingQuesttion) {
                return response()->json(['error' => true, 'message' => 'Question already exists'], 404);
            }

            $cat = QCEquestion::findOrFail($request->input('id'));
            $cat->update([
                'catName_id' => $request->input('catName_id'),
                'questiontext' => $questionName,
                'postedBy' => 1,
        ]);
            return response()->json(['success' => true, 'message' => 'Question update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update Question'], 404);
        }
    }

    public function questionDelete($id) 
    {
        $qcequest = QCEquestion::find($id);
        $qcequest->delete();

        return response()->json(['success'=> true, 'message'=>'Deleted Successfully',]);
    }
}
