<?php

/**
 * Google_Format
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20


 * @desc Factory to load a formatter object
 *
 * The Google Visualization API provides formatters that can be used to reformat
 * data in a visualization. These formatters change the formatted value of the
 * specified column in all rows. Note that it does not modify the underlying
 * values; just the formatted values. So, for example, the displayed value would
 * be "$1,000.00" but the underlying value would still be "1000". Formatters can
 * only affect one column at a time; to reformat multiple columns, apply a
 * formatter to each column that you want to change.
 *
 * Important: Formatters can only be used with a DataTable; they cannot be used
 * with a DataView (DataView objects are read-only).
 *
 * Here are the general steps for using a formatter:
 *
 *    1. Get your populated DataTable object.
 *    2. For each column that you want to reformat:
 *
 *          1. Create an object that specifies all the options for your formatter.
 *             This is a basic JavaScript object with a set of properties and
 *             values. Look at your formatter's documentation to see what
 *             properties are supported. (Optionally, you can pass in an object
 *             literal notation object specifying your options.)
 *          2. Create your formatter, passing in your options object.
 *          3. Call formatter.Format(table, colIndex), passing in the DataTable
 *             and the (zero-based) column number of the data to reformat.
 *             Important: Many formatters require HTML tags to display special
 *             formatting; if your visualization supports an allowHtml option,
 *             you should set it to true.
 *
 * Here is an example of changing the formatted date values of a date column to
 * use a long date format ("January 1, 2009"):
 *
 * @example
 * var data = new google.visualization.DataTable();
 * data.addColumn('string', 'Employee Name');
 * data.addColumn('date', 'Start Date');
 * data.addRows(3);
 * data.setCell(0, 0, 'Mike');
 * data.setCell(0, 1, new Date(2008, 1, 28));
 * data.setCell(1, 0, 'Bob');
 * data.setCell(1, 1, new Date(2007, 5, 1));
 * data.setCell(2, 0, 'Alice');
 * data.setCell(2, 1, new Date(2006, 7, 16));
 *
 * // Create a formatter.
 * // This example uses object literal notation to define the options.
 * var formatter = new google.visualization.DateFormat({formatType: 'long'});
 *
 * // Reformat our data.
 * formatter.format(data, 1);
 *
 * // Draw our data
 * var table = new google.visualization.Table(document.getElementById('dateformat_div'));
 * table.draw(data, {showRowNumber: true});
 * 
 */
/**
 * Google_Format
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20


 * @desc Factory to load a formatter object
 *
 * The Google Visualization API provides formatters that can be used to reformat
 * data in a visualization. These formatters change the formatted value of the
 * specified column in all rows. Note that it does not modify the underlying
 * values; just the formatted values. So, for example, the displayed value would
 * be "$1,000.00" but the underlying value would still be "1000". Formatters can
 * only affect one column at a time; to reformat multiple columns, apply a
 * formatter to each column that you want to change.
 *
 * Important: Formatters can only be used with a DataTable; they cannot be used
 * with a DataView (DataView objects are read-only).
 *
 * Here are the general steps for using a formatter:
 *
 *    1. Get your populated DataTable object.
 *    2. For each column that you want to reformat:
 *
 *          1. Create an object that specifies all the options for your formatter.
 *             This is a basic JavaScript object with a set of properties and
 *             values. Look at your formatter's documentation to see what
 *             properties are supported. (Optionally, you can pass in an object
 *             literal notation object specifying your options.)
 *          2. Create your formatter, passing in your options object.
 *          3. Call formatter.Format(table, colIndex), passing in the DataTable
 *             and the (zero-based) column number of the data to reformat.
 *             Important: Many formatters require HTML tags to display special
 *             formatting; if your visualization supports an allowHtml option,
 *             you should set it to true.
 *
 * Here is an example of changing the formatted date values of a date column to
 * use a long date format ("January 1, 2009"):
 *
 * @example
 * var data = new google.visualization.DataTable();
 * data.addColumn('string', 'Employee Name');
 * data.addColumn('date', 'Start Date');
 * data.addRows(3);
 * data.setCell(0, 0, 'Mike');
 * data.setCell(0, 1, new Date(2008, 1, 28));
 * data.setCell(1, 0, 'Bob');
 * data.setCell(1, 1, new Date(2007, 5, 1));
 * data.setCell(2, 0, 'Alice');
 * data.setCell(2, 1, new Date(2006, 7, 16));
 *
 * // Create a formatter.
 * // This example uses object literal notation to define the options.
 * var formatter = new google.visualization.DateFormat({formatType: 'long'});
 *
 * // Reformat our data.
 * formatter.format(data, 1);
 *
 * // Draw our data
 * var table = new google.visualization.Table(document.getElementById('dateformat_div'));
 * table.draw(data, {showRowNumber: true});
 *
 */
