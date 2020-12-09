<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['user_authenticate']], function () {
	Route::get('get-student','StudentController@get_student');
	Route::get('get-student-by-id/{id}','StudentController@get_student_by_id');
});

Route::post('create-student','StudentController@create_student');
