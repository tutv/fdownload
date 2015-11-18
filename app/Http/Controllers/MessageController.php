<?php

namespace App\Http\Controllers;

use App\Reg;
use Illuminate\Http\Request;

use App\Http\Requests;

class MessageController extends Controller {
	var $SERVER_API
		= 'AIzaSyB_zL7aZOpNdgl-PImDmh8n5mLqxMPvGus';

	public function reg( Request $request ) {
		$all = $request->all();

		Reg::create( [
			'reg_id' => $all['regId'],
		] );

		print_r( implode( ' | ', $all ) );
	}

	public function send( Request $request ) {
		$all = $request->all();

		$msg = $all['msg'];
		$id  = $all['id'];

		$url = 'https://android.googleapis.com/gcm/send';

		$headers = [
			'Authorization: key=' . $this->SERVER_API,
			'Content-Type: application/json',
		];

		$fields = array(
			'registration_ids' => $id,
			'data'             => $msg,
		);

		$content = \Unirest\Request::post( $url, $headers, $fields );
		print_r( $content );
	}
}
