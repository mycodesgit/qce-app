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

class CategoryController extends Controller
{
    public function categoryStore()
    {
        return view('manage.category');
    }

    public function getcategoryRead() 
    {
        $data = QCEcategory::orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }

    public function categoryCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'catName' => 'required',
            ]);

            $categoryName = $request->input('catName'); 
            $existingCat = QCEcategory::where('catName', $categoryName)->first();

            if ($existingCat) {
                return response()->json(['error' => true, 'message' => 'Category already exists'], 404);
            }

            try {
                QCEcategory::create([
                    'catName' => $request->input('catName'),
                    'postedBy' => 1,
                ]);

                return response()->json(['success' => true, 'message' => 'Category stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Category'], 404);
            }
        }
    }

    public function categoryUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'catName' => 'required',
        ]);

        try {
            $categoryName = $request->input('catName'); 
            $existingCat = QCEcategory::where('catName', $categoryName)->where('id', '!=', $request->input('id'))->first();

            if ($existingCat) {
                return response()->json(['error' => true, 'message' => 'Category already exists'], 404);
            }

            $cat = QCEcategory::findOrFail($request->input('id'));
            $cat->update([
                'catName' => $categoryName,
                'postedBy' => 1,
        ]);
            return response()->json(['success' => true, 'message' => 'Category update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update Category'], 404);
        }
    }

    public function categoryDelete($id) 
    {
        $qcecat = QCEcategory::find($id);
        $qcecat->delete();

        return response()->json(['success'=> true, 'message'=>'Deleted Successfully',]);
    }
}
