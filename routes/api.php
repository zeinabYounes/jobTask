<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JWTAuthController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });apiPass
Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::group(['middleware'=>['JWTAuth','apiPass'],'namespace'=>'Api'],function(){
  Route::post('/posts','PostController@index');
  Route::post('logout','AuthController@logout');
});
// Route::get('/welcome', function () {
//     return Json_encode('welcome');
// });
