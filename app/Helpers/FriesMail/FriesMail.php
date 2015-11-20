<?php

/**
 * Created by PhpStorm.
 * User: Tu TV
 * Date: 20/11/2015
 * Time: 8:26 AM
 */
class FriesMail {
	public $subject;
	public $html;
	public $text;

	/**
	 * @var array
	 */
	public $to;

	/**
	 * @var string
	 */
	public $from;

	public $fromName;

	public function __construct( $subject, $html ) {
		$this->subject = $subject;
		$this->html    = $html;
		$this->text    = strip_tags( $this->html );
	}

	/**
	 * Set email to
	 *
	 * @param $mail
	 *
	 * @return $this
	 */
	public function addTo( $mail ) {
		$this->to[] = $mail;

		return $this;
	}

	/**
	 * Set email from
	 *
	 * @param $from
	 *
	 * @return $this
	 */
	public function setFrom( $from ) {
		$this->from = $from;

		return $this;
	}

	/**
	 * Set from name
	 *
	 * @param $fromName
	 *
	 * @return $this
	 */
	public function setFromName( $fromName ) {
		$this->fromName = $fromName;

		return $this;
	}

	/**
	 * Get array to
	 *
	 * @return array
	 */
	public function getTo() {
		return $this->to;
	}

	/**
	 * Get from
	 *
	 * @return string
	 */
	public function getFrom() {
		return $this->from;
	}

	/**
	 * Get from name
	 *
	 * @return mixed
	 */
	public function getFromName() {
		return $this->fromName;
	}

	/**
	 * Get subject
	 *
	 * @return mixed
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Get html
	 *
	 * @return mixed
	 */
	public function getHtml() {
		return $this->html;
	}

	/**
	 * Get text
	 *
	 * @return mixed
	 */
	public function getText() {
		return $this->text;
	}
}