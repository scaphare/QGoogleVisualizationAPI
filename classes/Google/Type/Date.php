<?php
/**
 * Google_Type_Date
 * @desc data type date class
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Date
 * @desc data type date class
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Date extends Google_Type_Base {
	/**
	 * @var integer $year
	 */
	private $year;
	/**
	 * @var integer $month
	 */
	private $month;
	/**
	 * @var integer $day
	 */
	private $day;
	/**
	 * @var integer $hour
	 */
	private $hour;
	/**
	 * @var integer $minute
	 */
	private $minute;
	/**
	 * @var integer $seconds
	 */
	private $seconds;

	/**
	 *
	 * @param integer $year
	 * @param integer $month
	 * @param integer $day
	 * @param integer $hour
	 * @param integer $minutes
	 * @param integer $seconds
	 */
	public function __construct($year, $month, $day, $hour = 0, $minutes = 0, $seconds = 0) {

		if($year>2100) {
			throw new DomainException("Input data for year does not make sense;");
		}
		$this->year = (int)$year;

		if($month < 1 and $month>12) {
			throw new DomainException("Input value for month has to greater than 0 and lower than 13;");
		}
		$this->month = (int)$month;

		if($day < 1 and $day>31) {
			throw new DomainException("Input value for day has to greater than 0 and lower than 32;");
		}
		$this->day = (int)$day;

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
	}
	/**
	 * @return __toString
	 */
	public function __toString(){
		return "new Date(".$this->year.",".$this->month.",".$this->day.",".$this->hour.",".$this->minutes.",".$this->seconds.")";
	}
}
