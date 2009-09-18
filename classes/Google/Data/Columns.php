<?php

/**
 * Google_Data_Columns
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_Columns
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_Columns
{
	/**
	 * @var array $columns
	 */
	protected $columns = array ();

	/**
	 * addColumn
	 * @param string $id
	 * @param string $label
	 * @param string $type
	 * @param string $pattern
	 * @return bool
	 */
	public function addColumn($id, $label, $type, $pattern = "")
	{
		if (isset ($type) && !is_null($type) && isset ($label) && !is_null($label) && isset ($id) && !is_null($id)){
			array_push($this->columns, new Google_Data_ColumnCell($id, $label, $type, $pattern));
		} else {
			return false;
		}
	}

	/**
	 * __toString
	 * @desc render columns into string
	 * @return string
	 */
	public function __toString()
	{
		$strResult = "cols: [";
		$boolColumns = reset($this->columns);
		while ($boolColumns !== FALSE)
		{
			$strResult .= $boolColumns;
			$boolColumns = next($this->columns);
			if ($boolColumns !== FALSE)
				$strResult .= ",";
		}
		$strResult .= "]";
		return $strResult;
	}
}
