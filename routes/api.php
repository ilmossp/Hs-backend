<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\PatientController;
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


Route::get('users',function(){
    return UserResource::collection(User::all());
});

Route::get('fetch_user',);

Route::post('user_create',function(Request $request){
    $validatedUser=$request->validate([
        'name' => 'required',
        'email'=> 'required',
        'password' => 'required'
    ]);
    User::create($validatedUser);
    return response()->json( 
        ['message' => 'user created successfully']
    );
});

Route::post('patient_create',PatientController::class,'PatientController@save');

