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


Route::resource('users', 'UserAPIController');

Route::resource('workers', 'WorkerAPIController');

Route::resource('space_types', 'SpaceTypeAPIController');

Route::resource('spaces', 'SpaceAPIController');

Route::resource('shift_types', 'ShiftTypeAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('reservations', 'ReservationAPIController');

Route::resource('payments', 'PaymentAPIController');

Route::resource('maintenances', 'MaintenanceAPIController');

Route::resource('maintainers', 'MaintainerAPIController');

Route::resource('expenses', 'ExpenseAPIController');

Route::resource('calendars', 'CalendarAPIController');

Route::resource('buildings', 'BuildingAPIController');

Route::resource('assistances', 'AssistanceAPIController');

Route::resource('articles', 'ArticleAPIController');

Route::resource('apartments', 'ApartmentAPIController');