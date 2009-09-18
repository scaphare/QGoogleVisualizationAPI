<?php

/**
 * Google_Data_Rows
 * 
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_Rows
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_Rows
{
	/**
	 * @var array $rows
	 */
	protected $rows = array ();

	/**
	 * constructor
	 */
	public function __construct() {}
	
	/**
	 * getInstance
	 * @var static
	 * @return Google_Data_Rows 
	 */
	public static function getInstance() {
		return new Google_Data_Rows;
	}

	/**
	 * setCell
	 * @param string $type
	 * @param mixed $value
	 * @param string $fValue
	 */
	public function setCell($type, $value, $fValue)
	{
		if(is_string($type)) {
			switch($type) {
				case "string":
				case "number":
				case "date":
				case "time":
				case "datetime":
				case "bool":
					array_push($this->rows, new Google_Data_RowCell($type, $value, $fValue));
					break;
				default:
					$e = new Google_Exception_Data("Following type are supported: [string, number, date, time, datetime, bool]");
					$e->show();
					break;
			}
		} else {
			$e = new Google_Exception_Data("expecting a string.");
			$e->show();
		}
	}

	/**
	 * setEmptyCell
	 */
	public function setEmptyCell()
	{
		array_push($this->rows, new Google_Data_RowCell(null, null, null));
	}

	/**
	 * __toString
	 * @desc returns columnized rows
	 * @return string
	 */
	public function __toString()
	{
		$strResult = "{c:[";
		$boolRows = reset($this->rows);
		while ($boolRows !== FALSE)
		{
			$strResult .= $boolRows;
			$boolRows = next($this->rows);
			if ($boolRows !== FALSE)
				$strResult .= ",";
		}
		$strResult .= "]}";
		return $strResult;
	}
}
