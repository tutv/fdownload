<?php
/**
 * Created by PhpStorm.
 * User: Tu TV
 * Date: 20/11/2015
 * Time: 8:07 AM
 */

require_once __DIR__ . '/FriesMail/FriesMail.php';

/**
 * Send mail
 *
 * @param FriesMail $friesMail
 */
function sendMail( FriesMail $friesMail ) {
	$url  = 'https://api.sendgrid.com/';
	$user = 'tutv95';
	$pass = 'hackathonuet2015';

	$json_string = array(

		'to'       => $friesMail->getTo(),
		'category' => 'confirmed_account'
	);

	$params = array(
		'api_user'  => $user,
		'api_key'   => $pass,
		'x-smtpapi' => json_encode( $json_string ),
		'to'        => 'fries.uet@gmail.com',
		'subject'   => $friesMail->getSubject(),
		'html'      => $friesMail->getHtml(),
		'text'      => $friesMail->getText(),
		'from'      => $friesMail->getFrom(),
		'fromname'  => $friesMail->getFromName(),
	);

	$request = $url . 'api/mail.send.json';

	// Generate curl request
	$session = curl_init( $request );
	curl_setopt( $session, CURLOPT_POST, true );
	curl_setopt( $session, CURLOPT_POSTFIELDS, $params );
	curl_setopt( $session, CURLOPT_HEADER, false );
	curl_setopt( $session, CURLOPT_SSLVERSION, 6 );
	curl_setopt( $session, CURLOPT_RETURNTRANSFER, true );
	$response = curl_exec( $session );
	curl_close( $session );

	print_r( $response );
}
