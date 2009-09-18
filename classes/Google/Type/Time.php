<?php

/**
 * Google_Type_Time
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Time
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Time extends Google_Type_Base {
	/**
	 * @var integer $hour
	 */
	private $hour;
	/**
	 * @var integer $minutes
	 */
	private $minutes;
	/**
	 * @var integer $seconds
	 */
	private $seconds;
	/**
	 * @var integer $timezoneOffset
	 */
	private $timezoneOffset;

	/**
	 *
	 * @param integer $hour
	 * @param integer $minutes
	 * @param integer $seconds
	 * @param integer $timezoneOffset
	 */
	public function __construct($hour = 0, $minutes = 0, $seconds = 0, $timezoneOffset=0) {

		if($hour < 0 and $hour>23) {
			throw new DomainException("Input value for hour has to between 0 and 23;");
		}
		$this->hour = $hour;

		if($minutes < 0 and $minutes>60) {
			throw new DomainException("Input value for minutes has to between 0 and 60;");
		}
		$this->minutes = $minutes;

		if($seconds < 0 and $seconds>60) {
			throw new DomainException("Input value for seconds has to between 0 and 60;");
		}
		$this->seconds = $seconds;

		if($timezoneOffset < -12 and $timezoneOffset > 12) {
			throw new DomainException("Input value for timezoneOffset has to between -12 and 12;");
		}
		$this->timezoneOffset = $timezoneOffset;
	}

	/**
	 * @return string
	 */
	public function __toString(){
		return "[".$this->hour.",".$this->minutes.",".$this->seconds.",".$this->timezoneOffset."]";
	}
}
