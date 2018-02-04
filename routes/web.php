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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin','HomeController@index');

//Residents
Route::get('/Resident','ResidentController@index');
Route::get('/Resident/Create','ResidentController@create');
Route::get('/Resident/Edit/id={id}','ResidentController@edit');
Route::get('/Resident/Deactivate/id={id}', 'ResidentController@destroy');
Route::get('/Resident/Soft', 'ResidentController@soft');
Route::get('/Resident/Reactivate/id={id}', 'ResidentController@reactivate');

Route::post('/Resident/Store','ResidentController@store');
Route::post('/Resident/Update/id={id}','ResidentController@update');

//Household
Route::get('/Household','HouseholdController@index');
Route::get('/Household/Create','HouseholdController@create');
Route::get('/Household/Inhabitant/id={id}','HouseholdController@inhabitant');
Route::get('/Household/Edit/id={id}','HouseholdController@edit');
Route::get('/Household/Deactivate/id={id}', 'HouseholdController@destroy');
Route::get('/Household/Soft', 'HouseholdController@soft');
Route::get('/Household/Reactivate/id={id}', 'HouseholdController@reactivate');

Route::post('/Household/Store','HouseholdController@store');
Route::post('/Household/Update/id={id}','HouseholdController@update');

//Blotter
Route::get('/Blotter','BlotterController@index');
Route::get('/Blotter/Create','BlotterController@create');