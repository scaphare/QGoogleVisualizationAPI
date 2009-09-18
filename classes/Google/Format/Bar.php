<?php

/**
 * Google_Format_Bar
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds a colored bar to a numeric cell indicating whether the cell value
 * is above or below a specified base value.
 *
 */
/**
 * Google_Format_Bar
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds a colored bar to a numeric cell indicating whether the cell value
 * is above or below a specified base value.
 * {@example test_google_vis_table_bar.php}
 *
 */
class Google_Format_Bar extends Google_Format implements Google_Format_Interface {

	/**
	 * @staticvar array $isRegistered
	 */
	private static $isRegistered = array(
		"base"=>true,
		"colorNegative"=>true,
		"colorPositive"=>true,
		"drawZeroLine"=>true,
		"max"=>true,
		"min"=>true,
		"showValue"=>true,
		"width"=>true
	);
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
	private $type = 'BarFormat';
	/**
	 * @var string $dataTable
	 */
	private $dataTable = 'data';
	/**
	 * @var integer $srcColumnIndices
	 */
	private $srcColumnIndices = 0;

	/**
	 * @var array $properties
	 */
	protected $properties=null;

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * getInstance
	 * @desc call static to provide fluent design notation
	 * @return Google_Format_Bar
	 */
	public static function getInstance() {
		return new Google_Format_Bar;
	}

	/**
	 * format
	 * @param mixed $data
	 * @param integer $srcColumnIndices
	 */
	public function format($dataTable, $srcColumnIndices) {
		if(is_string($dataTable)) {
			$this->dataTable = $dataTable;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
		if(is_integer($srcColumnIndices) or is_array($srcColumnIndices) ) {
			$this->srcColumnIndices = $srcColumnIndices;
		} else {
			$e = new Google_Exception_Format("source column is expecting a parameter of type integer or array of integers. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * __toString
	 * @desc returns table bar formatter template
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '('. (!empty($this->properties)?Google_Base::toJson($this->properties):'').');';
		$string .= "\n";
		$string .= 'formatter.format('.$this->dataTable.', '.$this->srcColumnIndices.');';
		$string .= "\n";
		return $string;
	}
}