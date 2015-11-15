<?php

/**
 * Created by PhpStorm.
 * User: Tu TV
 * Date: 16/11/2015
 * Time: 2:23 AM
 */

namespace App\Helpers\FGet;

use Unirest\Request;

class SoundCloud {
	private $client_id;
	private $client_secret;
	private $link;
	private $url_API;
	private $content_API;
	public $object_API;
	public $status;

	/**
	 * Construction with link song
	 *
	 * @param $link
	 */
	public function __construct( $link ) {
		$this->client_id     = '23a36e18a33ee59ab2b356458d2e4328';
		$this->client_secret = '1c18a2b87e88d18a3a38246a8dc10ee8';
		$this->link          = $link;
	}

	/**
	 * Match link is Sound Cloud
	 *
	 * @return bool
	 */
	public function matchLink() {
		// example: $link = 'https://soundcloud.com/doanhongnhung24/chuy-n-ph-ng-k-t-c'
		$pattern = '/soundcloud\.com\/\w*\/\S*/';

		if ( preg_match( $pattern, $this->link ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get content form server API
	 */
	public function getContentAPI() {
		$this->url_API
			= sprintf( 'http://api.soundcloud.com/resolve?url=%s&client_id=%s',
			$this->link, $this->client_id );

		$response = f_file_get_contents( $this->url_API );

		if ( $response['code'] == 200 ) {
			$this->status      = true;
			$this->content_API = $response['content'];
		} else {
			$this->status = false;
		}

		$this->handleAPI();
	}

	/**
	 * Handle content API
	 */
	public function handleAPI() {
		if ( $this->getStatus() ) {
			$this->object_API = json_decode( $this->content_API );
		}

		var_dump( $this->object_API );
	}

	/**
	 * Get status
	 *
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}
}