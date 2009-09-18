<?php

/**
 * Google_Config_Gauge
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc configuration object for gauges
 * {@example test_google_vis_gauge.php}
 *
 */
/**
 * Google_Config_Gauge
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc configuration object for gauges
 * @see http://code.google.com/apis/visualization/documentation/gallery/gauge.html
 *
 */
class Google_Config_Gauge extends Google_Config_Base {

	protected $configuration = array(
		"greenFrom" => array("datatype" => "integer", "description" => "The lowest value for a range marked by a green color."),
		"greenTo" => array("datatype" => "integer", "description" => "The highest value for a range marked by a green color."),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"majorTicks" => array("datatype" => "array", "description" => "Labels for major tick marks. The number of labels define the number of major ticks in all gauges. The default is five major ticks, with the labels of the minimal and maximal gauge value."),
		"max" => array("datatype" => "integer", "description" => "The maximal value of a gauge. "),
		"min" => array("datatype" => "integer", "description" => "The minimal value of a gauge."),
		"minorTicks" => array("datatype" => "integer", "description" => "The number of minor tick section in each major tick section."),
		"redFrom" => array("datatype" => "integer", "description" => " 	The lowest value for a range marked by a red color."),
		"redTo" => array("datatype" => "integer", "description" => "The highest value for a range marked by a red color."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
		"yellowFrom" => array("datatype" => "integer", "description" => "The lowest value for a range marked by a yellow color."),
		"yellowTo" => array("datatype" => "integer", "description" => "The highest value for a range marked by a yellow color."),
	);
}