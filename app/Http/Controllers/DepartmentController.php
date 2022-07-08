<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $departments = Department::all();
        return response()->json([
            'data' => $departments,
            'total' => $departments->count()
        ]);
    }

    public function get(Department $department)
    {
        return response()->json(['data' => $department]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $validateDepartment = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:departments|max:255'
            ]
        );
        if ($validateDepartment->fails()) {
            return response()->json(['message' => $validateDepartment->messages()], 400);
        } else {
            Department::create($request->all());
            return response()->json(['message' => 'department added successfully']);
        }
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validateDepartment = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:departments|max:255'
            ]
        );
        if ($validateDepartment->fails()) {
            return response()->json(['message' => $validateDepartment->messages()], 400);
        } else {
            $department->name = $request->name;
            $department->save();
            return response()->json(['messgage' => 'department updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json([
            'message' => 'department deleted successfully'
        ]);
    }
}
