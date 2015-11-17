<?php

namespace App\Http\Controllers;

use App\Reg;
use Illuminate\Http\Request;

use App\Http\Requests;

class MessageController extends Controller {
	public function reg( Request $request ) {
		$all = $request->all();

		Reg::create( [
			'reg_id' => $all['regId'],
		] );

		print_r( implode( ' | ', $all ) );
	}
}
