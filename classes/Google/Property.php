<?php

/**
 * Google_Property
 *
 * @desc
 * Object used to prepare JSON Objects
 * @package Google
 * @author Thomas Schaefer
 * @since 2009-05-28
 */
/**
 * Google_Property
 *
 * @desc
 * Object used to prepare JSON Objects
 * @package Google
 * @author Thomas Schaefer
 * @since 2009-05-28
 */
class Google_Property {
	
	/**
	 * @var stdClass $properties
	 */
	private $properties;

	/**
	 * constructor
	 * @desc receives a nested array. The array may contain further
	 * JQuery objects or JQuery Elements
	 * @param array $properties
	 */
	public function __construct(array $properties) {
		$this->properties = new stdClass;
		if(is_array($properties)) {
			foreach($properties as $name => $val) {
				$this->properties->{$name} = $val;
			}
		}
	}

	/**
	 * __set
	 * @desc inject further properties
	 * @param string $name
	 * @param mixed $param
	 */
	public function __set($name, $param) {
		$this->properties->$name = $param;
	}

	/**
	 * render nested Google_Property Object to JSON
	 * @return string
	 */
	public function __toString() {
		return stripslashes(Google_Base::toJSON($this->properties));
	}

}