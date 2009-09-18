<?php

/**
 * Google_Data_ColumnCell
 * @desc setup column cells
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_ColumnCell
 * @desc setup column cells
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_ColumnCell
{
	/**
	 * @var string $id
	 */
	protected $id;
	/**
	 * @var string $label
	 */
	protected $label;
	/**
	 * @var string $type
	 */
	protected $type;
	/**
	 * @var string $pattern
	 */
	protected $pattern;

	/**
	 * constructor
	 * @param string $id
	 * @param string $label
	 * @param string $type
	 * @param string $pattern
	 */
	public function __construct($id, $label, $type, $pattern = "")
	{
		$this->setColumnId($id);
		$this->setColumnLabel($label);
		$this->setColumnType($type);
		$this->setColumnPattern($pattern);
	}

	/**
	 * setColumnId
	 * @desc set column id checking against filter
	 * @param string $id
	 * @return bool
	 */
	public function setColumnId($id)
	{
		$boolState = true;
		$searchKeywords = array (
			"and",
			"asc",
			"avg",
			"by",
			"count",
			"date",
			"datetime",
			"desc",
			"false",
			"format",
			"from",
			"group",
			"is",
			"label",
			"limit",
			"max",
			"min",
			"not",
			"null",
			"offset",
			"options",
			"or",
			"order",
			"pivot",
			"select",
			"sum",
			"timeofday",
			"timestamp",
			"true",
			"where"
		);
		$replaceKeywords = array (
			"and_id",
			"asc_id",
			"avg_id",
			"by_id",
			"count_id",
			"date_id",
			"datetime_id",
			"desc_id",
			"false_id",
			"format_id",
			"from_id",
			"group_id",
			"is_id",
			"label_id",
			"limit_id",
			"max_id",
			"min_id",
			"not_id",
			"null_id",
			"offset_id",
			"options_id",
			"or_id",
			"order_id",
			"pivot_id",
			"select_id",
			"sum_id",
			"timeofday_id",
			"timestamp_id",
			"true_id",
			"where_id"
		);
		if ((isset ($id)) && (!is_null($id)))
			$this->id = str_replace($searchKeywords, $replaceKeywords, $id);
		else
			$boolState = false;
		return $boolState;
	}

	/**
	 * setColumnLabel
	 * @param string $label
	 * @return bool
	 */
	public function setColumnLabel($label)
	{
		$boolState = true;
		if ((isset ($label)) && (!is_null($label))) {
			$this->label = $label;
		} else {
			$boolState = false;
		}
		return $boolState;
	}

	/**
	 * setColumnType
	 * @param string $type
	 * @return bool
	 */
	public function setColumnType($type)
	{
		$boolState = true;
		if ((isset ($type)) && (!is_null($type)))
		{
			switch ($type)
			{
				case "string" :
					$this->type = 'string';
					break;
				case "number" :
					$this->type = 'number';
					break;
				case "date" :
					$this->type = 'date';
					break;
				case "time" :
					$this->type = 'time';
					break;
				case "datetime" :
					$this->type = 'datetime';
					break;
				case "bool" :
					$this->type = 'boolean';
					break;
				default :
					$this->type = 'string';
			}
		}
		else
		{
			$boolState = false;
		}
		return $boolState;
	}

	/**
	 * setColumnPattern
	 * @param string $pattern
	 * @return bool
	 */
	public function setColumnPattern($pattern)
	{
		$boolState = true;
		if ((isset ($pattern)) && (!is_null($pattern))) {
			$this->pattern = $pattern;
		} else {
			$boolState = false;
		}
		return $boolState;
	}

	/**
	 * __toString
	 * @desc renders a column cell into a string
	 * @return string
	 */
	public function __toString()
	{
		if (isset ($this->type) && !is_null($this->type) && isset ($this->label) && !is_null($this->label) && isset ($this->id) && !is_null($this->id)) {
			$strResult = "{id:'".$this->id."',label:'".$this->label."',type:'".$this->type."',pattern:'".$this->pattern."'}";
		} else {
			$strResult = "Error: Some of the column properties are not set or null ";
		}
		return $strResult;
	}

}
