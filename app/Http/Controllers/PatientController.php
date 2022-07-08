<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function save(Request $request)
    {
        $validatedPatient = $request->validate([
            'cin' => 'required|unique',
            'city' => 'required|string'
        ]);
        $validatedUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique',
            'password' => 'required'
        ]);

        $patient = Patient::create($validatedPatient);
        $user = $patient->user()->create($validatedUser);
        return response()->json(
            [
                'message' => 'patient created successfully',
            ]
        );
    }


    public function get(Request $request) {
        $patient=User::where('userable_id',$request->id);
        return $patient;
    }

}
