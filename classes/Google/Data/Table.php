<?php	

/**
 * Google_Data_Table
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Represents a two-dimensional table of values. Every column has a single data type.
 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/reference.html#DataTable
 */
/**
 * Google_Data_Table
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Represents a two-dimensional table of values. Every column has a single data type.
 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/reference.html#DataTable
 */
class Google_Data_Table {

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
	private $type = 'DataTable';
	/**
	 * @var string $dataTable
	 */
	private $dataTable='data';

	private $properties=null;
	/**
	 * @var Google_Data_Rows $properties
	 */
	private $data;
	/**
	 * @var string $version
	 */
	private $version;
	/**
	 * @var Google_Data_Base|string $assigned_data
	 */
	private $assigned_data = null;

	/**
	 * constructor
	 * @param Google_Data_Rows $data
	 * @param string $version
	 */
	public function __construct($data = null, $version = null) {
		$this->data = $data;
		$this->version = $version;
	}

	/**
	 * addColumn
	 *
	 * @desc adds a new column to the data table, and returns the index of the
	 * new column. All the cells of the new column are assigned a null value.
     * type should be a string with the data type of the values of the column.
	 * The type can be one of the following:
	 * 'string' 'number' 'boolean' 'date' 'datetime' 'timeofday'.
     * label should be a string with the label of the column. The column label
	 * is typically displayed as part of the visualization, for example as a
	 * column header in a table, or as a legend label in a pie chart. If not
	 * value is specified, an empty string is assigned.
     * id should be a string with a unique identifier for the column. If not
	 * value is specified, an empty string is assigned.
	 * 
	 * @param string $type
	 * @param string $label
	 * @param string $id
	 * @return void
	 */
	public function addColumn($type, $label=null, $id=null) {

		if($type) {
			$arr = array();
			switch($type) {
				case "string":
				case "number":
				case "boolean":
				case "date":
				case "datetime":
				case "timeofday":
					$arr[] = "'$type'";
					break;
			}
			if($label) {
				$arr[] = "'$label'";
			}
			if(!$label and $id) {
				$arr[] = "''";
				$arr[] = "'$id'";
			} elseif($label and $id) {
				$arr[] = "'$id'";
			}
			$this->properties[__FUNCTION__][] = $arr;
		}
	}

	/**
	 * addRows
	 * @desc Adds a new row to the data table, and returns the index of the new
	 * row. All the cells of the new row are assigned a null value.
	 * @return void
	 */
	public function addRow() {
		$this->properties[__FUNCTION__][] = '';
	}

	/**
	 * addRows
	 * @desc Adds new rows to the data table, and returns the index of the last
	 * added row.
     * numberOfRows is the number of rows to add. All the cells of the new rows
	 * are assigned a null value.
	 * @param integer $numberOfRows
	 * @return void
	 */
	public function addRows($numberOfRows) {
		$this->properties[__FUNCTION__][] = $numberOfRows;
	}

	public function clon() {
		$this->properties["clone"][] = '';
	}

