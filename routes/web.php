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

Route::get('/Restricted','Homecontroller@error');
Route::get('/RestrictedAuth','Homecontroller@error2');

Auth::routes();

Route::group(['middleware' => 'App\Http\Middleware\adminMiddleware'], function () {
//Residents
Route::get('/Resident','ResidentController@index');
Route::get('/Resident/NotResident','ResidentController@index2');
Route::get('/Resident/Create','ResidentController@create');
Route::get('/Resident/NotResident/Create','ResidentController@create2');
Route::get('/Resident/Edit/id={id}','ResidentController@edit');
Route::get('/Resident/NotResident/Edit/id={id}','ResidentController@edit2');
Route::get('/Resident/Deactivate/id={id}', 'ResidentController@destroy');
Route::get('/Resident/NotResident/Deactivate/id={id}', 'ResidentController@destroy2');
Route::get('/Resident/Soft', 'ResidentController@soft');
Route::get('/Resident/NotResident/Soft', 'ResidentController@soft2');
Route::get('/Resident/Reactivate/id={id}', 'ResidentController@reactivate');
Route::get('/Resident/NotResident/Reactivate/id={id}', 'ResidentController@reactivate2');

Route::post('/Resident/Store','ResidentController@store');
Route::post('/Resident/NotResident/Store','ResidentController@notResident');
Route::post('/Resident/Update/id={id}','ResidentController@update');
Route::post('/Resident/NotResident/Update/id={id}','ResidentController@update2');

Route::get('/Resident/Mass','ResidentController@remove');
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

//Officer
Route::get('/Officer','OfficerController@index');
Route::get('/Officer/Create','OfficerController@create');
Route::get('/Officer/Edit/id={id}','OfficerController@edit');
Route::get('/Officer/Deactivate/id={id}', 'OfficerController@destroy');
Route::get('/Officer/Soft', 'OfficerController@soft');
Route::get('/Officer/Reactivate/id={id}', 'OfficerController@reactivate');

Route::post('/Officer/Store','OfficerController@store');
Route::post('/Officer/Update/id={id}','OfficerController@update');

//Projects
Route::get('/Project','ProjectController@index');
Route::get('/Project/Create','ProjectController@create');
Route::get('/Project/Edit/id={id}','ProjectController@edit');
Route::get('/Project/Deactivate/id={id}', 'ProjectController@destroy');
Route::get('/Project/Soft', 'ProjectController@soft');
Route::get('/Project/Reactivate/id={id}', 'ProjectController@reactivate');

Route::post('/Project/Store','ProjectController@store');
Route::post('/Project/Update/id={id}','ProjectController@update');

//Business
Route::get('/Business','BusinessController@index');
Route::get('/Business/Create','BusinessController@create');
Route::get('/Business/Edit/id={id}','BusinessController@edit');
Route::get('/Business/Deactivate/id={id}', 'BusinessController@destroy');
Route::get('/Business/Soft', 'BusinessController@soft');
Route::get('/Business/Reactivate/id={id}', 'BusinessController@reactivate');

Route::post('/Business/Store','BusinessController@store');
Route::post('/Business/Update/id={id}','BusinessController@update');
});

Route::group(['middleware' => 'App\Http\Middleware\officerMiddleware'], function () {
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin','HomeController@index');
Route::get('/month','HomeController@month');

//Blotter
Route::get('/Blotter','BlotterController@index');
Route::get('/Blotter/Create','BlotterController@create');
Route::get('/Blotter/Edit/id={id}','BlotterController@edit');
Route::get('/Blotter/Deactivate/id={id}', 'BlotterController@destroy');
Route::get('/Blotter/Soft', 'BlotterController@soft');
Route::get('/Blotter/Reactivate/id={id}', 'BlotterController@reactivate');

Route::post('/Blotter/Store','BlotterController@store');
Route::post('/Blotter/Update/id={id}','BlotterController@update');

//Schedule
Route::get('/Schedule','ScheduleController@index');
Route::get('/Schedule/Create','ScheduleController@create');
Route::get('/Schedule/Edit/id={id}','ScheduleController@edit');
Route::get('/Schedule/Deactivate/id={id}', 'ScheduleController@destroy');
Route::get('/Schedule/Soft', 'ScheduleController@soft');
Route::get('/Schedule/Reactivate/id={id}', 'ScheduleController@reactivate');

Route::post('/Schedule/Store','ScheduleController@store');
Route::post('/Schedule/Update/id={id}','ScheduleController@update');

//Forms
Route::get('/BarangayClearance/Print/{id}','PdfController@index');
Route::get('/BusinessPermit/Print/{id}','PdfController@business');
Route::get('/CertificateIndigency/Print/{id}','PdfController@indigency');
Route::get('/FiletoAction/Print/{id}','PdfController@file');
});













