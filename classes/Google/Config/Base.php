<?php

/**
 * Google_Config_Base
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Config_Base
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
abstract class Google_Config_Base {

	/**
	 * @var array $configuration
	 */
	protected $configuration = array();

	/**
	 * getProperty
	 * @param string $name
	 * @return mixed
	 */
	public function getProperty($name) {
		if($this->hasProperty($name)) {
			return $this->configuration[$name];
		} else {
			throw new Exception('no such property available: '. $name);
			return false;
		}
	}

	/**
	 * hasProperty
	 * @desc checks on config property
	 * @param string $name
	 * @return bool
	 */
	public function hasProperty($name) {
		if(array_key_exists($name, $this->configuration)) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * getProperties
	 * @return array
	 */
	public function getProperties() {
		return $this->configuration;
	}

	/**
	 * defaultConfig
	 * @return bool
	 */
	protected static function defaultConfig() {
		return false;
	}

	/**
	 * getDefaultConfig
	 * @desc
	 * Loads the default configuration for a chart type.
	 * On default it loads data from Config::defaultConfig().
	 * If you want to configure it individually then you have to implement
	 * a static method named defaultConfig into each chart type object.
	 * A sample implementation can be found in the file ./Google/Config/BarChart.php,
	 * where the class Google_Config_BarChart resides.
	 *
	 * @param string $type chart type
	 * @return mixed
	 */
	public function getDefaultConfig($type) {
		$res = call_user_func(array('Google_Config_'.$type, 'defaultConfig'));
		if(!empty($res) and $res instanceof stdClass) {
			return $res;
		}
		return null;
	}

}