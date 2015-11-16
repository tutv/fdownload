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

	public $status;

	private $content_API;
	public $object_API;
	public $link_stream;
	public $link_download;

	/**
	 * Construction with link song
	 *
	 * @param $link
	 */
	public function __construct( $link ) {
		$this->client_id     = '23a36e18a33ee59ab2b356458d2e4328';
		$this->client_secret = '1c18a2b87e88d18a3a38246a8dc10ee8';
		$this->link          = $link;

		if ( $this->matchLink() ) {
			$this->getContentAPI();
		} else {
			$this->status = false;
		}
	}

	/**
	 * Match link is Sound Cloud
	 *
	 * @return bool
	 */
	public function matchLink() {
		// example: $link = 'https://soundcloud.com/doanhongnhung24/chuy-n-ph-ng-k-t-c'
		$pattern = '/soundcloud\.com/';

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

			$this->setLinkStream();
			$this->setLinkDownload();
		}
	}

	/**
	 * Get status
	 *
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	public function getID() {
		if ( $this->getStatus() ) {
			return $this->object_API->id;
		}

		return null;
	}

	/**
	 * Get title
	 *
	 * @return null|string
	 */
	public function getTitle() {
		if ( $this->getStatus() ) {
			return $this->object_API->title;
		}

		return null;
	}

	/**
	 * Get direct link song
	 *
	 * @return null|string
	 */
	public function setLinkStream() {
		if ( $this->getStatus() ) {
			$stream_link = $this->object_API->stream_url . '?client_id='
			               . $this->client_id;

			$headers = get_headers( $stream_link, 1 );

			$this->link_stream = $headers['Location'];
		}
	}

	public function getLinkStream() {
		return $this->link_stream;
	}

	/**
	 * Get description
	 *
	 * @return null|string
	 */
	public function getDescription() {
		if ( $this->getStatus() ) {
			return $this->object_API->description;
		}

		return null;
	}

	/**
	 * Get link download
	 *
	 * @return null|string
	 */
	public function setLinkDownload() {
		if ( $this->getStatus() ) {
			if ( property_exists( $this->object_API, 'download_url' ) ) {
				$this->link_download = $this->object_API->download_url
				                       . '?client_id='
				                       . $this->client_id;
			}
		}
	}

	public function getLinkDownload() {
		return $this->link_download;
	}

	public function getOutput() {
		if ( ! $this->getStatus() ) {
			return [
				'status' => 'error',
				'msg'    => 'Error!',
			];
		}

		return [
			'status'      => 'ok',
			'title'       => $this->getTitle(),
			'description' => $this->getDescription(),
			'stream'      => $this->getLinkStream(),
			'download'    => $this->getLinkDownload()
		];
	}
}