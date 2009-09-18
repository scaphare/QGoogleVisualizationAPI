<?php

/**
 * Google_Container
 *
 * @desc Create a xhtml element container where the chart object resides.
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-31
 */
/**
 * Google_Container
 *
 * @desc Create a xhtml element container where the chart object resides.
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-31
 */
class Google_Container {

	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $errorContainer;

	/**
	 * @var Google_Container
	 */
	private $error;

	/**
	 * @var bool
	 */
	private $hasPrefix = false;

	/**
	 * @var string
	 */
	private $prefix = 'gc-';

	/**
	 * @var string
	 */
	private $element = 'div';

	/**
	 * @var array
	 */
	private $attributes = array();

	/**
	 * __construct
	 * @param array $attributes
	 * @param string $prefix
	 * @param string $element
	 */
	public function __construct($attributes=array(), $prefix=true, $element='div') {
		$this->element = (string) $element;
		$this->attributes = $attributes;
		$this->hasPrefix= (bool)$prefix;
	}

	/**
	 * reportTo
	 * @desc dependency injection of a container which is used to show
	 * repsonse messages
	 * @param string $name
	 * @param Google_Container $c
	 */
	public function reportTo($name, Google_Container $c) {
		if($this->id !== $c->getHash()){
			$this->errorContainer = $name;
			$this->error = $c;
		} else {
			throw new InvalidArgumentException("id and hash are equal. It is not allowed to inject an object into itself.");
		}
	}

	/**
	 * getErrorContainer
	 * @return string returns the name of the error container
	 */
	public function getErrorContainer() {
		return $this->errorContainer;
	}

	/**
	 * getError
	 * @desc returns the error container's name
	 * @return string
	 */
	public function getError() {
		if($this->error instanceof Google_Container) {
			return $this->error->getErrorContainer();
		} else {
			return '';
		}
	}

	/**
	 * setId
	 * @desc set the unique hash
	 * @return void
	 */
	public function setId(){
		$this->id = spl_object_hash($this);
	}

	/**
	 * getHash
	 * @return string
	 */
	public function getHash(){
		return $this->id;
	}

	/**
	 * getId
	 * @return string
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 *__toString
	 * render container into xhtml string
	 * @return string
	 */
	public function __toString() {
		$string = '<'. $this->element;
		$strAttr = array();
		if($this->id) { // make container unique
			$this->attributes["id"] = ($this->hasPrefix?$this->prefix:'').(array_key_exists("id",$this->attributes)?$this->attributes["id"]:$this->id);
			$this->attributes["class"] = $this->prefix.(array_key_exists("class",$this->attributes)?$this->attributes["class"]:"container");
		}

		if(count($this->attributes)) {
			foreach($this->attributes as $name => $val) {
				$strAttr[] = $name .'="'. (string)$val.'"';
			}

			if(count($strAttr)>0){
				$string .=' ';
				$string .= implode(" ", $strAttr);
			}
		}
		$string .= '>';
		$string .= '</'. $this->element.'>';
		return $string;
	}
}