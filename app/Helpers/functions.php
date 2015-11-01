<?php
/**
 * Created by PhpStorm.
 * User: Tu TV
 * Date: 02/11/2015
 * Time: 1:13 AM
 */

require_once __DIR__ . '/unirest/Unirest.php';

/**
 * Get content from url via unirest.io
 *
 * @param $url
 *
 * @return mixed
 */
function f_file_get_contents( $url ) {
	$obj_unirest = Unirest\Request::get( $url, null, null );
	$content     = $obj_unirest->raw_body;

	return $content;
}

function get404Error() {
	return response()->json( [
		'status' => 'error',
		'msg'    => '404',
	] );
}