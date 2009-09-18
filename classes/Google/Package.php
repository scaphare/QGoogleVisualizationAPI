<?php
/**
 *
 * Google_Package
 * @desc returns the package loader
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 *
 * Google_Package
 * @desc returns the package loader
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Package {

	/**
	 * @staticvar $isRegistered used to register items
	 */
	private static $isRegistered = array(
		"packages"=>true,
		"language"=>true,
	);

	/**
	 * @var array $properties
	 */
	private $properties = null;
	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'load';
	/**
	 * @var integer $version
	 */
	private $version = 1;

	/**
	 *
	 * @param array $properties
	 * @param string $provider
	 * @param string $scope
	 */
	public function __construct(array $properties = array(), $provider=null, $scope=null) {
	    if(count($properties))
	    {
	      foreach($properties as $name => $value)
	      {
	          if(array_key_exists($name, self::$isRegistered)) {
    			if(empty($this->properties)) {
    				$this->properties = new stdClass;
    			}
    			$this->properties->{$name} = $value;
	          }
	      }
	    }
		if($provider) {
			$this->provider = $provider;
		}
		if($scope){
			$this->scope = $scope;
		}
	}

	/**
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value) {
		if(array_key_exists($name, self::$isRegistered)) {
			if(empty($this->properties)) {
				$this->properties = new stdClass;
			}
			$this->properties->{$name} = $value;
		} else {
			throw new Exception("no such property named ". $name);
		}
	}

	/**
	 * setType
	 * @desc sets the methodType
	 * @param mixed $type
	 */
	public function setType($type) {
		if(is_array($type)) {
			$this->type = implode(".", $type);
		} else {
			$this->type = $type;
		}
	}

	/**
	 * @return string
	 */
	public function __toString() {
		$string = '';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->type;
		$string .= '(';
		$string .= "'".$this->scope."',";
		$string .= "'".$this->version."',";
		$string .= (!empty($this->properties)?Google_Base::toJson($this->properties):'');
		$string .= ');';
		return $string;

	}
}