<?php

/**
 * Google_Config_AnnotatedTimeLine
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/annotatedtimeline.html
 * @desc An interactive time series line chart with optional annotations. The
 * chart is rendered within the browser using Flash.
 */
/**
 * Google_Config_AnnotatedTimeLine
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/annotatedtimeline.html
 * @desc An interactive time series line chart with optional annotations. The
 * chart is rendered within the browser using Flash.
 */
class Google_Config_AnnotatedTimeLine extends Google_Config_Base {

	protected $configuration = array(
		"allowHtml" => array("datatype" => "bool"),
		"annotationsWidth" => array("datatype" => "number"),
		"allowHtml" => array("datatype" => "bool"),
		"colors" => array("datatype" => "array"),
		"displayAnnotations" => array("datatype" => "bool"),
		"displayAnnotationsFilters" => array("datatype" => "bool"),
		"displayExactValues" => array("datatype" => "bool"),
		"min" => array("datatype" => "number"),
		"legend" => array(
			"values" => array("fixed", "maximize"), 
			"datatype" => "string"
		), 
		"wmode" => array(
			"values" => array("opaque", "window", "transparent"), 
			"datatype" => "string"
		), 
		"zoomEndTime" => array("datatype" => "date"),
		"zoomStartTime" => array("datatype" => "date"),
	);
}
