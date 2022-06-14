<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('v1/posts/find_playlist', 'App\Http\Controllers\Api\V1\PostController@show');
Route::get('v1/posts', 'App\Http\Controllers\Api\V1\PostController@index');


Route::any('{path}', function ()
{
    return response()->json([
        'message' => 'End Point not found'
    ], 404);
})->where('path', '.*');
