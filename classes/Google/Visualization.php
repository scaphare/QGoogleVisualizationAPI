<?php

/**
 * Google_Visualization
 * @desc Class to build a complete visualization.
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Visualization
 *
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Visualization
{

	/**
	 * @var APISCRIPT
	 */
	const APISCRIPT = "http://www.google.com/jsapi";
	/**
	 * @var string $vizReference
	 */
	private $vizReference = "http://code.google.com/apis/visualization/documentation/gallery/";

	/**
	 * @var string $name
	 */
	private $name = "Base";

	/**
	 * @var Google_Config $config
	 */
	private $config;
	/**
	 * @var Google_Data $data
	 */
	private $data;

	/**
	 * @var Google_Format $format
	 */
	private $format;

	/**
	 * @var Google_DataView $dataView
	 */
	private $dataView;

	/**
	 * @var string $dataTable
	 */
	private $dataTable='data';

	/**
	 * @var object $dataTableObject
	 */
	private $dataTableObject;
	/**
	 * @var Google_Function $functionObject
	 */
	private $functionObject;

	/**
	 * @var Google_Package $packageObject
	 */
	private $packageObject;

	/**
	 * @param string $name
	 */
	public function __construct($name = null) {
		if($name and is_file(self::templateFile($name))){
			$this->name = $name;
		}
	}

	/**
	 * @return mixed
	 */
	public function getDataTable(){
		if($this->dataTableObject instanceof Google_Data_Table) {
			return $this->dataTableObject;
		}
		return $this->dataTable;
	}

	/**
	 * setDataTable
	 * @param mixed $dataTable
	 * @return void
	 */
	public function setDataTable($dataTable) {
		if($dataTable instanceof Google_Data_Table) {
			$this->dataTableObject = $dataTable;
		} else {
			$this->dataTable = $dataTable;
		}
	}

	/**
	 * setFunction
	 * @param Google_Function $function
	 */
	public function setFunction(Google_Function $function) {
		$this->functionObject = $function;
	}

	/**
	 * addFunction
	 * @param Google_Function $function
	 */
	public function addFunction(Google_Function $function) {
		$array	= is_array($this->functionObject)
				? $this->functionObject
				: array($this->functionObject);
		$array[] = $function;
		$this->functionObject = $array;
	}

	/**
	 * setPackage
	 * @param Google_Package $package
	 */
	public function setPackage(Google_Package $package) {
		$this->packageObject = $package;
	}


	/**
	 * setConfig
	 * @param Google_Config $config
	 */
	public function setConfig(Google_Config $config) {
		$this->config = $config;
		return $this;
	}

	/**
	 * addConfig
	 * @param Google_Config $config
	 * @return $this
	 */
	public function addConfig(Google_Config $config) {
		$this->config[] = $config;
		return $this;
	}

	/**
	 * setData
	 * @param gdBase $data
	 */
	public function setData(Google_Data_Interface $data) {
		$this->data = $data;
		return $this;
	}

	/**
	 * setFormat
	 * @param Google_Format_Default $format
	 */
	public function setFormat(Google_Format_Interface $format) {
		$this->format = $format;
		return $this;
	}

	/**
	 * setDataView
	 * @param Google_Data_View $dataView
	 * @return void
	 */
	public function setDataView(Google_Data_View $dataView) {
		$this->dataView = $dataView;
		return $this;
	}

	/**
	 * render
	 * @desc global render function
	 * @return string
	 */
	public function render() {

		$configObject = $this->config;
		$dataObject = $this->data;
		$formatObject = $this->format;
		$dataViewObject = $this->dataView;

		if($this->dataTableObject instanceof Google_Data_Table) {
			$dataTableObject = $this->dataTableObject;
		}

		if($this->functionObject instanceof Google_Function or is_array($this->functionObject)) {
			$functionObject = $this->functionObject;
		}

		if($this->packageObject instanceof Google_Package) {
			$packageObject = $this->packageObject;
		}

		ob_start();
		include_once(self::templateFile($this->name));
		$template = ob_get_contents();
		ob_end_clean();

		return $template;
	}

	/**
	 * templateFile
	 * @var static
	 * @param string $name
	 * @return string
	 */
	private static function templateFile($name) {
		return dirname(__FILE__).DIRECTORY_SEPARATOR.'Template'.DIRECTORY_SEPARATOR.$name.".phtml";
	}

	/**
	 * getReferenceLink
	 * @return string
	 */
	public function getReferenceLink() {
		$link = '<a href="'.$this->vizReference;
		$link .= strtolower($this->config->getConfigObject()->type);
		$link .= '.html" target="_blank">Goto Google Visualization Web API Gallery</a>';
		return $link;
	}

}
