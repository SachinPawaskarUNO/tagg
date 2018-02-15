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
Route::get('/help', function () {
    return view('help');
});
//Route::post('resetuserpassword', function () {event(new NewSubBusiness($user));})


Route::get('/home', 'HomeController@index')->name('home');

Route::get('forgotpassword/insertemail','UserSecurityQuestionController@showemailpage');

Route::get('forgotpassword/checksecurityquestion','UserSecurityQuestionController@insertcheck');

Route::get('Securityquestions/check/{id}', 'UserSecurityQuestionController@check')->name('check');

Route::get('securityquestions/insertcheck/{id}', 'UserSecurityQuestionController@insertcheck')->name('insertcheck');

Route::resource('securityquestions', 'UserSecurityQuestionController');

Route::resource('attachment', 'DonationRequestController');

Route::resource('/users', 'UserController')->middleware('auth');

Route::get('organizations/createOrganization', 'OrganizationController@createOrganization')->middleware('auth');
Route::get('organizations/invitecode/{id}', 'OrganizationController@invitecode')->middleware('auth');
Route::delete('organizations', 'OrganizationController@destroy')->middleware('auth');
Route::resource('organizations', 'OrganizationController')->middleware('auth');

Route::group(['prefix' => 'subscription'], function () {
    Route::get('/', [
        'as' => 'subscription',
        'uses' => 'SubscriptionController@getIndex'
    ])->middleware('auth');
    Route::post('/', [

        'uses' => 'SubscriptionController@postJoin'
    ])->middleware('auth');
});
Route::get('resume', [
    'as' => 'subscription-resume',
    'uses' => 'SubscriptionController@resume'
])->middleware('auth');
Route::get('cancel', [
    'as' => 'subscription-cancel',
    'uses' => 'SubscriptionController@cancel'
])->middleware('auth');
Route::get('applycoupon', [
    'uses' => 'SubscriptionController@applycoupon'
])->middleware('auth');
Route::post('user/register', 'UserController@create');

Route::get('/organization', 'OrganizationController@index')->middleware('auth');

Route::post('/organization', 'OrganizationController@create')->middleware('auth');

Route::get('user/manageusers', 'UserController@indexUsers')->name('indexsubuser')->middleware('auth');

Route::get('user/manageusers/edit/{id}', 'UserController@editSubUser')->name('edituser')->middleware('auth');

Route::post('user/manageusers', 'UserController@updateSubUser')->name('updatesubuser')->middleware('auth');

Route::get('/user/editprofile', 'UserController@editProfile')->name('editprofile')->middleware('auth');
Route::patch('/user/updateprofile', 'UserController@updateProfile')->name('updateprofile')->middleware('auth');

Route::get('/donationrequests/create', 'DonationRequestController@create')->name('donation');

Route::get('/donationrequests/admin', 'DonationRequestController@admin')->middleware('auth');

Route::get('donationrequests/search','DonationRequestController@searchDonationRequest')->middleware('auth');

Route::get('donationrequests/export', 'DonationRequestController@export')->middleware('auth');

Route::get('acknowledgeRequestReceived', 'DonationRequestController@acknowledgeRequestReceived')->name('acknowledgeRequestReceived');

Route::resource('/donationrequests', 'DonationRequestController');

Route::get('change-password', function() {
    return view('change-password');
})->name('reset-password')->middleware('auth');

Route::post('change-password', 'Auth\UpdatePasswordController@update')->middleware('auth');

//Route::get('/emailtemplates/edit/{id}','EmailTemplateController@edit')->name('emailtemplate');

//Route::post('/emailtemplate', 'EmailTemplateController@edit');

Route::get('/emailtemplates/edit/{id}', 'EmailTemplateController@edit')->middleware('auth');

Route::resource('emailtemplates', 'EmailTemplateController')->middleware('auth');

//Emails

Route::get('/sendingemail', 'EmailController@manualRequestMail') ->name('approveandsendmail')->middleware('auth');
Route::get('/emaileditor/editsendmail','EmailTemplateController@send');

//Dashboard

Route::get('/dashboard', 'DashboardController@index') ->name('dashboardindex')->middleware('auth');

Route::post('/donation/change-status', 'DonationRequestController@changeDonationStatus')->middleware('auth');

// Rules stuff
Route::get('help', 'RuleEngineController@rulesHelp');
Route::get('runRule', 'RuleEngineController@manualRunRule')->middleware('auth');
Route::get('runBudgetCheckRule', 'RuleEngineController@runBudgetCheckRule')->middleware('auth');
Route::get('runMinimumNoticeCheckRule', 'RuleEngineController@runMinimumNoticeCheckRule')->middleware('auth');
Route::get('saveRule', 'RuleEngineController@saveRule')->middleware('auth');
Route::get('saveBudgetNotice', 'RuleEngineController@saveBudgetNotice')->middleware('auth');
Route::get('loadRule', 'RuleEngineController@loadRule')->middleware('auth');
//Route::get('/rules', 'RuleEngineController@rules');
Route::resource('/rules', 'RuleEngineController')->middleware('auth');
// Rules stuff// Rules stuff
//Route::get('rules', 'RuleEngineController@rulesGUI');
Route::get('/webhook/chargeSuccess', 'SubscriptionController@chargeSuccess');

Route::get('subscription/popup', 'SubscriptionController@subscribe');

Route::get('compose-email', 'EmailTemplateController@send')->middleware('auth');

//Route::get('/dashboard-taggadmin', 'DashboardController@indexTaggAdmin') ->name('dashboardindex-taggadmin');
Route::get('/organizationdonations/{id}', 'DonationRequestController@showAllDonationRequests')->name('show-donation')->middleware('auth');


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
