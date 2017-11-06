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
if(env('REDIRECT_HTTPS'))
{
    URL::forceScheme('https');
};

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/about-us', function () { return view('Front-page');});
Route::get('/help', function () { return view('help');});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('forgotpassword/insertemail','UserSecurityQuestionController@showemailpage');

Route::get('forgotpassword/checksecurityquestion','UserSecurityQuestionController@insertcheck');

Route::get('Securityquestions/check/{id}', 'UserSecurityQuestionController@check')->name('check');

Route::get('securityquestions/insertcheck/{id}', 'UserSecurityQuestionController@insertcheck')->name('insertcheck');

Route::resource('securityquestions', 'UserSecurityQuestionController');

Route::resource('attachment', 'DonationRequestController');

Route::resource('/users', 'UserController');

Route::get('organizations/createOrganization', 'OrganizationController@createOrganization');

Route::delete('organizations', 'OrganizationController@destroy');

Route::resource('organizations', 'OrganizationController');

Route::group(['prefix' => 'subscription'], function () {
    Route::get('/', [
        'as' => 'subscription',
        'uses' => 'SubscriptionController@getIndex'
    ]);
    Route::post('/', [

        'uses' => 'SubscriptionController@postJoin'
    ]);
});

Route::post('user/register', 'UserController@create');

Route::get('/organization', 'OrganizationController@index');

Route::post('/organization', 'OrganizationController@create');

// Route::post('/donate', 'DonationRequestController@store')->name('donation');

Route::get('/donationrequests/create', 'DonationRequestController@create')->name('donation');

Route::get('donationrequests/search','DonationRequestController@searchDonationRequest');

Route::get('donationrequests/export', 'DonationRequestController@export');

Route::resource('/donationrequests', 'DonationRequestController');



Route::get('change-password', function() {
    return view('change-password');
})->name('reset-password');

Route::post('change-password', 'Auth\UpdatePasswordController@update');

//Route::get('/emailtemplates/edit/{id}','EmailTemplateController@edit')->name('emailtemplate');

//Route::post('/emailtemplate', 'EmailTemplateController@edit');

Route::get('/emailtemplates/edit/{id}', 'EmailTemplateController@edit');

Route::get('/emailtemplates/editsendmail', 'EmailTemplateController@send');

Route::resource('emailtemplates', 'EmailTemplateController');

//Emails

Route::get('/sendingemail', 'EmailController@manualRequestMail') ->name('approveandsendmail');
Route::get('/emaileditor/editsendmail','EmailTemplateController@send');

//Dashboard

Route::get('/dashboard', 'DashboardController@index') ->name('dashboardindex');

Route::post('/donation/change-status', 'DonationRequestController@changeDonationStatus');

// Rules stuff
Route::get('help', 'RuleEngineController@rulesHelp');
Route::get('runRule', 'RuleEngineController@manualRunRule');
Route::get('runBudgetCheckRule', 'RuleEngineController@runBudgetCheckRule');
Route::get('runMinimumNoticeCheckRule', 'RuleEngineController@runMinimumNoticeCheckRule');
Route::get('saveRule', 'RuleEngineController@saveRule');
Route::get('saveBudgetNotice', 'RuleEngineController@saveBudgetNotice');
Route::get('loadRule', 'RuleEngineController@loadRule');
//Route::get('/rules', 'RuleEngineController@rules');
Route::resource('/rules', 'RuleEngineController');
// Rules stuff// Rules stuff
//Route::get('rules', 'RuleEngineController@rulesGUI');
Route::get('/webhook/chargeSuccess', 'SubscriptionController@chargeSuccess');

Route::get('subscription/popup', 'SubscriptionController@subscribe');

Route::get('compose-email', 'EmailTemplateController@send');
