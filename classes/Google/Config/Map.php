<?php

/**
 * Google_Config_Map
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/map.html
 */
/**
 * Google_Config_Map
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/map.html
 */
class Google_Config_Map extends Google_Config_Base {

	protected $configuration = array(
		"enableScrollWheel" => array("datatype" => "bool", "description" => "If set to true, enables zoom in and out using the mouse scroll wheel."),
		"showTip" => array("datatype" => "bool", "description" => "If set to true, shows the location description as a tooltip when the mouse is positioned above a point marker."),
		"showLine" => array("datatype" => "bool", "description" => "If set to true, shows a line going through all the points."),
		"lineColor" => array("datatype" => "string", "description" => "If showLine is true, defines the line color. For example: #800000."),
		"lineWidth" => array("datatype" => "integer", "description" => "If showLine is true, defines the line width (in pixels)."),
		"mapType" => array(
				"values" => array("satellite", "hybrid", "normal"), 
				"datatype" => "string",
				"description" => ""
		)
	);
}