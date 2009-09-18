<?php

/**
 * Google_Config_OrgChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/orgchart.html
 */
/**
 * Google_Config_OrgChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/orgchart.html
 */
class Google_Config_OrgChart extends Google_Config_Base {

	protected $configuration = array(
		"size" => array(
			"values" => array("small", "medium", "large"), 
			"datatype" => "string",
			"description" => ""
			),
		"allowHtml" => array("datatype" => "bool", "description" => "If set to true, names that includes HTML tags will be rendered as HTML.")
	);
}