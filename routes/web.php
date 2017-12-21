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
Route::get('/authlogin','HomeController@authlogin');
Route::post('/authlogout','HomeController@authlogout')->name('authlogout');

Route::post('/addDepartment','mamaController@addDepartment');
Route::post('/deleteDepartment','mamaController@deleteDepartment');
Route::post('/addEmployee','mamaController@addEmployee');
Route::post('/deleteEmployee','mamaController@deleteEmployee');
Route::post('/{id}/assignDesignation','mamaController@assignDesignation');
Route::post('/addDesignation','mamaController@addDesignation');
Route::post('/deleteDesignation','mamaController@deleteDesignation');
Route::post('/addWard','mamaController@addWard');
Route::post('/addCountry','mamaController@addCountry');
Route::post('/addTerritory','mamaController@addTerritory');
Route::post('/addSubWard','mamaController@addSubWard');
Route::post('/{id}/assignWards','mamaController@assignWards');
Route::post('/addProject','mamaController@addProject');
Route::post('/{id}/updateProject','mamaController@updateProject');
Route::post('/addState','mamaController@addState');
Route::post('/addZone','mamaController@addZone');
Route::post('/addMorningMeter','mamaController@addMorningMeter');
Route::post('/addMorningData','mamaController@addMorningData');
Route::post('/afternoonMeter','mamaController@afternoonMeter');
Route::post('/afternoonData','mamaController@afternoonData');
Route::post('/eveningMeter','mamaController@eveningMeter');
Route::post('/eveningData','mamaController@eveningData');
Route::post('/{id}/morningRemark','mamaController@morningRemark');
Route::post('/{id}/afternoonRemark','mamaController@afternoonRemark');
Route::post('/{id}/eveningRemark','mamaController@eveningRemark');
Route::post('/{id}/addRequirement','mamaController@addRequirement');
Route::post('/{id}/placeOrder','mamaController@placeOrder');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{id}/view','HomeController@viewEmployee');
Route::get('/teamLead','HomeController@teamLeadHome');
Route::get('/masterData','HomeController@masterData');
Route::get('/listingEngineer','HomeController@listingEngineer');
Route::get('/leDashboard','HomeController@leDashboard');
Route::get('/projectlist','HomeController@projectList');
Route::get('/{id}/edit','HomeController@editProject');
Route::get('/allProjects','HomeController@viewAll');
Route::get('/{id}/viewDetails','HomeController@viewDetails');
Route::get('/roads','HomeController@getRoads');
Route::get('/{road}/projectlist','HomeController@viewProjectList');
Route::get('/reports','HomeController@getMyReports');
Route::get('/completed','HomeController@updateAssignment');
Route::get('/{id}/viewReport','HomeController@viewLeReport');
Route::get('/{id}/requirements','HomeController@getRequirements');
Route::get('/requirementsroads','HomeController@getRequirementRoads');
Route::get('/{road}/projectrequirement','HomeController@projectRequirement');
Route::get('/{id}/deleteReportImage','HomeController@deleteReportImage');
Route::get('/{id}/deleteReportImage2','HomeController@deleteReportImage2');
Route::get('/{id}/deleteReportImage3','HomeController@deleteReportImage3');
Route::get('/{id}/deleteReportImage4','HomeController@deleteReportImage4');
Route::get('/{id}/deleteReportImage5','HomeController@deleteReportImage5');
Route::get('/{id}/deleteReportImage6','HomeController@deleteReportImage6');