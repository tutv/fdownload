<?php

namespace App\Http\Controllers;

use App\Reg;
use Illuminate\Http\Request;

use App\Http\Requests;

class MessageController extends Controller {
	var $SERVER_API
		= 'AIzaSyCDeGf6oM1tCyuxaH9sgDyV-in1sIEZwFY';

	public function reg( Request $request ) {
		$all = $request->all();

		Reg::create( [
			'reg_id' => $all['regId'],
		] );

		print_r( implode( ' | ', $all ) );
	}

	public function send( Request $request ) {
		$all = $request->all();

		$id = $all['id'];
		$this->send_push_notification( $id, $all['msg'] );
	}

	function send_push_notification( $registatoin_ids, $message ) {
		// Set POST variables
		$url = 'https://android.googleapis.com/gcm/send';

		$fields = array(
			'registration_ids' => [ $registatoin_ids ],
			'data'             => [ 'message' => $message ],
		);

		$headers = array(
			'Authorization: key=AIzaSyCDeGf6oM1tCyuxaH9sgDyV-in1sIEZwFY',
			'Content-Type: application/json'
		);
		//print_r($headers);
		// Open connection
		$ch = curl_init();

		// Set the url, number of POST vars, POST data
		curl_setopt( $ch, CURLOPT_URL, $url );

		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		// Disabling SSL Certificate support temporarly
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

		// Execute post
		$result = curl_exec( $ch );
		if ( $result === false ) {
			die( 'Curl failed: ' . curl_error( $ch ) );
		}

		// Close connection
		curl_close( $ch );
		print_r( json_decode( $result ) );
	}
}
