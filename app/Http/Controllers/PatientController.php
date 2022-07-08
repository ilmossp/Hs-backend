<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cin' => 'required|unique:patients',
            'city' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        } else {
            $colRequest = collect($request->all());
            $patient = Patient::create($colRequest->only(['cin', 'city'])->toArray());
            $patient->user()->create($colRequest->only(['name', 'email', 'password'])->toArray());
            return response()->json(['message' => 'user created successfully']);
        }
    }

    public function getAll()
    {
        $patients = User::where('userable_type', 'App\Models\Patient')->paginate(5);
        return response()->json([
            'patients' => $patients
        ]);
    }

    public function get($id)
    {
        $patient = User::where('userable_id', $id)->first();
        if($patient==null){
            return response()->json(['message'=>'patient not found'],404);
        }
        else{
            return response()->json([
                'patient' => $patient
            ]);
        }
    }
}
