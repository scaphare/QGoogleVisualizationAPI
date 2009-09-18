<?php
/**
 *
 * Google_Function
 * @desc compose function on top of Google's Web Visualization API
 * {@example test_google_vis_using_the_query_language.php}
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 *
 * Google_Function
 * @desc compose function on top of Google's Web Visualization API
 * {@example test_google_vis_using_the_query_language.php}
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Function {
	/**
	 * @var string $name
	 */
	private $name = 'draw';
	/**
	 * @var array $stack
	 */
	private $stack = array();
	/**
	 * @var string $callback
	 */
	private $callback = '';

	/**
	 * constructor
	 * @param string $name function name
	 * @param array $parameters signature parameters
	 */
	public function __construct($name="draw", $parameters=array()) {
		$this->name = $name;
		$this->stack[] = 'function '.$name.'('.implode(", ", $parameters).'){';
	}

	/**
	 * add
	 * @desc append value to function stack
	 * @param mixed $part
	 * return void
	 */
	public function add($part) {
		$this->stack[] = $part;
		return $this;
	}

	/**
	 * getName
	 * @desc return function name
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * setCallBack
	 * @desc init and name Google callback onload function
	 * @return void
	 */
	public function setCallBack() {
		$this->callback = 'google.setOnLoadCallback('.$this->name.')'.";\n";
		return $this;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		$string = "\n".implode("\n ", $this->stack)."}\n";
		$string .= $this->callback;
		return $string;

	}
}