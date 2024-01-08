<?php

/*
|--------------------------------------------------------------------------
| SPA Auth Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with '/'.
| These routes use the root namespace 'App\Http\Controllers\Web'.
|
 */

use App\Base\Constants\Auth\Role;

/*
 * These routes are used for web authentication.
 *
 * Route prefix 'api/spa'.
 * Root namespace 'App\Http\Controllers\Web\Admin'.
 */

/**
 * Temporary dummy route for testing SPA.
 */

Route::middleware('auth:web')->group(function () {
Route::namespace('Admin')->group(function () {
         // Adhoc Web Booking 

        Route::post('adhoc-eta','AdhocWebBookingController@eta');
        Route::post('adhoc-create-request','AdhocWebBookingController@createRequest');
        Route::post('adhoc-list-packages','AdhocWebBookingController@listPackages'); 

        Route::post('adhoc-cancel-booking','AdhocWebBookingController@cancelRide');
});
});
Route::namespace('Admin')->group(function () {
	Route::get('web-booking','AdhocWebBookingController@web_booking'); 
	Route::post('Adduser','AdhocWebBookingController@Saveuser');
});