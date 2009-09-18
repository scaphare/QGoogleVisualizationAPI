<?php
/**
 * Google_Type_Array
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Array
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Array extends Google_Type_Base implements Google_Type {

	/**
	 * @var array $value
	 */
	private $values;

	/**
	 * constructor
	 * @param array $values
	 */
	public function __construct(array $values) {
		$this->values = $values;
	}

	/**
	 * __toString
	 * @desc convert an array to JSON data object
	 * @return string
	 */
	public function __toString(){
		return Google_Base::toJSON($this->values);
	}
}
