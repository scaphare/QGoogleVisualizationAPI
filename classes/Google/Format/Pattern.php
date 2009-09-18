<?php

/**
 * Google_Format_Pattern
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Enables you to merge the values of designated columns into a single
 * column, along with arbitrary text. So, for example, if you had a column for
 * first name and a column for last name, you could populate a third column with
 * {last name}, {first name}. This formatter does not follow the conventions for
 * the constructor and the format() method. See the Methods section below for
 * instructions.
 */
/**
 * Google_Format_Pattern
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Enables you to merge the values of designated columns into a single
 * column, along with arbitrary text. So, for example, if you had a column for
 * first name and a column for last name, you could populate a third column with
 * {last name}, {first name}. This formatter does not follow the conventions for
 * the constructor and the format() method. See the Methods section below for
 * instructions.
 * {@example test_google_vis_table_pattern.php}
 */
class Google_Format_Pattern extends Google_Format implements Google_Format_Interface {

	public static $isRegistered = array(
		"decimalSymbol"=>true,
		"fractionDigits"=>true,
		"groupingSymbol"=>true,
		"negativeColor"=>true,
		"negativeParens"=>true,
		"prefix"=>true,
		"suffix"=>true
	);
	private $provider = 'google';
	private $scope = 'visualization';
	private $type = 'PatternFormat';
	private $dataTable = 'data';
	private $srcColumnIndices = 0;
	private $opt_dstColumnIndex = 0;
	private $pattern;

	public function __construct() {}

	/**
	 * pattern
	 * @desc set the pattern to be used with table
	 * @param string $pattern
	 */
	public function pattern($pattern) {
		if(is_string($pattern)) {
			$this->pattern = $pattern;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * @desc The standard formatting call, with a few additional parameters:
     * dataTable - The DataTable on which to operate.
     * srcColumnIndices - An array of one or more (zero-based) column indices to
	 * pull as the sources from the underlying DataTable. This will be used as a
	 * data source for the pattern parameter in the constructor. The column
	 * numbers do not have to be in sorted order.
     * opt_dstColumnIndex - [optional] The destination column to place the
	 * output of the pattern manipulation. If not specified, the first element
	 * in srcColumIndices will be used as the destination.
	 *
	 * @param string $dataTable
	 * @param integer $srcColumnIndices
	 * @param integer $opt_dstColumnIndex
	 */
	public function format($dataTable, $srcColumnIndices, $opt_dstColumnIndex=null) {
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
		if(null===$opt_dstColumnIndex or is_integer($opt_dstColumnIndex)) {
			$this->opt_dstColumnIndex = $opt_dstColumnIndex;
		} else {
			$e = new Google_Exception_Format("destination column is expecting a parameter of type integer. (transfered type: ". gettype($pattern).')');
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
		$string .= '(\''. (!empty($this->pattern)?(string)$this->pattern:'').'\');';
		$string .= "\n";
		if(empty($this->opt_dstColumnIndex)) {
			$string .= 'formatter.format('.$this->dataTable.', '.Google_Base::toJson($this->srcColumnIndices).');';
		} else {
			$string .= 'formatter.format('.$this->dataTable.', '.Google_Base::toJson($this->srcColumnIndices).', '.Google_Config::toJson($this->opt_dstColumnIndex).');';
		}
		$string .= "\n";
		return $string;
	}


}