<?php
/**
 * Google_Type_Object
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Object
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Number extends Google_Type_Base {

	/**
	 * @var integer $value
	 */
	private $value;
	/**
	 * constructor
	 * @param mixed $value
	 */
	public function __construct($value) {
		$this->value = is_numeric($value)?$value:0;
	}
	/**
	 * @return string
	 */
	public function __toString(){
		return (string)$this->value;
	}
}
