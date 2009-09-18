<?php

/**
 * Google_Format_Bar
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds a colored bar to a numeric cell indicating whether the cell value
 * is above or below a specified base value.
 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/reference.html#arrowformatter
 */
/**
 * Google_Format_Bar
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds a colored bar to a numeric cell indicating whether the cell value
 * is above or below a specified base value.
 * {@example test_google_vis_table_color.php}
 */
class Google_Format_Color extends Google_Format implements Google_Format_Interface {

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
	private $type = 'ColorFormat';
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
	 * format
	 * @desc The standard format() method to apply formatting to the specified
	 * column.
	 * @param string $dataTable
	 * @param integer $srcColumnIndices
	 * @return void
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
	 * addRange
	 * @desc Assigns a foreground color and/or background color to a cell,
	 * depending on its value. Any cell with a value in the range specified by
	 * from—to, non-inclusive, will be displayed with the colors assigned to
	 * color and bgcolor. It is important to realize that the range is
	 * non-inclusive, because creating a range from 1—1,000 and a second
	 * from 1,000—2,000 will not cover the value 1,000!
	 * 
     * from - The low boundary (non-inclusive) of the numeric range, or null.
	 * If null, it will match -infinity.
     * to - The high boundary (non-inclusive) of the numeric range, or null.
	 * If null, it will match +infinity.
     * color - The color to apply to text in matching cells.
     * bgcolor - The color to apply to the background of matching cells.
	 *
	 * @param integer $from
	 * @param integer $to
	 * @param string $color
	 * @param string $bgColor
	 * @return void
	 */
	public function addRange($from, $to=0, $color='white', $bgColor='orange') {
		$this->addProperty("addRange", array((int) $from, (int) $to, "'".(string) $color."'", "'".(string) $bgColor."'"));
	}

	/**
	 * addGradientRange
	 * 
	 * @desc
	 * Assigns a background color from a range, according to the cell value.
	 * The color is scaled to match the cell's value within a range from a lower
	 * boundary color to an upper boundary color. Tip: Color ranges are often
	 * hard for viewers to gauge accurately; the simplest and easiest to read
	 * range is from a fully saturated color to white (e.g., #FF0000 #FFFFFF).
	 *
     * from - The low boundary (non-inclusive) of the numeric range, or null.
	 * If null, it will match -infinity.
     * to - The high boundary (non-inclusive) of the numeric range, or null.
	 * If null, it will match +infinity.
     * color - The color to apply to text in matching cells. This color is the
	 * same for all cells, no matter what their value.
     * fromBgColor - The color at the low end of the gradient, to apply to the
	 * cell background.
     * toBgColor - The color at the high end of the gradient, to apply to the
	 * cell background.
	 * 
	 * @param integer $from
	 * @param integer $to
	 * @param string $color
	 * @param string $bgColor
	 * @return void
	 */
	public function addGradientRange($from=1000, $to=0, $color='white', $bgColor='orange') {
		$this->addProperty("addGradientRange", array((int) $from, (int) $to, "'".(string) $color."'", "'".(string) $bgColor."'"));
	}

	/**
	 * @desc returns table color formatter template
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '()';
		$string .= "\n";
		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= 'formatter.'.$method.'('.implode(',',$signature).');'."\n";
				}
			}
		}
		$string .= 'formatter.format('.$this->dataTable.', '.$this->srcColumnIndices.');';
		$string .= "\n";
		return $string;
	}


}