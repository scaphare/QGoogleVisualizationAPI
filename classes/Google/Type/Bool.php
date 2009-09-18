<?php

/**
 * Google_Type_Bool
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Bool
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Bool extends Google_Type_Base {

	/**
	 * @var bool
	 */
	private $value;

	/**
	 * constructor
	 * @param bool $value
	 */
	public function __construct($value) {
		$this->value = is_bool($value)?$value:false;
	}

	/**
	 * __toString
	 * @desc converts a boolean value into its javascript string representation
	 * @return string
	 */
	public function __toString(){
		return (true===$this->value?'true':'false');
	}
}
