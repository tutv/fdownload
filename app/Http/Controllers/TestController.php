<?php

namespace App\Http\Controllers;

use App\UserX;
use DateTimeZone;
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
		$user_x->created_at = $user->getAttribute( 'created_at' )
		                           ->setTimezone( new DateTimeZone( 'Asia/Ho_Chi_Minh' ) )
		                           ->format( 'Y-m-d H:m:i' );
		$user_x->updated_at = $user->getAttribute( 'updated_at' )
		                           ->setTimezone( new DateTimeZone( 'Asia/Ho_Chi_Minh' ) )
		                           ->format( 'Y-m-d H:m:i' );

		$response->user = $user_x;

		return response()->json( $response );
	}

	public function login( Request $request ) {
		$email = $request->input( 'email' );
		$pass  = $request->input( 'password' );

		$users = UserX::all()->where( 'email', $email );

		if ( $users->count() > 0 ) {
			$user = $users->last();

			if ( md5( $pass ) != $user->getAttribute( 'pass' ) ) {
				$response            = new stdClass();
				$response->error     = true;
				$response->error_msg = 'Sai mật cmn khẩu rồi :]]';

				return response()->json( $response );
			}

			$response           = new stdClass();
			$response->error    = false;
			$response->uid      = $user->getAttribute( 'unique_id' );
			$user_x             = new stdClass();
			$user_x->name       = $user->getAttribute( 'name' );
			$user_x->email      = $user->getAttribute( 'email' );
			$user_x->created_at = $user->getAttribute( 'created_at' )
			                           ->setTimezone( new DateTimeZone( 'Asia/Ho_Chi_Minh' ) )
			                           ->format( 'Y-m-d H:m:i' );
			$user_x->updated_at = $user->getAttribute( 'updated_at' )
			                           ->setTimezone( new DateTimeZone( 'Asia/Ho_Chi_Minh' ) )
			                           ->format( 'Y-m-d H:m:i' );

			$response->user = $user_x;

			return response()->json( $response );
		}

		$response        = new stdClass();
		$response->error = true;
		$response->error_msg
		                 = 'Éo có tài khoản này hoặc gõ sai mật cmn khẩu rồi :]]';

		return response()->json( $response );
	}
}
