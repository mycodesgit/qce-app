<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\EvaluationDB\QCEinstruction;

class InstructionController extends Controller
{
    public function instructionStore()
    {
        return view('manage.instruction');
    }

    public function getInstructionRead() 
    {
        $data = QCEinstruction::orderBy('inst_scale', 'DESC')->get();

        return response()->json(['data' => $data]);
    }

    public function instructionCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'inst_scale' => 'required',
                'inst_descRating' => 'required',
                'inst_qualDescription' => 'required',
            ]);

            $instructScale = $request->input('inst_scale');
            $instructdescRating = $request->input('inst_descRating');
            $instructqualDescription = $request->input('inst_qualDescription'); 

            $existingInstruction = QCEinstruction::where('inst_scale', $instructScale)
                                ->where('inst_descRating', $instructdescRating)
                                ->where('inst_qualDescription', $instructqualDescription)
                                ->first();

            if ($existingInstruction) {
                return response()->json(['error' => true, 'message' => 'Instruction already exists'], 404);
            }

            try {
                QCEinstruction::create([
                    'inst_scale' => $instructScale,
                    'inst_descRating' => $instructdescRating,
                    'inst_qualDescription' => $instructqualDescription,
                    'postedBy' => 1,
                ]);

                return response()->json(['success' => true, 'message' => 'Instruction stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Instruction'], 404);
            }
        }
    }

    public function instructionUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'inst_scale' => 'required',
            'inst_descRating' => 'required',
            'inst_qualDescription' => 'required',
        ]);

        try {
            $instructScale = $request->input('inst_scale');
            $instructdescRating = $request->input('inst_descRating');
            $instructqualDescription = $request->input('inst_qualDescription'); 

            $existingInstruction = QCEinstruction::where('inst_scale', $instructScale)
                                ->where('inst_descRating', $instructdescRating)
                                ->where('inst_qualDescription', $instructqualDescription)
                                ->where('id', '!=', $request->input('id'))
                                ->first();

            if ($existingInstruction) {
                return response()->json(['error' => true, 'message' => 'Instruction already exists'], 404);
            }

            $inst = QCEinstruction::findOrFail($request->input('id'));
            $inst->update([
                'inst_scale' => $instructScale,
                'inst_descRating' => $instructdescRating,
                'inst_qualDescription' => $instructqualDescription,
                'postedBy' => 1,
        ]);
            return response()->json(['success' => true, 'message' => 'Instruction update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update Instruction'], 404);
        }
    }

    public function instructionDelete($id) 
    {
        $qceinst = QCEinstruction::find($id);
        $qceinst->delete();

        return response()->json(['success'=> true, 'message'=>'Deleted Successfully',]);
    }
}
