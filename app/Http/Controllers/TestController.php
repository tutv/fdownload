<?php

namespace App\Http\Controllers;

use App\UserX;
use Illuminate\Http\Request;

use App\Http\Requests;
use stdClass;

class TestController extends Controller {
	public function reg( Request $request ) {
		$email = $request->input( 'email' );
		$name  = $request->input( 'name' );
		$pass  = $request->input( 'password' );

		$user = UserX::create( [
			'email'     => $email,
			'name'      => $name,
			'pass'      => md5( $pass ),
			'unique_id' => uniqid( '', true ),
		] );

		$response           = new stdClass();
		$response->error    = false;
		$response->uid      = $user->getAttribute( 'unique_id' );
		$user_x             = new stdClass();
		$user_x->name       = $user->getAttribute( 'name' );
		$user_x->email      = $user->getAttribute( 'email' );
		$user_x->created_at = $user->getAttributeValue( 'created_at' );
		$user_x->updated_at = $user->getAttributeValue( 'updated_at' );
		$response->user     = $user_x;

		return response()->json( $response );
	}
}
