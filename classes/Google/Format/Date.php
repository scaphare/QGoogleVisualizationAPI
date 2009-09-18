<?php

/**
 * Google_Format_Date
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Formats a JavaScript Date value in a variety of ways, including
 * "January 1, 2009," "1/1/09" and "Jan 1, 2009.
 *
 */
/**
 * Google_Format_Date
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Formats a JavaScript Date value in a variety of ways, including
 * "January 1, 2009," "1/1/09" and "Jan 1, 2009.
 * {@example test_google_vis_table_date.php}
 *
 */
class Google_Format_Date extends Google_Format implements Google_Format_Interface {

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
	private $type = 'DateFormat';
	/**
	 * @var string $dataTable
	 */
	private $dataTable = 'data';
	/**
	 * @var integer $srcColumnIndices
	 */
	private $srcColumnIndices = 0;

	/**
	 * @var string $prefix
	 */
	private $prefix = '';

	/**
	 * @var array $properties
	 */
	protected $properties;

	/**
	 * constructor
	 * @param string $prefix
	 */
	public function __construct($prefix='') {
		$this->prefix = '_'.$prefix;
		$this->properties = new stdClass;
	}

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
	 * formatType
	 * @desc A quick formatting option for the date. The following string values
	 * are supported, reformatting the date February 28, 2008 as shown:
     * 'short' - Short format: e.g., "2/28/08"
     * 'medium' - Medium format: e.g., "Feb 28, 2008"
     * 'long' - Long format: e.g., "February 28, 2008"
	 * You cannot specify both formatType and pattern.
	 *
	 * @param string $column short|medium|long
	 * @return void
	 */
	public function formatType($formatType='short') {
		switch($formatType){
			case "short":
			case "medium":
			case "long":				
				$this->properties->formatType = (string)$formatType;
				break;
		}		
	}

	/**
	 * pattern
	 *
	 * @desc A custom format pattern to apply to the value, similar to the ICU
	 * date and time format.
	 * You cannot specify both formatType and pattern.
	 * @example
	 * <code>
	 * var formatter3 = new google.visualization.DateFormat({pattern: "EEE, MMM d, ''yy"});
	 * </code>
	 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/reference.html#dateformatter
	 * @param string $pattern
	 * @return void
	 */
	public function pattern($pattern) {
		$this->properties->pattern = $pattern;
	}

	/**
	 * timezone
	 * @desc The time zone in which to display the date value. This is a numeric
	 * value, indicating GMT + this number of time zones (can be negative). Date
	 * object are created by default with the assumed time zone of the computer
	 * on which they are created; this option is used to display that value in a
	 * different time zone. For example, if you created a Date object of 5pm noon
	 * on a computer located in Greenwich, England, and specified timeZone to be
	 * -5 (options['timeZone'] = -5, or Eastern Pacific Time in the US), the value
	 * displayed would be 12 noon.
	 * 
	 * @param integer $timeZone
	 * @return void
	 */
	public function timezone($timeZone) {
		$this->properties->timeZone = (int) $timeZone;
	}

	/**
	 * @desc table date formatter template
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter'.$this->prefix.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '('.(!empty($this->properties)?Google_Base::toJson($this->properties):'').');';
		$string .= "\n";
		$string .= 'formatter'.$this->prefix.'.format('.$this->dataTable.', '.$this->srcColumnIndices.');';
		$string .= "\n";
		return $string;
	}
}