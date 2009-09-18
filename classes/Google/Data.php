<?php

/**
 * Google_Data
 * @desc Class to create a data object with rows and columns.
 * In default mode a data object is composed by various methods. The extended
 * mode allows to build data object directly from result sets.
 *
 * {@example test_google_data.php}
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
 */
/**
 * Google_Data
 * @desc Class to create a data object with rows and columns.
 * In default mode a data object is composed by various methods. The extended
 * mode allows to build data object directly from result sets.
 *
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
 */
class Google_Data {

	/**
	 * @var Google_Data_Base $data
	 */
	private $data;

	/**
	 * constructor
	 * @param string $type
	 */
	public function __construct($type=null) {
		switch($type){
			case "ext":
			case "extended":
				$this->data = new Google_Data_Extend();
				break;
			default:
				$this->data = new Google_Data_Base();
				break;
		}
	}

	/**
	 * getInstance
	 * @param string $type ext|NULL
	 * @return Google_Data
	 */
	public function getInstance($type=null) {
		return new Google_Data($type);
	}

	/**
	 * getData
	 * @return string
	 */
	public function getData(){
		/** @var $data Google_Data_Base */
		return $this->data->getData();
	}

	/**
	 * @desc returns a Google_Data object
	 * @return Google_Data
	 */
	public function getDataObject(){
		return $this->data;
	}

	/**
	 * init
	 * @access private
	 * @return void
	 */
	private function init() {
		$this->data->init();
	}

}