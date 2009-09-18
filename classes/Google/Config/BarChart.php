<?php

/**
 * Google_Config_BarChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/barchart.html
 */
/**
 * Google_Config_BarChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/barchart.html
 */
class Google_Config_BarChart extends Google_Config_Base {

	protected $configuration = array(
		"title" => array("datatype" => "string", "description" => "Text to display above the chart."), 
		"titleX" => array("datatype" => "string", "description" => "Text to display below the horizontal axis."),
		"titleY" => array("datatype" => "string", "description" => "Text to display by the vertical axis."),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
		"legend" => array(
			"values" => array("right", "left", "top", "bottom", "none"), 
			"datatype" => "string",
			"description" => "Position and type of legend. Can be one of the following:<ul><li><b>right</b> - To the right of the chart.</li><li><b>left</b> - To the left of the chart.</li><li><b>top</b> - Above the chart.</li><li><b>bottom</b> - Below the chart.</li><li><b>none</b> - No legend is displayed.</li></ul>"
		),  
		"reverseAxis" => array("datatype" => "bool", "description" => "If set to true, will draw categories from right to left. The default is to draw left-to-right."),
		"isStacked" => array("datatype" => "bool", "description" => "If set to true, line values are stacked (accumulated)."),
		"is3D" => array("datatype" => "bool", "description" => "If set to true, displays a three-dimensional change."),
		"backgroundColor" => array("datatype" => "string,object", "description" => "The background color for the main area of the chart. May be one of the following options:<ul><li>A string with color supported by HTML, for example 'red' or '#00cc00'</li><li>An object with properties stroke fill and strokeSize.</li></ul>stroke and fill should be a string with a color. strokeSize is a number.<br/>For example: {backgroundColor: {stroke:'black', fill:'#eee', strokeSize: 1}. To use just fill, without a stroke, use stroke:null, strokeSize: 0."),
		"borderColor" => array("datatype" => "string,object", "description" => "The border around chart elements. Possible values are as those of the backgroundColor configuration option."),
		"titleColor" => array("datatype" => "string,object", "description" => "The color for the chart's title. Possible values are as those of the backgroundColor configuration option."),
		"legendBackgroundColor" => array("datatype" => "string,object", "description" => "The background color for the legend area of the chart. Possible values are as those of the backgroundColor configuration option."),
		"legendTextColor" => array("datatype" => "string,object", "description" => "The color for the text entries of the legend. Possible values are as those of the backgroundColor configuration option."),
		"colors" => array("datatype" => "array", "description" => "The colors to use for the chart elements. An array of strings. Each element is a string that is a color supported by HTML, for example 'red' or '#00cc00'."),
		"axisColor" => array("datatype" => "string,object", "description" => "The color of the axis. Possible values are as those of the backgroundColor configuration option."),
		"axisBackgroundColor" => array("datatype" => "string,object", "description" => "The border around axis background. Possible values are as those of the backgroundColor configuration option."),
		"focusBorderColor" => array("datatype" => "string,object", "description" => "The border around chart elements that are in focus (pointed by the mouse). Possible values are as those of the backgroundColor configuration option."),
	);

	/**
	 * defaultConfig
	 * @desc optional static method which carries a default configuration for
	 * a chart type
	 * @return stdClass
	 */
	protected static function defaultConfig() {
		
        $objChart = new stdClass;
        $objChart->type = "BarChart";
        $objChart->provider = "google";
        $objChart->scope = "visualization";
        $objChart->version = 1;
        $objChart->language = "de_DE";
        $objChart->port = "chart";

        $objChart->props = new stdClass();
        $objChart->props->borderColor = '#000000';
        $objChart->props->titleColor = '#00ffff';
        $objChart->props->is3D = true;
        $objChart->props->height = 600;
        $objChart->props->width = 800;

        $objChart->viewport = new stdClass();
        $objChart->viewport->height = 680;
        $objChart->viewport->width = 800;

        return $objChart;
	}
	
}