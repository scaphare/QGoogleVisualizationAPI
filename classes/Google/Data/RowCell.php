<?php

/**
 * Google_Data_RowCell
 * 
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_RowCell
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_RowCell
{
	/**
	 * @var string $value
	 */
	protected $value;
	/**
	 * @var string $fvalue
	 */
	protected $fValue;
	/**
	 * @var string $type
	 */
	protected $type;

	/**
	 * constructor
	 * @param string $type
	 * @param string $value
	 * @param string $fValue formatting value expression
	 */
	public function __construct($type = null, $value = null, $fValue = null)
	{
		$this->value = null;
		$this->fValue = null;
		$this->type = null;
		$this->setValue($value);
		$this->setFormat($fValue);
		$this->setColumnType($type);
	}

	/**
	 * setValue
	 * @param mixed $value
	 * @return void
	 */
	public function setValue($value)
	{
		if ((isset ($value)) && (!is_null($value)))
			$this->value = $value;
	}

	/**
	 * setFormat
	 * @param string $fValue
	 * @return void
	 */
	public function setFormat($fValue)
	{
		if ((isset ($fValue)) && (!is_null($fValue)))
			$this->fValue = $fValue;
	}

	/**
	 * setColumnType
	 * @param value $type
	 * @return void
	 */
	public function setColumnType($type)
	{
		if ((isset ($type)) && (!is_null($type)))
			$this->type = $type;
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString()
	{
		if (is_null($this->value) && is_null($this->fValue)) {
			return "";
		}
		// values
		$strResult = "{v:";
		$strResult .= $this->type == "string" ? "'" : "";
		
		if ($this->value === true) {
			$strResult .= "true";
		} elseif ($this->value === false) {
			$strResult .= "false";
		} else {
			$strResult .= $this->value;
		}
		
		$strResult .= $this->type == "string" ? "'" : "";
		
		// format
		if ((isset ($this->fValue)) && (!is_null($this->fValue))) {
			$strResult .= ",f:'".$this->fValue."'";
		}
		$strResult .= "}";
		return $strResult;
	}
}
