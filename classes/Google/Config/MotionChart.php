<?php

/**
 * Google_Config_MotionChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc A dynamic chart to explore several indicators over time.
 * The chart is rendered within the browser using Flash.
 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/gallery/motionchart.html
 */

/**
 * Google_Config_MotionChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/gallery/motionchart.html
 * @desc A dynamic chart to explore several indicators over time.
 * The chart is rendered within the browser using Flash.
 */
class Google_Config_MotionChart extends Google_Config_Base {

	protected $configuration = array(
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
		"state" => array("datatype" => "string"),
		"showSelectListComponent" => array("datatype" => "bool"),
		"showSidePanel" => array("datatype" => "bool"),
		"showXMetricPicker" => array("datatype" => "bool"),
		"showYMetricPicker" => array("datatype" => "bool"),
		"showYMetricPicker" => array("datatype" => "bool"),
		"showXScalePicker" => array("datatype" => "bool"),
		"showAdvancedPanel" => array("datatype" => "bool"),
	);


	protected $methods = array(
		"draw" => array("data" => "var", "options" => "var,object"),
		"getState" => array(),
	);

	protected $events = array(
		"ready" => true,
	);

}