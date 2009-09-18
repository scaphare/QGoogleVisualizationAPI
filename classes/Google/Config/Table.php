<?php

/**
 * Google_Config_Table
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/table.html
 */
/**
 * Google_Config_Table
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/table.html
 */
class Google_Config_Table extends Google_Config_Base {

	protected $configuration = array(
		"allowHtml" => array("datatype" => "bool", "description" => "If set to true, formatted values of cells that include HTML tags will be rendered as HTML. If set to false, most custom formatters  will not work properly."),
		"page" => array(
			"datatype" => "string,object",
			"values" => array("enable","event","disable"),
			"description" => "Possible values are <strong>enable</strong>, <strong>event</strong>, and <strong>disable</strong>.<br/>If <strong>enable</strong> is used, the table will include page-forward and page-back buttons. Clicking on these buttons will perform the paging operation and change the displayed page.<br/>If <strong>event</strong> is used, the table will include page-forward and page-back buttons. Clicking on these buttons will trigger a <strong>page</strong> event and will not change the displayed page. This option should be used when the page implements its own paging.<br/>If <strong>disable</strong> is used (the default), paging will not be used. "
			),
		"pageSize" => array("datatype" => "integer", "description" => "The number of rows in each page, when paging is enabled."),
		"sort" => array(
			"datatype" => "string,object",
			"values" => array("enable","event","disable"),
			"description" => array("Possible values are <strong>enable</strong>, <strong>event</strong>, and <strong>disable</strong>.<br/>If <strong>enable</strong> is used (the default), users can click on column headers to sort by the clicked column. When users click on the column header, the rows will be automatically sorted, and a <strong>sort</strong> event will be triggered.<br/>If <strong>event</strong> is used, users can click on column headers to sort by the clicked column. When users click on the column header, a <strong>sort</strong> event will be triggered, but the rows will not be automatically sorted. This option should be used when the page implements its own sort.<br/>If <strong>disable</strong> is used, clicking a column header has no effect.")
		),
		"showRowNumber" => array(
			"datatype" => "string,object",
			"values" => array("enable","event","disable"),
			"description" => "If set to true, shows the row number as the first column of the table."
		),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
	);
}