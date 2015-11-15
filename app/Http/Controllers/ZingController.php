<?php

namespace App\Http\Controllers;

use App\Helpers\FGet\SoundCloud;
use App\Helpers\FGet\Zing\ZingMp3;
use Illuminate\Http\Request;

class ZingController extends Controller {
	function getZingMp3( Request $request ) {
		$url = $request->input( 'url' );
	}
}
