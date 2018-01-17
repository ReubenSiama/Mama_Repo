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
Route::get('/newreg','HomeController@newreg'); //This line by Sid
Route::get('/terms', function () {
    return view('terms');
}); //This line by Sid
Route::get('/buyerend', function () {
    return view('Buyer/buyer');
}); //This line by Sid
Route::get('/addprojbuyer', function () {
    return view('Buyer/Addprojbuyer');
}); //This line by Sid
Route::get('/updprojbuyer', function () {
    return view('Buyer/updbuyer');
}); //This line by Sid
Route::get('/enqprojbuyer', function () {
    return view('Buyer/enqprojbuyer');
}); //This line by Sid
Route::get('/repprojbuyer', function () {
    return view('Buyer/buyer');
}); //This line by Sid
Route::get('/', function () {
    return view('welcome');
});

// Shared View
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/authlogin','HomeController@authlogin');

Route::post('/authlogout','HomeController@authlogout')->name('authlogout');

// Admin
Route::group(['middleware' => ['admin']],function(){
	Route::get('/{id}/view','HomeController@viewEmployee');
	Route::get('/masterData','HomeController@masterData');
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
	Route::post('/addState','mamaController@addState');
	Route::post('/addZone','mamaController@addZone');
	Route::get('/amreports','HomeController@getAMReports');
	
	//This lines by Sid
	Route::get('/{id}/updateamdispatch','HomeController@updateamdispatch');
	Route::get('/{id}/updateampay','HomeController@updateampay');
	Route::get('/ampricing','HomeController@ampricing');
	Route::get('/amorders','HomeController@amorders');
	Route::get('/{id}/printLPO','HomeController@printLPO');

	Route::get('/{id}/viewreports','HomeController@getViewReports');
	Route::post('/{uid}/{rid}/giveGrade','mamaController@giveGrade');
});

// Team Leader
Route::group(['middleware' => ['operationTL']],function(){
	Route::get('/teamLead','HomeController@teamLeadHome');
	Route::post('/{id}/assignWards','mamaController@assignWards');
	Route::get('/{id}/viewReport','HomeController@viewLeReport');
	Route::get('/{id}/deleteReportImage', 'HomeController@deleteReportImage');
	Route::get('/{id}/deleteReportImage2','HomeController@deleteReportImage2');
	Route::get('/{id}/deleteReportImage3','HomeController@deleteReportImage3');
	Route::get('/{id}/deleteReportImage4','HomeController@deleteReportImage4');
	Route::get('/{id}/deleteReportImage5','HomeController@deleteReportImage5');
	Route::get('/{id}/deleteReportImage6','HomeController@deleteReportImage6');
	Route::post('/{id}/morningRemark','mamaController@morningRemark');
	Route::post('/{id}/afternoonRemark','mamaController@afternoonRemark');
	Route::post('/{id}/eveningRemark','mamaController@eveningRemark');
	Route::post('/{id}/addTracing','mamaController@addTracing');
	Route::post('/{id}/addComment','mamaController@addComments');
});

// Listing Engineer
Route::group(['middleware' => ['listingEngineer']],function(){
	Route::get('/listingEngineer','HomeController@listingEngineer');
	Route::get('/logistics','HomeController@logistics');
	Route::post('/addProject','mamaController@addProject');
	Route::post('/{id}/updateProject','mamaController@updateProject');
	Route::get('/leDashboard','HomeController@leDashboard');
	Route::get('/projectlist','HomeController@projectList');
	Route::get('/{id}/edit','HomeController@editProject');
	Route::get('/allProjects','HomeController@viewAll');
	Route::get('/{id}/viewDetails','HomeController@viewDetails');
	Route::get('/roads','HomeController@getRoads');
	Route::get('/{road}/projectlist','HomeController@viewProjectList');
	Route::get('/reports','HomeController@getMyReports');
	Route::get('/completed','HomeController@updateAssignment');
	
	//These lines by Sid
	
	Route::get('/{id}/{recid}/viewlog','HomeController@viewlog');
	Route::get('/{id}/confirmdelivery','HomeController@confirmDelivery');
	Route::get('/{id}/logisticdetails','HomeController@logisticdetails');
	Route::get('/{id}/{rqid}/viewrec','HomeController@viewrec');
	Route::get('/{id}/{rqid}/viewOrder','HomeController@viewOrder');
	Route::get('/{road}/logisticsRequirement','HomeController@logisticsRequirement');
	Route::get('/subcat','HomeController@subcat');
	Route::get('/subcatsup','HomeController@subcatsup');
	


	Route::get('/{id}/requirements','HomeController@getRequirements');
	Route::get('/requirementsroads','HomeController@getRequirementRoads');
	Route::get('/{road}/projectrequirement','HomeController@projectRequirement');
	Route::get('/{id}/confirmOrder','HomeController@getConfirmOrder')->name('downloadInvoice');
	Route::get('/{id}/payment','HomeController@getPayment');
	Route::post('/payment/response','HomeController@getPaymentResponse');
	Route::post('/addMorningMeter','mamaController@addMorningMeter');
	Route::post('/addMorningData','mamaController@addMorningData');
	Route::post('/afternoonMeter','mamaController@afternoonMeter');
	Route::post('/afternoonData','mamaController@afternoonData');
	Route::post('/eveningMeter','mamaController@eveningMeter');
	Route::post('/eveningData','mamaController@eveningData');
	Route::post('/{id}/addRequirement','mamaController@addRequirement');
	Route::post('/{id}/placeOrder','mamaController@placeOrder');
	Route::get('/{id}/{rqid}/cancelOrder','mamaController@cancelOrder');
	Route::get('/{id}/{rqid}/editOrder','mamaController@editOrder');
	Route::get('/orderConfirm','mamaController@orderConfirm');
	Route::post('/{id}/confirmOrder','mamaController@confirmOrder');
	Route::post('/posting','mamaController@postOrder');
});

// Sales TL
Route::group(['middleware' => ['salesTL']],function(){
	Route::get('/salesTL','HomeController@getSalesTL');
	Route::post('/{id}/assignWards','mamaController@assignWards');
	Route::get('/{id}/confirmstatus','HomeController@confirmstatus');
	Route::get('/{id}/confirmthis','HomeController@confirmthis');
	Route::get('/{id}/updatestatus','HomeController@updatestatus');
	Route::get('/{id}/updatelocation','HomeController@updatelocation');
});

Route::get('/salesEngineer','HomeController@getSalesEngineer');
Route::get('/{id}/viewReport','HomeController@viewLeReport');

//Buyer End
//Route::post('/buyerend','HomeController@buyerend');