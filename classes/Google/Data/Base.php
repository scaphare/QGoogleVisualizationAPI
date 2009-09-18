<?php

/**
 * Google_Data_Base
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_Base
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_Base implements Google_Data_Interface
{
	/**
	 * @var bool $isResponse
	 */
	private $isResponse = true;
	/**
	 * @var string $response
	 */
	protected $response = "";
	/**
	 * @var string $closeResponse
	 */
	protected $closeResponse = "";
	/**
	 * @var array $columns
	 */
	protected $columns;
	/**
	 * @var array $rows
	 */
	protected $rows = array ();
	/**
	 * @var string $requestID
	 */
	protected $requestID;
	/**
	 * @var string $strSignature
	 */
	protected $strSignature;
	/**
	 * @var string $dataObjectName
	 */
	private $dataObjectName = "dataObj";

	/**
	 * constructor
	 * @param string $tqx
	 */
	public function __construct($tqx = null){
		if(empty($tqx)) {
			$this->isResponse = false;
		}
		$this->init($tqx);
	}

	/**
	 * getName
	 * @desc returns the name of a data object
	 * @return string
	 */
	public function getName() {
		return $this->dataObjectName;
	}

	/**
	 * setName
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->dataObjectName = (string) $name;
	}

	/**
	 * init
	 * @param string $tqx
	 * @return void
	 */
	public function init($tqx = null)
	{
		$this->response = "google.visualization.Query.setResponse({";
		$requestID = "0";
		$strSignature = $this->getSignature();
		$this->response .= "version:'0.5',";
		$this->response .= "reqId:'".$requestID."',";
		$this->response .= "status:'ok',";
		$this->response .= "sig:'".$strSignature."',";
		$this->response .= "table:{";
		$this->closeResponse = "}});\n";

		$this->columns = new Google_Data_Columns();
	}

	/**
	 * addColumn
	 * @param string $id
	 * @param string $label
	 * @param string $type
	 * @param string $pattern
	 */
	public function addColumn($id, $label, $type, $pattern = "")
	{
		$this->columns->addColumn($id, $label, $type, $pattern);
	}

	/**
	 * addNewRow
	 * @return void
	 */
	public function addNewRow()
	{
		array_push($this->rows, new Google_Data_Rows());
	}

	/**
	 * setEmptyCell
	 * @return void
	 */
	public function setEmptyCell()
	{
		end($this->rows)->setEmptyCell();
	}

	/**
	 * addStringCellToRow
	 * @param mixed $value
	 * @param string $fValue
	 * @return void
	 */
	public function addStringCellToRow($value, $fValue = null)
	{
		end($this->rows)->setCell("string", $value, $fValue);
	}

	/**
	 * addNumberCellToRow
	 * @param mixed $value
	 * @param string $fValue
	 * @return void
	 */
	public function addNumberCellToRow($value, $fValue = null)
	{
		end($this->rows)->setCell("number", $value, $fValue);
	}

	/**
	 * addDateCellToRow
	 * @param integer $year
	 * @param integer $month
	 * @param integer $day
	 * @param integer $hour
	 * @param integer $minutes
	 * @param integer $seconds
	 * @param string $fValue
	 * @return void
	 */
	public function addDateCellToRow($year, $month, $day, $hour = 0, $minutes = 0, $seconds = 0, $fValue = null)
	{
		if ($month <= 0) {
			$month = 0;
		} else {
			$month -= 1;
		}
		end($this->rows)->setCell("date", (string) new Google_Type_Date($month, $day, $hour, $minutes, $seconds), $fValue);
	}

    /**
     * addDatetimeCellToRow
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minutes
     * @param int $seconds
     * @param string $fValue
	 * @return void
     */
	public function addDatetimeCellToRow($year, $month, $day, $hour = 0, $minutes = 0, $seconds = 0, $fValue = null)
	{
		if ($month <= 0) {
			$month = 0;
		} else {
			$month -= 1;
		}
		end($this->rows)->setCell("datetime", (string) new Google_Type_Date($month, $day, $hour, $minutes, $seconds), $fValue);
	}

	/**
	 * addTimeCellToRow
	 * @param integer $hour
	 * @param integer $minutes
	 * @param integer $seconds
	 * @param integer $timezoneOffset
	 * @param integer $fValue
	 * @return void
	 */
	public function addTimeCellToRow($hour, $minutes, $seconds = 0, $timezoneOffset = 0, $fValue = null)
	{
		end($this->rows)->setCell("time", (string) new Google_Type_Time($hour, $minutes, $seconds, $timezoneOffset), $fValue);
	}

	/**
	 * addBoolCellToRow
	 * @param mixed $value
	 * @param string $fValue
	 * @return void
	 */
	public function addBoolCellToRow($value, $fValue = null)
	{
		end($this->rows)->setCell("bool", $value, $fValue);
	}

	/**
	 * getData
	 * @desc returns the data values as json string
	 * @return string
	 */
    public function getData() {

		$strResult = "{";
		$strResult .= $this->columns;
		$strResult .= ",rows: [";
		$boolRows = reset($this->rows);
		while ($boolRows !== FALSE)
		{
			$strResult .= $boolRows;
			$boolRows = next($this->rows);
			if ($boolRows !== FALSE)
				$strResult .= ",";
		}
		$strResult .= "]";
		$strResult .= "}";
		$arrReplacements = array (
			"\r",
			"\n",
			"\t"
		);
		$strResult = str_replace($arrReplacements, "", $strResult);
		return $strResult;
    }

	/**
	 * returns pure json data object
	 * @return string
	 */
	public function __toString()
	{
		if(empty($this->isResponse)) {
			return $this->getData();
		}
		
		$strResult = $this->response;
		$strResult .= $this->columns;
		$strResult .= ",rows: [";
		$boolRows = reset($this->rows);
		while ($boolRows !== FALSE)
		{
			$strResult .= $boolRows;
			$boolRows = next($this->rows);
			if ($boolRows !== FALSE) {
				$strResult .= ",";
			}
		}
		$strResult .= "]";
		$strResult .= $this->closeResponse;
		$arrReplacements = array (
			"\r",
			"\n",
			"\t"
		);
		$strResult = str_replace($arrReplacements, "", $strResult);
		return $strResult;
	}

	/**
	 * getSignature
	 * @return string
	 */
	protected function getSignature()
	{
		srand($this->getMicrotime());
		$intRnd1 = rand();
		$intRnd2 = rand();
		$intRnd3 = rand();
		return strval($intRnd1).strval($intRnd2).strval($intRnd3);
	}

	/**
	 * getMicrotime
	 * @return float
	 */
	private function getMicrotime()
	{
		list ($strDatetime, $strMicrotime) = explode(' ', microtime());
		return (float) $strMicrotime + ((float) $strDatetime * 100000);
	}
}
