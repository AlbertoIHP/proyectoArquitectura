<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect('home');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UserController');

Route::resource('workers', 'WorkerController');

Route::resource('spaceTypes', 'SpaceTypeController');

Route::resource('spaces', 'SpaceController');

Route::resource('shiftTypes', 'ShiftTypeController');

Route::resource('roles', 'RoleController');

Route::resource('reservations', 'ReservationController');

Route::resource('payments', 'PaymentController');

Route::resource('maintenances', 'MaintenanceController');

Route::resource('maintainers', 'MaintainerController');

Route::resource('expenses', 'ExpenseController');

Route::resource('calendars', 'CalendarController');

Route::resource('buildings', 'BuildingController');

Route::resource('assistances', 'AssistanceController');

Route::resource('articles', 'ArticleController');

Route::resource('apartments', 'ApartmentController');