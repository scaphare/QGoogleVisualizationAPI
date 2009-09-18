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
class Google_Type_Object extends Google_Type_Base {

	/**
	 * @var object $value
	 */
	private $value;

	/**
	 * constructor
	 * @param object $value
	 */
	public function __construct($value) {
		if(is_object($value)) {
			$this->value = $value;
		}
	}
	/**
	 * @return string
	 */
	public function __toString(){
		return Google::toJSON($this->value);
	}
}
