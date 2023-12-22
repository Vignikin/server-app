<?php
use Illuminate\Support\Facades\Session;

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


/*
 * These routes use the root namespace 'App\Http\Controllers\Web'.
 */
Route::namespace('Web')->group(function () {

    // All the folder based web routes
    include_route_files('web');
    

    Route::get('/', 'FrontPageController@index')->name('index');
    Route::get('/driverpage', 'FrontPageController@driverp')->name('driverpage');
    Route::get('/howdriving', 'FrontPageController@howdrive')->name('howdriving');
    Route::get('/driverrequirements', 'FrontPageController@driverrequirement')->name('driverrequirements');
    Route::get('/safety', 'FrontPageController@safetypage')->name('safety');
    Route::get('/serviceareas', 'FrontPageController@serviceareaspage')->name('serviceareas');
    Route::get('/compliance', 'FrontPageController@complaincepage')->name('complaince');
    Route::get('/privacy', 'FrontPageController@privacypage')->name('privacy');
    Route::get('/terms', 'FrontPageController@termspage')->name('terms');
    Route::get('/dmv', 'FrontPageController@dmvpage')->name('dmv');
    Route::get('/contactus', 'FrontPageController@contactuspage')->name('contactus');
    Route::post('/contactussendmail','FrontPageController@contactussendmailadd')->name('contactussendmail');


    Route::get('mercadopago-checkout',function(){
        return view('mercadopago.checkout');
    });

    Route::get('sadad-checkout',function(){
        return view('sadad.checkout');
    });
     
    
    Route::get('get-country-data','FrontPageController@country_code');
    Route::get('mercadopago-success','MercadopagoController@success');
    Route::post('flutter-wave','MercadopagoController@flutterWaveSuceess');
    


    Route::view("success",'success');
    Route::view("failure",'failure');
    Route::view("pending",'pending');
 
    // Website home route
    //Route::get('/', 'HomeController@index')->name('home');
});
Route::namespace('Web')->group(function () {
Route::get('web-booking','FrontPageController@web_booking'); 
Route::post('Adduser','FrontPageController@Saveuser');
});
// Route::middleware('auth:web')->group(function () {

 
// });