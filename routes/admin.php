<?php
/**
 * Admin Routes
 */

Route::group([
     'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.',
     'middleware' => ['role:admin'],
 ], function () {
    Route::resource('airports', 'AirportController');
    Route::resource('airlines', 'AirlinesController');
    Route::resource('aircraftclasses', 'AircraftClassController');
    Route::resource('fares', 'FareController');

    # subfleet
    Route::resource('subfleets', 'SubfleetController');
    Route::match(['get', 'post', 'put', 'delete'], 'subfleets/{id}/fares', 'SubfleetController@fares');

    # aircraft and fare associations
    Route::resource('aircraft', 'AircraftController');

    # flights and aircraft associations
    Route::resource('flights', 'FlightController');
    Route::match(['get', 'post', 'put', 'delete'], 'flights/{id}/subfleets', 'FlightController@subfleets');

    # rankings
    Route::resource('ranks', 'RankController');

    # view/update settings
    Route::match(['get'], 'settings', 'SettingsController@index');
    Route::match(['post', 'put'], 'settings', 'SettingsController@update');

    # defaults
    Route::get('', ['uses' => 'DashboardController@index']);
    Route::get('/', ['uses' => 'DashboardController@index']);
    Route::get('/dashboard', ['uses' => 'DashboardController@index', 'name' => 'dashboard']);
});
