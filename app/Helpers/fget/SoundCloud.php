<?php

/**
 * Created by PhpStorm.
 * User: Tu TV
 * Date: 16/11/2015
 * Time: 2:23 AM
 */

namespace App\Helpers\FGet;

class SoundCloud {
	private $client_id;
	private $client_secret;
	private $link;

	public function __construct( $link ) {
		$this->client_id     = '23a36e18a33ee59ab2b356458d2e4328';
		$this->client_secret = '1c18a2b87e88d18a3a38246a8dc10ee8';
		$this->link          = $link;
	}

	public function matchLink() {
		// example: $link = 'https://soundcloud.com/doanhongnhung24/chuy-n-ph-ng-k-t-c'
		$pattern = '/soundcloud\.com\/\w*\/\S*/';

		if ( preg_match( $pattern, $this->link ) ) {
			return true;
		}

		return false;
	}
}