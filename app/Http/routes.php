<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get( '/', [
	'as'   => 'home',
	'uses' => 'TestController@home'
] );

Route::group( [ 'prefix' => 'api' ], function () {
	Route::group( array( 'prefix' => 'zing' ), function () {
		Route::any( 'mp3', 'ZingController@getZingMp3' );

	} );

	Route::any( 'soundcloud', 'SoundCloudController@getSong' );
} );

Route::post( 'reg', 'MessageController@reg' );

Route::post( 'send', 'MessageController@send' );

Route::group( [ 'prefix' => 'test' ], function () {
	Route::post( 'reg', 'TestController@reg' );
	Route::post( 'login', 'TestController@login' );
} );


Route::get( 'auth/login', [
	'as'   => 'login',
	'uses' => 'Auth\AuthController@getLogin'
] );
Route::post( 'auth/login', 'Auth\AuthController@postLogin' );
Route::get( 'auth/logout', 'Auth\AuthController@getLogout' );

// Registration routes...
Route::get( 'auth/register', [
	'as'   => 'register',
	'uses' => 'Auth\AuthController@getRegister'
] );

Route::post( 'auth/register', 'Auth\AuthController@postRegister' );

Route::get( '/sendMail', 'TestController@sendMail' );

Route::post( 'save', 'TestController@storageFile' );

Route::get( 'time', 'TestController@getTimetable' );