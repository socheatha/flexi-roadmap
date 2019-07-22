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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
Route::post('refresh', 'PassportController@refresh');
Route::post('user/reset-password', 'PassportController@resetPassword')->name('user.reset-password');
Route::middleware(['auth:api'])->group(function(){
    Route::post('logout', 'PassportController@logout');
    Route::get('user', 'PassportController@show')->name('user.show');
    Route::post('user', 'PassportController@update')->name('user.update');
    Route::post('user/change-password', 'PassportController@changePassword')->name('user.change-password');
});

Route::get('dashboard','DashboardController@index');
Route::get('dashboard/roads','DashboardController@get_roads_change');
Route::post('dashboard/roads','DashboardController@set_roads_change');

Route::resource('roads', 'PolylineController')->except(['create','edit','show']);
Route::get('roads/{road}/prices', 'PolylineController@price');
Route::get('road/options', 'PolylineController@option');

Route::resource('streets', 'StreetController')->except(['create','edit','show']);
Route::resource('directions', 'DirectionController')->except(['create','edit','show']);
Route::resource('bounderies', 'BounderyController')->except(['create','edit','show']);

Route::resource('prices', 'PriceController')->except(['create','edit','show','delete']);
Route::get('prices/charts','PriceController@chart');
Route::get('prices/charts/compare','PriceController@compare');