class Google_Format {

	/**
	 * @var stdClass $properties
	 */
	protected $properties;

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * factory
	 * @desc factory class to call table formatter
	 * @param string $name
	 * @return instanceof Google_Format
	 */
	public static function factory($name) {

		switch($name) {
			case "Arrow":
				/** @var Google_Format_Arrow $arrow */
				$arrow = new Google_Format_Arrow;
				return $arrow;
			case "Bar":
				/** @var Google_Format_Pattern $bar */
				$bar = new Google_Format_Bar;
				return $bar;
			case "Color":
				/** @var Google_Format_Color $color */
				$color = new Google_Format_Color;
				return $color;
			case "Date":
				/** @var Google_Format_Date $date */
				$date = new Google_Format_Date;
				return $date;
			case "Number":
				/** @var Google_Format_Number $number */
				$number = new Google_Format_Number;
				return $number;
			case "Pattern":
				/** @var Google_Format_Pattern $pattern */
				$pattern = new Google_Format_Pattern;
				return $pattern;
			default:
				throw new Google_Exception_Format("A Formatter Object named $name does not exist.");
				break;
		}
	}

	/**
	 * __set
	 * @desc give direct access to object properties
	 * @example
	 * $obj->setDecimalSymbol(1) is equal to $obj->decimalSymbol = 1;
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value) {
		$this->setProperty($name, $value);
	}

	/**
	 * hasProperty
	 * @desc test if a chart type has a specific property
	 * @param string $name
	 * @return bool
	 */
	public function hasProperty($name, $properties) {
		return array_key_exists($name, $properties);
	}

	/**
	 * addProperty
	 * @param string $name
	 * @param array $parameters
	 * @return void
	 */
	protected function addProperty($name, array $parameters) {
		if(!$this->properties instanceof stdClass) {
			$this->properties = new stdClass;
			$this->properties->$name = array();
		}
		$this->properties->{$name}[] = $parameters;
	}

	/**
	 * setProperty
	 * @param string $name
	 * @param mixed $val
	 * @return void
	 */
    protected function setProperty($name, $val) {
		$r = new ReflectionClass(get_class($this));
		$arr = $r->getStaticProperties();
        if($this->hasProperty($name, $arr["isRegistered"])) {
			if(!$this->properties instanceof stdClass) {
				$this->properties = new stdClass;
			}
            $this->properties->$name = $val;
        } else {
            $e = new Google_Exception_Format("Formatter ".__CLASS__." does not support a property named $name.");
			echo $e->show();
        }
        return $this;
    }

	/**
	 * __call
	 * @desc sets a property while reflecting a formatter's registry
	 * @param string $name
	 * @param array $parameters
	 * @return void
	 */
	public function __call($name, $parameters) {
		// analyse property name
		$methodObject = Google_Base::getMethodType($name);
		$methodType = $methodObject["type"];
		$name = $methodObject["name"];
		switch($methodType) {
			case "set":
				$firstDown = Google_Base::ucFirstDown($name);
				$this->setProperty($firstDown, $parameters[0]);
				break;
		}
	}

	/**
	 * @return string empty string
	 */
	public function __toString() {
		return '';
	}

}