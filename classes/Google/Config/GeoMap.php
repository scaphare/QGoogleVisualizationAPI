<?php

/**
 * Google_Config_GeoMap
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/geomap.html
 * @desc
 * A geomap is a map of a country, continent, or region map, with colors and
 * values assigned to specific regions. Values are displayed as a color scale,
 * and you can specify optional hovertext for regions. The map is rendered in
 * the browser using an embedded Flash player. Note that the map is not scrollable
 * or draggable, but can be configured to allow zooming.
 */
/**
 * Google_Config_GeoMap
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/geomap.html
 * @desc
 * A geomap is a map of a country, continent, or region map, with colors and
 * values assigned to specific regions. Values are displayed as a color scale,
 * and you can specify optional hovertext for regions. The map is rendered in
 * the browser using an embedded Flash player. Note that the map is not scrollable
 * or draggable, but can be configured to allow zooming.
 * 
 */
class Google_Config_GeoMap extends Google_Config_Base {

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
		),
		"region" => array("datatype" => "string", "description" => "The area to display on the map. (Surrounding areas will be displayed as well.)"),
		"dataMode" => array("datatype" => "string", "description" => "How to display values on the map. Two values are supported: regions, markers"),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
		"colors" => array("datatype" => "array", "description" => "The colors to use for the chart elements. An array of strings. Each element is a string that is a color supported by HTML, for example 'red' or '#00cc00'."),
		"showLegend" => array("datatype" => "bool", "description" => "If true, display a legend for the map."),
		"showZoomOut" => array("datatype" => "bool", "description" => "If true, display a button with the label specified by the zoomOutLabel property. Note that this button does nothing when clicked, except throw the zoomOut event. To handle zooming, catch this event and change the region option. You can only specify showZoomOut if the region option is smaller than the world view. One way of enabling zoom in behavior would be to listen for the regionClick event, change the region property to the appropriate region, and reload the map."),
		"zoomOutLabel" => array("datatype" => "string", "description" => "Label for the zoom button."),
	);

	protected $methods = array(
		"draw" => array("data" => "var", "options" => "var,object"),
		"getSelection" => array(),
		"setSelection" => array("selection" => "var"),
	);

	protected $events = array(
		"select" => "dataMode",
		"regionClick" => "dataMode",
		"zoomOut" => "dataMode",
		"drawingDone" => true
	);
	
}