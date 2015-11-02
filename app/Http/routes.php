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


		//
		//sdf sdf
		//sdfsdfs
	} );
} );

function countLineTextFile( $path ) {
	$count  = 0;
	$handle = fopen( $path, 'r' );
	while ( ! feof( $handle ) ) {
		$line = fgets( $handle );
		$count ++;
	}

	fclose( $handle );

	return $count;
}
