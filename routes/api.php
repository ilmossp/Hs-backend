<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\PatientController;
use App\Models\Department;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users', function () {
    return UserResource::collection(User::all());
});

Route::get('patients',[PatientController::class,'getAll']);

Route::get('patients/{id}',[PatientController::class,'get']);

Route::post('patients/create',[PatientController::class,'save']);

Route::get('departments',[DepartmentController::class,'getAll']);

Route::get('departments/{id}',[DepartmentController::class,'get']);

Route::post('departments/create',[DepartmentController::class,'save']);