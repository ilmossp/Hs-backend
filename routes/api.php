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



Route::prefix('patients')->group(function () {
    Route::get('/', [PatientController::class, 'getAll']);

    Route::get('{id}', [PatientController::class, 'get']);

    Route::post('create', [PatientController::class, 'save']);

    Route::post('{patient}',[PatientController::class,'update']);

    Route::delete('{patient}',[PatientController::class,'destroy']);

});

Route::prefix('departments')->group(function () {
    Route::get('/', [DepartmentController::class, 'getAll']);

    Route::get('{department}', [DepartmentController::class, 'get']);

    Route::post('create', [DepartmentController::class, 'save']);

    Route::post('{department}',[DepartmentController::class,'update']);

    Route::delete('{department}',[DepartmentController::class,'destroy']);
});
