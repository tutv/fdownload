<?php

namespace App\Http\Controllers;

use App\Helpers\FGet\SoundCloud;
use Illuminate\Http\Request;

use App\Http\Requests;

class SoundCloudController extends Controller {
	function getSong( Request $request ) {
		$url = $request->input( 'url' );

		$soundCloud = new SoundCloud( $url );

		dd( $soundCloud->matchLink() );
	}
}
