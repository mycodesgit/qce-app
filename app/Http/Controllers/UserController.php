<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\EvaluationDB\User;

class UserController extends Controller
{
    public function userStore() 
    {
        return view("user.listuser");
    }

    public function getUserRead() 
    {
        $data = User::all();

        return response()->json(['data' => $data]);
    }

    public function userCreate(Request $request) 
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'lname' => 'required',
                'fname' => 'required',
                'mname' => 'required',
                'email' => 'required',
                'password' => 'required|string|min:5',
                'dept' => 'required',
                'role' => 'required',
                'campus' => 'required',
            ]);

            $emailName = $request->input('email'); 
            $existingEmail = User::where('email', $emailName)->first();

            if ($existingEmail) {
                return response()->json(['error' => true, 'message' => 'User already exists'], 404);
            }

            try {
                User::create([
                    'lname' => $request->input('lname'),
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'email' => $emailName,
                    'password' => Hash::make($request->input('password')),
                    'dept' => $request->input('dept'),
                    'role' => $request->input('role'),
                    'campus' => $request->input('campus'),
                    'remember_token' => Str::random(60),
                ]);

                return response()->json(['success' => true, 'message' => 'User stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store User'], 404);
            }
        }
    }
}
