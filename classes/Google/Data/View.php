<?php

/**
 *
 * Google_Data_View
 * 
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 *
 * @desc
 * A read-only view of an underlying DataTable. A DataView allows selection of
 * only a subset of the columns and/or rows. It also allows reordering columns/rows,
 * and duplicating columns/rows.
 *
 * A view does not copy the data or meta-data of the underlying table. Every
 * change to the values in the underlying table is immediately reflected in the
 * view. Note the following:
 *
 * Adding/inserting/removing columns to the underlying table is not reflected in
 * the view, and might cause unexpected behavior in the view.
 * Adding/inserting/removing rows to the underlying table is only safe to use
 * and reflected in the view if none of the functions changing the rows-part of
 * the view were called (hideRows, setRows).
 * Changing values in existing rows/columns in the underlying table is always
 * immediately reflected in the view.
 * It is also possible to create a DataView on an underlying DataView. Note that
 * whenever an underlying table or view is mentioned, it refers to the level
 * immediately below this level. In other words, it refers to the data object
 * used to construct this DataView.
 * 
 */
/**
 *
 * Google_Data_View
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 *
 * @desc
 * A read-only view of an underlying DataTable. A DataView allows selection of
 * only a subset of the columns and/or rows. It also allows reordering columns/rows,
 * and duplicating columns/rows.
 *
 * A view does not copy the data or meta-data of the underlying table. Every
 * change to the values in the underlying table is immediately reflected in the
 * view. Note the following:
 *
 * Adding/inserting/removing columns to the underlying table is not reflected in
 * the view, and might cause unexpected behavior in the view.
 * Adding/inserting/removing rows to the underlying table is only safe to use
 * and reflected in the view if none of the functions changing the rows-part of
 * the view were called (hideRows, setRows).
 * Changing values in existing rows/columns in the underlying table is always
 * immediately reflected in the view.
 * It is also possible to create a DataView on an underlying DataView. Note that
 * whenever an underlying table or view is mentioned, it refers to the level
 * immediately below this level. In other words, it refers to the data object
 * used to construct this DataView.
 *
 */
class Google_Data_View {

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
	private $type = 'DataView';
	/**
	 * @var array $properties
	 */
	private $properties=null;
	/**
	 * @var string $dataTable
	 */
	private $dataTable='data';
	/**
	 * @var string $viewTable
	 */
	private $viewTable='dataView';

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * getInstance
	 * @var static
	 * @return Google_Data_View
	 */
	public static function getInstance() {
		return new Google_Data_View;
	}

	/**
	 * returns view table name
	 * @return string
	 */
	public function getViewTable(){
		return $this->viewTable;
	}

	/**
	 * setViewTable
	 * @param string $viewTable
	 * @return void
	 */
	public function setViewTable($viewTable) {
		$this->viewTable = $viewTable;
	}

	/**
	 * setDataTable
	 * @param string $dataTable
	 * @return void
	 */
	public function setDataTable($dataTable) {
		$this->dataTable = $dataTable;
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
	 * @example If setRows([3, 1, 4]) was previously called, then
	 * getTableRowIndex(2) will return 4.
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
	 * setColumns
	 * @desc Sets the columns in this view based on indexes from the underlying
	 * table/view. columnIndexes should be an array of numbers, greater than or
	 * equal to zero, and less than the number of columns as returned by the
	 * getNumberOfColumns() method of the underlying table/view. The specified
	 * column indexes are the indexes in the underlying table/view, which will
	 * be in the view, in the specified order. Note that only  the columns
	 * specified in columnIndexes will be shown; this method clears all other
	 * columns from the view. The array can also contain duplicates, effectively
	 * duplicating the specified column in this view (for example, setColumns([3, 4, 3, 2])
	 * will cause column 3 to appear twice in the view). The array thus provides
	 * a mapping of the columns from the underlying table/view to this view.
	 * @example To create a view with column three and zero of an underlying
	 * table/view: view.setColumns([3, 0])
	 * @param array|int $columnIndexes
	 * @param int $max
	 * @return void
	 */
	public function setColumns($columnIndexes, $max=null) {
		if(is_integer($max) and is_integer($columnIndexes)) {
			$this->properties[__FUNCTION__][] = Google_Base::toJson(array($columnIndexes, $max));
		} else {
			$this->properties[__FUNCTION__][] = Google_Base::toJson($columnIndexes);
		}
	}

	/**
	 * setRows
	 * @desc Sets the rows in this view based on indexes from the underlying
	 * table/view. rowIndexes should be an array of numbers, greater than or
	 * equal to zero, and less than the number of rows as returned by the
	 * getNumberOfRows() method of the underlying table/view. The specified row
	 * indexes are the indexes in the underlying table/view, which will be in
	 * the view, in the specified order. Note that only  the rows specified in
	 * rowIndexes will bw shown; this method clears all other rows from the view.
	 * The array can also contain duplicates, effectively duplicating the specified
	 * row in this view (for example, setRows([3, 4, 3, 2]) will cause row 3 to
	 * appear twice in this view). The array thus provides a mapping of the rows
	 * from the underlying table/view to this view.
	 * @example To create a view with rows three and zero of an underlying
	 * table/view: view.setRows([3, 0])
	 * @param array|int $rowIndexes
	 * @param int $max
	 * @return void
	 */
	public function setRows($rowIndexes, $max=null) {
		if(is_integer($max) and is_integer($rowIndexes)) {
			$this->properties[__FUNCTION__][] = '['.$rowIndexes.','.$max.']';
		} else {
			$this->properties[__FUNCTION__][] = Google_Base::toJson($rowIndexes);
		}
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		$string = 'var '.$this->viewTable.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '('. $this->dataTable.');';
		$string .= "\n";
		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= $this->viewTable .'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		$string .= "\n";
		return $string;
	}

}