	/**
	 * getColumnId
	 * @desc Returns the identifier of a given column specified by the column
	 * index in the underlying table.
	 * @param integer$columnIndex
	 * @return void
	 */
	public function getColumnId($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnLabel
	 * @desc Returns the label of a given column specified by the column index
	 * in the underlying table. The column label is typically displayed as part
	 * of the visualization. For example the column label can be displayed as a
	 * column header in a table, or as the legend label in a pie chart.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnLabel($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnPattern
	 * @desc Returns the formatting pattern used to format the values of the specified column.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnPattern($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified column.
	 * @param integer $columnIndex
	 * @param string $name
	 * @return void
	 */
	public function getColumnProperty($columnIndex, $name) {
		$this->properties[__FUNCTION__][] = $columnIndex.",".$name;
	}

	/**
	 * getColumnRange
	 * @desc Returns the minimal and maximal values of values in a specified column.
	 * The returned object has properties min and max. If the range has no values,
	 * min and max will contain null.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnRange($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnType
	 * @desc Returns the type of a given column specified by the column index.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnType($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getDistinctValues
	 * @desc Returns the unique values in a certain column, in ascending order.
	 * @param index $columnIndex
	 * @return void
	 */
	public function getDistinctValues($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getFilteredRows
	 * @desc Returns the row indexes for rows that match all of the given filters.
	 * The indexes are returned in ascending order.
     *
	 * filters an array of filter objects that describe an acceptable row. A row
	 * index is returned by this method if it matches all of the given filters.
	 * Each filter is an object with a numeric 'column' property that specifies
	 * the index of the column in the row to assess, and one of the following:
	 * o a 'value' property with a value that must be matched exactly by the
	 *   specified column in the row. It should be of the same type as the column;
	 *   or
	 * o both 'minValue' and 'maxValue' properties, where a row value matches the
	 *   filter if minValue <= row value <= maxValue. Both properties should be
	 *   of the same type as the column.
	 *
	 * @param array $filters
	 * @return void
	 */
	public function getFilteredRows(array $filters) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($filters);
	}

	/**
	 * getFormattedValue
	 * @desc Returns the formatted value of the cell at the given row and column indexes.
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getFormattedValue($rowIndex, $columnIndex) {
		$this->properties[__FUNCTION__][] = $rowIndex.",".$columnIndex;
	}

	/**
	 * getNumberOfColumns
	 * @desc Returns the number of columns in the table.
	 * @return void
	 */
	public function getNumberOfColumns() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getNumberOfRows
	 * @desc Returns the number of rows in the table.
	 * @return void
	 */
	public function getNumberOfRows() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified cell.
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $name
	 * @return void
	 */
	public function getProperty($rowIndex, $columnIndex, $name) {
		$this->properties[__FUNCTION__][] = implode(",",array($rowIndex, $columnIndex, $name));
	}

	/**
	 * getRowProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified row.
	 * @param integer $rowIndex
	 * @param string $name
	 * @return void
	 */
	public function getRowProperty($rowIndex, $name) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $name));
	}

