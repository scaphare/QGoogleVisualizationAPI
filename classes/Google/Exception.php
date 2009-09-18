<?php

/**
 * Google_Exception
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
 */
/**
 * Google_Exception
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Exception extends Exception {

	/**
	 * @var array $parameters
	 */
	private $parameters = array();
	/**
	 * @var mixed $data
	 */
	private $data;

	/**
	 * setParameter
	 * @param string $name
	 * @param mixed $value
	 */
	public function setParameter($name, $value) {
		$this->parameters[$name] = $value;
	}

	/**
	 * getParameter
	 * @param $string $name
	 * @return mixed
	 */
	public function getParameter($name) {
		if($this->hasParameter($name)) {
			return $this->parameters[$name];
		}
		return false;
	}

	/**
	 * hasParameter
	 * @param string $name
	 * @return bool
	 */
	public function hasParameter($name) {
		if(array_key_exists($name, $this->parameters)) {
			return true;
		}
		return false;
	}

	/**
	 * templateFile
	 * @desc returns path to template
	 * @param string $name
	 * @var static
	 * @return string
	 */
	private static function templateFile($name) {
		return dirname(__FILE__).DIRECTORY_SEPARATOR.'Exception'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$name.".phtml";
	}

	/**
	 * template
	 * @desc renders template
	 * @param string $name
	 * @return string
	 */
	private function template($name=null) {

		ob_start();
		include_once(self::templateFile(($name?$name:__CLASS__)));
		$template = ob_get_contents();
		ob_end_clean();
		return $template;

	}

	/**
	 * show
	 * @desc prints out exception
	 * @param string $name
	 * @param mixed $data
	 */
	public function show($name=null, $data=null) {
		$this->data = $data;
		echo $this->template($name);
		exit;
	}
}