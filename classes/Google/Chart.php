<?php
/**
 * Google_Chart
 * Class to setup chart objects
 */

/**
 * Google_Chart
 * @desc Class to setup chart objects
 * @package Google
 * @author Thomas Schäfer
 * @link scaphare@gmail.com
 * @desc
 */
class Google_Chart {

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
	private $type = '';
	/**
	 * @var array $data
	 */
	private $data;
	/**
	 * @var string $version
	 */
	private $version;
	/**
	 * @var array $properties
	 */
	private $properties=null;
	/**
	 * @var array $options
	 */
	private $options=null;
	/**
	 * @var string $dataTable
	 */
	private $dataTable='';

	/**
	 * constructor
	 * @param string $type
	 * @param array $data
	 * @param string $version
	 * @return void
	 */
	public function __construct($type, $data, $version=null) {
		$this->type = $type;
		$this->data = $data;
		$this->version = $version;
	}


	/**
	 * getDataTable
	 * @desc getter for data table name
	 * @return string
	 */
	public function getDataTable() {
		return $this->dataTable;
	}

	/**
	 * setDataTable
	 * @param srting $name
	 * @return void
	 */
	public function setDataTable($name) {
		$this->dataTable = $name;
	}

	/**
	 * draw
	 * @desc php method to simulate Google's default draw method
	 * @param array|Google_Data_View $data
	 * @param array $options
	 * @return void
	 */
	public function draw($data, $options=null) {
		$this->options = $options;

		$arr = array();
		if($data instanceof Google_Data_View) {
			$arr[] = $data->getViewTable();
		} else {
			$this->dataTable = $data;
			$arr[] = $data;
		}

		if($options) {
			$_options =  $options->getProperties();
			if($_options instanceof Google_Config_Default or $_options instanceof stdClass) {
				$arr[] = Google_Base::toJSON($_options);
			} else {
				$arr[] = $options->getProperties();
			}
		} else {
			$arr[] = 'null';
		}
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * render
	 * @desc prints out the rendered chart object
	 * @return string
	 */
	public function render() {
		$string = $this->getDataTable().'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		if($this->options instanceof Google_Config_Default) {
			$string .= $this->options->getConfigObject()->type;
		} else {
			$string .= $this->type;
		}
		$string .= '(';
		if($this->data) $string .= $this->data;
		if($this->version) $string .= ','.$this->version;
		$string .= ');';
		$string .= "\n";

		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= ' '.$this->getDataTable().'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		return $string;
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		$string = 'var chart_'.$this->data.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		if($this->options instanceof Google_Config_Default) {
			$string .= $this->options->getConfigObject()->type;
		} else {
			$string .= $this->type;
		}
		$string .= '(';
		if($this->data) $string .= $this->data;
		if($this->version) $string .= ','.$this->version;
		$string .= ');';
		$string .= "\n";

		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= 'chart_'.$this->data.'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		$string .= "\n";
		return $string;
	}

}