	/**
	 * getSortedRows
	 * @desc Returns a sorted version of the table without modifying the order of
	 * the underlying data. To permanently sort the underlying data, call sort().
	 * You can specify sorting in a number of ways, depending on the type you pass
	 * in to the sortColumns parameter:
	 * @param array $sortColumns
	 * @return void
	 */
	public function getSortedRows($sortColumns) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($sortColumns);
	}

	/**
	 * getTableProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the table.
     * name is a string with the property name.
	 * @param string $name
	 * @return void
	 */
	public function getTableProperty($name) {
		$this->properties[__FUNCTION__][] = $name;
	}

	/**
	 * getValue
	 * @desc
	 * Returns the value of the cell at the given row and column indexes.
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
	 *
	 * The type of the returned value depends on the column type (see getColumnType):
     * If the column type is 'string', the value is a string.
     * If the column type is 'number', the value is a number.
     * If the column type is 'boolean', the value is a boolean.
     * If the column type is 'date' or 'datetime', the value is a Date object.
     * If the column type is 'timeofday', the value is an array of four numbers:
	 * [hour, minute, second, millisenconds].
     * If the column value is a null value, regardless of the column type, the returned value is null.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getValue($rowIndex, $columnIndex) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $columnIndex));
	}

	/**
	 * getTableColumnIndex
	 * @desc Returns the index in the underlying table (or view) of a given column
	 * specified by its index in this view. viewColumnIndex should be a number
	 * greater than or equal to zero, and less than the number of columns as
	 * returned by the getNumberOfColumns() method.
	 * @example If setColumns([3, 1, 4]) was previously called, then
	 * getTableColumnIndex(2) will return 4.
	 * @param integer $viewColumnIndex
	 * @return void
	 */
	public function getTableColumnIndex($viewColumnIndex) {
		$this->properties[__FUNCTION__][] = $viewColumnIndex;
	}

	/**
	 * getTableRowIndex
	 * @desc Returns the index in the underlying table (or view) of a given row
	 * specified by its index in this view. viewRowIndex should be a number
	 * greater than or equal to zero, and less than the number of rows as returned
	 * by the getNumberOfRows() method.
	 * If setRows([3, 1, 4]) was previously called, then
	 * getTableRowIndex(2) will return 4.
	 * 
	 * @example
	 * @param integer $viewRowIndex
	 * @return void
	 */
	public function getTableRowIndex($viewRowIndex) {
		$this->properties[__FUNCTION__][] = $viewRowIndex;
	}

	/**
	 * getViewColumnIndex
	 * @desc Returns the index in this view that maps to a given column specified
	 * by its index in the underlying table (or view). If more than one such index
	 * exists, returns the first (smallest) one. If no such index exists (the
	 * specified column is not in the view), returns -1. tableColumnIndex should
	 * be a number greater than or equal to zero, and less than the number of
	 * columns as returned by the getNumberOfColumns() method of the underlying
	 * table/view.
	 * @example If setColumns([3, 1, 4]) was previously called, then
	 * getViewColumnIndex(4) will return 2.
	 * @param integer $tableColumnIndex
	 * @return void
	 */
	public function getViewColumnIndex($tableColumnIndex) {
		$this->properties[__FUNCTION__][] = $tableColumnIndex;
	}

	/**
	 * getViewRowIndex
	 * @desc Returns the index in this view that maps to a given row specified by
	 * its index in the underlying table (or view). If more than one such index
	 * exists, returns the first (smallest) one. If no such index exists (the
	 * specified row is not in the view), returns -1. tableRowIndex should be a
	 * number greater than or equal to zero, and less than the number of rows as
	 * returned by the getNumberOfRows() method of the underlying table/view.
	 * @example If setRows([3, 1, 4]) was previously called, then getViewRowIndex(4)
	 * will return 2.
	 * @param integer $tableRowIndex
	 * @return void
	 */
	public function getViewRowIndex($tableRowIndex) {
		$this->properties[__FUNCTION__][] = $tableRowIndex;
	}

	/**
	 * hideColumns
	 * @desc Hides the specified columns from the current view. columnIndexes is
	 * an array of numbers representing the indexes of the columns to hide. These
	 * indexes are the index numbers in the underlying table/view. The numbers in
	 * columnIndexes do not have to be in order (that is, [3,4,1] is fine). The
	 * remaining columns retain their index order when you iterate through them.
	 * Entering an index number for a column already hidden is not an error, but
	 * entering an index that does not exist in the underlying table/view will
	 * throw an error. To unhide columns, call setColumns().
	 * @example If you have a table with 10 columns, and you call setColumns([2,7,1,7,9]),
	 * and then hideColumns([7,9]), the columns in the view will then be [2,1].
	 * @param array $columnIndexes
	 * @return void
	 */
	public function hideColumns($columnIndexes=null) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($columnIndexes);
	}

	/**
	 * getViewColumns
	 * @desc Returns the columns in this view, in order. That is, if you call
	 * setColumns with some array, and then call getViewColumns() you should get
	 * an identical array.
	 * @return void
	 */
	public function getViewColumns() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getViewRows
	 * @desc Returns the rows in this view, in order. That is, if you call
	 * setRows with some array, and then call getViewRows() you should get an
	 * identical array.
	 * @return void
	 */
	public function getViewRows() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * hideRows
	 * @desc Hides the specified rows from the current view. rowIndexes is an
	 * array of numbers representing the indexes of the rows to hide. These
	 * indexes are the index numbers in the underlying table/view. The numbers
	 * in rowIndexes do not have to be in order (that is, [3,4,1] is fine). The
	 * remaining rows retain their index order. Entering an index number for a
	 * row already hidden is not an error, but entering an index that does not
	 * exist in the underlying table/view will throw an error. To unhide rows,
	 * call setRows().
	 * @example If you have a table with 10 rows, and you call setRows([2,7,1,7,9]),
	 * and then hideRows([7,9]), the rows in the view will then be [2,1].
	 * @param array $rowIndexes
	 * @return void
	 */
	public function hideRows($rowIndexes = null) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($rowIndexes);
	}

	/**
	 * insertColumn
	 * @desc Inserts a new column to the data table, at the specifid index. All
	 * existing columns at or after the specified index are shifted to a higher
	 * index.
	 *
     * columnIndex is a number with the required index of the new column.
     * type should be a string with the data type of the values of the column.
	 * The type can be one of the following:
	 * 'string' 'number' 'boolean' 'date' 'datetime' 'timeofday'.
     * label should be a string with the label of the column. The column label
	 * is typically displayed as part of the visualization, for example as a
	 * column header in a table, or as a legend label in a pie chart. If no
	 * value is specified, an empty string is assigned.
     * id should be a string with a unique identifier for the column. If no
	 * value is specified, an empty string is assigned.
	 * 
	 * @param integer $columnIndex
	 * @param string $type
	 * @param string $label
	 * @param string $id
	 * @return void
	 */
	public function insertColumn($columnIndex, $type, $label=null, $id=null) {
		$arr = array();
		$arr[] = $columnIndex;
		if($type) {
			switch($type) {
				case "string":
				case "number":
				case "boolean":
				case "date":
				case "datetime":
				case "timeofday":
					$arr[] = "'$type'";
					break;
			}
			if($label) {
				$arr[] = "'$label'";
			}
			if(!$label and $id) {
				$arr[] = "''";
				$arr[] = "'$id'";
			} elseif($label and $id) {
				$arr[] = "'$id'";
			}
			$this->properties[__FUNCTION__][] = $arr;
		}
	}

	/**
	 * insertRows
	 * @desc Insert the specified number of rows at the specified row index.
     * rowIndex is a number with the required index of the first new row.
	 * @param <type> $rowIndex
	 * @param <type> $numberOfRows 
	 * @return void
	 */
	public function insertRows($rowIndex, $numberOfRows) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $numberOfRows));
	}

	/**
	 * removeColumn
	 * @desc Removes the column at the specified index. 
	 * @param integer $columnIndex
	 * @return void
	 */
	public function removeColumn($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * removeColumns
	 * @desc Removes the specified number of columns starting from the column
	 * at the specified index.
	 * @param integer $columnIndex is the number of columns to remove.
	 * @param integer $numberOfColumns should be a number with a valid column index. 
	 * @return void
	 */
	public function removeColumns($columnIndex, $numberOfColumns) {
		$this->properties[__FUNCTION__][] = implode(",", array($columnIndex, $numberOfColumns));
	}

	/**
	 * removeRow
	 * @desc Removes the row at the specified index.
	 * @param integer $rowIndex
	 * @return void
	 */
	public function removeRow($rowIndex) {
		$this->properties[__FUNCTION__][] = $rowIndex;
	}

	/**
	 * removeRows
	 * @desc Removes the specified number of rows starting from the row
	 * at the specified index.
	 * @param integer $rowsIndex is the number of rows to remove.
	 * @param integer $numberOfRows should be a number with a valid row index.
	 * @return void
	 */
	public function removeRows($rowIndex, $numberOfRows) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $numberOfRows));
	}

	/**
	 * setCell
	 * 
	 * @desc Sets the value, and optionally the formatted value and properties,
	 * of a cell. To simply change the cell value, use setValue
	 * # rowIndex should be a number greater than or equal to zero, and less
	 *   than the number of rows as returned by the getNumberOfRows() method.
	 * # columnIndex should be a number greater than or equal to zero, and less
	 *   than the number of columns as returned by the getNumberOfColumns()
	 *   method.
	 * # value is the value assigned to the specified cell. The type of the
	 *   returned value depends on the column type (see getColumnType):
     *   - If the column type is 'string', the value should be a string.
     *   - If the column type is 'number', the value should be a number.
     *   - If the column type is 'boolean', the value should be a boolean.
     *   - If the column type is 'date' or 'datetime', the value should be a Date object.
     *   - If the column type is 'timeofday', the value should be an array of
	 *     four numbers: [hour, minute, second, millisenconds].
     *     For any column type, the value can be set to null.
	 * # formattedValue is a string with the value formatted as a string. If null
	 *   is specified, or if this parameter is omitted, the default formatting
	 *   will be applied. The formatted value is typically used by visualizations
	 *   to display value labels. For example the formatted value can appear as a
	 *   label text within a pie chart.
	 * # properties is an optional Object (name/value map) with additional properties
	 *   for this cell. If null is specified, or if this parameter is omitted, no
	 *   additional properties are assigned to this cell. Some visualizations support
	 *   row, column, or cell properties to modify their display or behavior;
	 *   see the visualization documentation to see what properties are supported
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $value
	 * @param string $formattedValue
	 * @param stdClass $properties
	 * @return void
	 */
	public function setCell($rowIndex, $columnIndex, $value, $formattedValue=null, $properties=null) {

		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = $value;

		if($formattedValue) {
			$arr[] = $formattedValue;
		}
		if($properties instanceof stdClass) {
			$arr[] = Google_Base::toJSON($properties);
		}
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setColumnLabel
	 * 
	 * @desc Sets the label of a column.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
     * label is a string with the label to assign to the column. The column label
	 * is typically displayed as part of the visualization. For example the column
	 * label can be displayed as a column header in a table, or as the legend
	 * label in a pie chart.
	 * 
	 * @param integer $columnIndex
	 * @param string $label
	 * @return void
	 */
	public function setColumnLabel($columnIndex, $label) {
		$this->properties[__FUNCTION__][] = $columnIndex . ",'".$label."'";
	}

	/**
	 * setColumnProperty
	 * 
	 * @desc Sets a single column property. Some visualizations support row,
	 * column, or cell properties to modify their display or behavior; see the
	 * visualization documentation to see what properties are supported.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
     * name is a string with the property name.
     * value is a value of any type to assign to the specified named property of
	 * the specified column.
	 *
	 * @param integer $columnIndex
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function setColumnProperty($columnIndex, $name, $value) {
		$arr = array();
		$arr[] = $columnIndex;
		$arr[] = "'". $name . "'";

		$t = gettype($value);
		switch($t) {
			case 'bool':
				$arr[] = true===$value?'true':'false';
				break;
			case 'array':
			case 'object':
				$arr[] = Google_Base::toJSON($value);
				break;
			default:
				$arr[] = $value;
				break;
		}
		
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setColumnProperties
	 *
	 * @desc Sets multiple column properties. Some visualizations support row,
	 * column, or cell properties to modify their display or behavior;
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
     * properties is an Object (name/value map) with additional properties for
	 * this column. If null is specified, all additional properties of the
	 * column will be removed.
	 *
	 * @param integer $columnIndex
	 * @param stdClass $properties
	 * @return void
	 */
	public function setColumnProperties($columnIndex, $properties) {
		$arr = array();
		$arr[] = $columnIndex;
		$arr[] = Google_Base::toJSON($value);
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setFormattedValue
	 *
	 * @desc Sets the formatted value of a cell.
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
     * formattedValue is a string with the value formatted for display.
	 * 
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $formattedValue
	 * @return void
	 */
	public function setFormattedValue($rowIndex, $columnIndex, $formattedValue) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = "'". $formattedValue."'";
		$this->properties[__FUNCTION__][] = $arr;
	}
	
	/**
	 * setProperty
	 *
	 * @desc Sets a cell property. Some visualizations support row, column, or
	 * cell properties to modify their display or behavior;
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less than
	 * the number of columns as returned by the getNumberOfColumns() method.
     * name is a string with the property name.
     * value is a value of any type to assign to the specified named property of
	 * the specified cell.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $name
	 * @param string $value
	 * @return void
	 */
	public function setProperty($rowIndex, $columnIndex, $name, $value) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = "'".$name."'";
		$arr[] = $value; // @TODO recognition of data type

		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setProperties
	 *
	 * @desc Sets multiple cell properties. Some visualizations support row, column,
	 * or cell properties to modify their display or behavior;
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less than
	 * the number of columns as returned by the getNumberOfColumns() method.
     * properties is an Object (name/value map) with additional properties for
	 * this cell. If null is specified, all additional properties of the cell
	 * will be removed.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param stdClass $properties
	 * @return void
	 */
	public function setProperties($rowIndex, $columnIndex, $properties) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = Google_Base::toJSON($properties);
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setRowProperty
	 *
	 * @desc Sets a row property. Some visualizations support row, column, or
	 * cell properties to modify their display or behavior;
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * name is a string with the property name.
     * value is a value of any type to assign to the specified named property of
	 * the specified row.
	 *
	 * @param integer $rowIndex
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function setRowProperty($rowIndex, $name, $value) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = "'".$name."'";
		$arr[] = $value; // @TODO recognition of data type

		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setRowProperties
	 *
	 * @desc Sets multiple row properties. Some visualizations support row,
	 * column, or cell properties to modify their display or behavior;
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * properties is an Object (name/value map) with additional properties for
	 * this row. If null is specified, all additional properties of the row will
	 * be removed.
	 *
	 * @param integer $rowIndex
	 * @param stdClass $properties
	 * @return void
	 */
	public function setRowProperties($rowIndex, $properties) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = Google_Base::toJSON($properties);
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setTableProperty
	 *
	 * @desc Sets a single table property. Some visualizations support table,
	 * row, column, or cell properties to modify their display or behavior;
     * name is a string with the property name.
     * value is a value of any type to assign to the specified named property of the table.
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function setTableProperty($name, $value) {
		$arr = array();
		$arr[] = "'".$name."'";
		$arr[] = $value; // @TODO recognition of data type
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setTableProperties
	 *
	 * @desc Sets multiple table table. Some visualizations support table, row,
	 * column, or cell properties to modify their display or behavior;
	 *
     * properties is an Object (name/value map) with additional properties for
	 * the table. If null is specified, all additional properties of the table will be removed.
	 *
	 * @param stdClass $properties
	 * @return void
	 */
	public function setTableProperties($properties) {
		$arr = array();
		$arr[] = Google_Base::toJSON($properties);
		$this->properties[__FUNCTION__][] = $arr;
	}
	
	/**
	 * setValue
	 *
	 * @desc Sets the value of a cell. In addition to overwriting any existing
	 * cell value, this method will also clear out any formatted value and
	 * properties for the cell.
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
	 * This method does not let you set a formatted value for this cell;
	 * to do that, call setFormattedValue().
     * value is the value assigned to the specified cell. The type of the returned
	 * value depends on the column type (see getColumnType):
     *     o If the column type is 'string', the value should be a string.
     *     o If the column type is 'number', the value should be a number.
     *     o If the column type is 'boolean', the value should be a boolean.
     *     o If the column type is 'date' or 'datetime', the value should be a
	 *       Date object.
     *     o If the column type is 'timeofday', the value should be an array of
	 *       four numbers: [hour, minute, second, millisenconds].
     *     o For any column type, the value can be set to null.
	 * 
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param mixed $value 
	 * @return void
	 */
	public function setValue($rowIndex, $columnIndex, $value) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = $value; // @TODO recognition of data type
		$this->properties[__FUNCTION__][] = $arr;
	}
	
	/**
	 * sort
	 * 
	 * @desc Sorts the rows, according to the specified sort columns. 
	 * The DataTable is modified by this method. See getSortedRows() for a 
	 * description of the sorting details. This method does not return the 
	 * sorted data.
	 * @see getSortedRows
	 * @example To sort by the third column and then by the second column, 
	 * @uses data.sort([{column: 2}, {column: 1}]);
	 * 
	 * @param array $sortColumns 
	 * @return void
	 */
	public function sort(array $sortColumns) {
		$this->properties[__FUNCTION__][] = Google_Base::toJSON($sortColumns);
	}

	/**
	 * custom function
	 */
	/**
	 * assignData
	 * @param Google_Data_Base $data
	 * @return void
	 */
	public function assignData(Google_Data_Base $data) {
		$this->assigned_data = $data;
	}

	/**
	 * setDataTable
	 * @desc change the javascript variable name of the data table
	 * @param string $name
	 * @return void
	 */
	public function setDataTable($name) {
		$this->dataTable = (string)$name;
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		$string = '';
		if($this->assigned_data instanceof Google_Data_Base) {
			$this->data = $this->assigned_data->getName();
			$string .= 'var '.$this->data.'='.$this->assigned_data->getData().";\n";
		}

		$string .= 'var '.$this->dataTable.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '(';
		if($this->data) $string .= $this->data;
		if($this->version) $string .= ','.$this->version;
		$string .= ')';
		$string .= ";\n";

		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= $this->dataTable.'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		$string .= "\n";
		return $string;

	}
}
