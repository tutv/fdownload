<?php

/**
 * Created by PhpStorm.
 * User: Tu TV
 * Date: 15/11/2015
 * Time: 3:34 PM
 */

namespace App\Helpers\FGet\Zing;

class ZingMp3 {
	/**
	 *  Key api
	 *
	 * @var string
	 */
	private $KEY_API;
	private $content_API;

	public function __construct( $link ) {
		$this->KEY_API = 'a34811d0cdc52c769a54647b6bde97de';
		$this->getMp3API( $link );
	}

	// http://api.mp3.zing.vn/api/mobile/song/getsonginfo?keycode=fafd463e2131914934b73310aa34a23f&requestdata={"id":"ZW67FWWF"}
	public function getMp3API( $link ) {
		$id       = $this->parseLink( $link );
		$url_api
		          = sprintf( 'http://api.mp3.zing.vn/api/mobile/song/getsonginfo?keycode=%s&requestdata={"id":"%s"}',
			$this->KEY_API, $id );
		$response = f_file_get_contents( $url_api );
		if ( $response['code'] == 200 ) {
			$this->content_API = json_decode( $response['content'] );
		}

		$this->handleAPI();
	}

	public function handleAPI() {
		var_dump( $this->content_API );
	}

	private function parseLink( $link ) {
		$arrTemp = explode( '/', $link );
		$idTemp  = $arrTemp[ count( $arrTemp ) - 1 ];
		$id      = explode( '.', $idTemp )[0];

		return $id;
	}
}