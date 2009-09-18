<?php

/**
 * Google_Format_Number
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Describes how numeric columns should be formatted. Formatting options
 * include specifying a prefix symbol (such as a dollar sign) or the punctuation
 * to use as a thousands marker.
 */
/**
 * Google_Format_Number
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Describes how numeric columns should be formatted. Formatting options
 * include specifying a prefix symbol (such as a dollar sign) or the punctuation
 * to use as a thousands marker.
 * {@example test_google_vis_table_number.php}
 */
class Google_Format_Number extends Google_Format implements Google_Format_Interface {

	/**
	 * @staticvar array $isRegistered
	 */
	private static $isRegistered = array(
		"decimalSymbol"=>true,
		"fractionDigits"=>true,
		"groupingSymbol"=>true,
		"negativeColor"=>true,
		"negativeParens"=>true,
		"prefix"=>true,
		"suffix"=>true
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
	private $type = 'NumberFormat';
	/**
	 * @var string $dataTable name of the function variable
	 */
	private $dataTable = 'data';
	/**
	 *
	 * @var integer srcColumnIndices
	 */
	private $srcColumnIndices = 0;

	/**
	 * @var array $properties
	 */
	protected $properties=null;


	/**
	 * desc The standard format() method to apply formatting to the specified
	 * column.
	 * @param string $dataTable
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
		$string .= 'formatter.format('.$this->dataTable.', '.$this->srcColumnIndices.')';
		$string .= "\n";
		return $string;
	}


}