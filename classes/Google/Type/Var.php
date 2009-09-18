<?php

/**
 * Google_Type_Var
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Var
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Var extends Google_Type_Base {
	/**
	 * @var mixed $value
	 */
	private $value;
	/**
	 * constructor
	 * @param mixed $value
	 */
	public function __construct($value) {
		$this->value = $value;
	}
	/**
	 *
	 * @return string
	 */
	public function __toString(){
		return (string)$this->value;
	}
}
