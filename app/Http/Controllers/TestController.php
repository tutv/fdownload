<?php

namespace App\Http\Controllers;

use App\UserX;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller {
	public function reg( Request $request ) {
		$email = $request->input( 'email' );
		$name  = $request->input( 'name' );
		$pass  = $request->input( 'password' );

		$user = UserX::create( [
			'email' => $email,
			'name'  => $name,
			'pass'  => md5( $pass ),
		] );

		dd( $user );
	}
}
