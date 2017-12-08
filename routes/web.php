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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/addDepartment','mamaController@addDepartment');
Route::post('/deleteDepartment','mamaController@deleteDepartment');
Route::post('/addEmployee','mamaController@addEmployee');
Route::post('/deleteEmployee','mamaController@deleteEmployee');
Route::get('/{id}/view','HomeController@viewEmployee');
Route::post('/{id}/assignDesignation','mamaController@assignDesignation');
Route::get('/teamLead','HomeController@teamLeadHome');
Route::post('/addDesignation','mamaController@addDesignation');
Route::post('/deleteDesignation','mamaController@deleteDesignation');
Route::get('/masterData','HomeController@masterData');
Route::post('/addWard','mamaController@addWard');
Route::post('/addCountry','mamaController@addCountry');
Route::post('/addTerritory','mamaController@addTerritory');
Route::post('/addSubWard','mamaController@addSubWard');
Route::post('/{id}/assignWards','mamaController@assignWards');
Route::get('/listingEngineer','HomeController@listingEngineer');
Route::post('/addProject','mamaController@addProject');
Route::get('/leDashboard','HomeController@leDashboard');
Route::get('/projectlist','HomeController@projectList');
Route::get('/{id}/edit','HomeController@editProject');
Route::post('/{id}/updateProject','mamaController@updateProject');
Route::post('/addState','mamaController@addState');
Route::post('/addZone','mamaController@addZone');
Route::get('/allProjects','HomeController@viewAll');
Route::get('/{id}/viewDetails','HomeController@viewDetails');
Route::get('/roads','HomeController@getRoads');
Route::get('/{road}/projectlist','HomeController@viewProjectList');
Route::get('/reports','HomeController@getMyReports');
Route::get('/completed','HomeController@updateAssignment');