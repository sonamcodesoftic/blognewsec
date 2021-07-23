<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
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



Route::post('register', [RegisterController::class, 'register']);                            // Route for Register
Route::post('login', [RegisterController::class, 'login']);                                  // Route for Login
Route::get('Users', 'App\Http\Controllers\API\RegisterController@showusersdata');            // Route to check All Users Data
Route::get('user/{id}', 'App\Http\Controllers\API\RegisterController@User_id');              // Route to find user by id
Route::post('Updae/{id}','App\Http\Controllers\API\RegisterController@Updateuserdata');      // Route to update User data
Route::post('newuser', 'App\Http\Controllers\API\RegisterController@newuser');               // Route To add New user by admin
Route::get('Profile', 'App\Http\Controllers\API\RegisterController@newuser');                // Route for Profile
// Route::get('logout', 'App\Http\Controllers\API\RegisterController@logout');               // Route For Logout
Route::post('updatepassword{id}', 'App\Http\Controllers\API\RegisterController@changepassword'); //route For Chage password


Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
});
