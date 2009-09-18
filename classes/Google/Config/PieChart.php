<?php

/**
 * Google_Config_PieChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/piechart.html
 */
/**
 * Google_Config_PieChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/piechart.html
 */
class Google_Config_PieChart extends Google_Config_Base {

	protected $configuration = array(
		"title" => array("datatype" => "string", "description" => "Text to display above the chart."), 
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
		"legend" => array(
			"values" => array("right", "left", "top", "bottom", "none"), 
			"datatype" => "string",
		    "description" => "Position and type of legend. Can be one of the following:<ul><li><b>right</b> - To the right of the chart.</li><li><b>left</b> - To the left of the chart.</li><li><b>top</b> - Above the chart.</li><li><b>bottom</b> - Below the chart.</li><li><b>none</b> - No legend is displayed.</li></ul>"
		),  
		"is3D" => array("datatype" => "bool", "description" => "If set to true, displays a three-dimensional chart."),
		"titleColor" => array("datatype" => "string,object", "description" => "The color for the chart's title. Possible values are as those of the backgroundColor configuration option."),
		"backgroundColor" => array("datatype" => "string,object", "description" => "The background color for the main area of the chart. May be one of the following options:<ul><li>A string with color supported by HTML, for example 'red' or '#00cc00'</li><li>An object with properties stroke fill and strokeSize.</li></ul>stroke and fill should be a string with a color. strokeSize is a number.<br/>For example: {backgroundColor: {stroke:'black', fill:'#eee', strokeSize: 1}. To use just fill, without a stroke, use stroke:null, strokeSize: 0."),
		"borderColor" => array("datatype" => "string,object", "description" => "The border around chart elements. Possible values are as those of the backgroundColor configuration option."),
		"colors" => array("datatype" => "array", "description" => "The colors to use for the chart elements. An array of strings. Each element is a string that is a color supported by HTML, for example 'red' or '#00cc00'."),
		"focusBorderColor" => array("datatype" => "string,object", "description" => "The border around chart elements that are in focus (pointed by the mouse). Possible values are as those of the backgroundColor configuration option."),
		"legendBackgroundColor" => array("datatype" => "string,object", "description" => "The background color for the legend area of the chart. Possible values are as those of the backgroundColor configuration option."),
		"legendTextColor" => array("datatype" => "string,object", "description" => "The color for the text entries of the legend. Possible values are as those of the backgroundColor configuration option."),
	);
}