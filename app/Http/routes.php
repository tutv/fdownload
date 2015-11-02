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

Route::get( '/', function () {
	return view( 'welcome' );
} );

Route::group( [ 'prefix' => 'api' ], function () {
	Route::group( array( 'prefix' => 'zing' ), function () {
		Route::any( 'mp3', 'ZingMp3Controller@getMp3' );

		//Demo ok mensdfsd
		// sdfsdfsdfsdfsdfsfsfsdfsdf
		//sd
		//sdf

		//sdf HEllo
		//sdfsdfs

		$time = date_create()->setTimestamp(1243);
		$time->format('d/y/M');

	} );
} );
