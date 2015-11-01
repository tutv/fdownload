<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZingMp3 extends Model {
	const KEY_API = 'fafd463e2131914934b73310aa34a23f';

	// http://api.mp3.zing.vn/api/mobile/song/getsonginfo?keycode=fafd463e2131914934b73310aa34a23f&requestdata={"id":"ZW67FWWF"}
	public function getMp3API( $link ) {
		$id      = $this->parseLink( $link );
		$url_api
		         = sprintf( 'http://api.mp3.zing.vn/api/mobile/song/getsonginfo?keycode=%s&requestdata={"id":"%s"}',
			self::KEY_API, $id );
		$content = f_file_get_contents( $url_api );
		$obj     = json_decode( $content );

		return $obj;
	}

	private function parseLink( $link ) {
		$arrTemp = explode( '/', $link );
		$idTemp  = $arrTemp[ count( $arrTemp ) - 1 ];
		$id      = explode( '.', $idTemp )[0];

		return $id;
	}
}
