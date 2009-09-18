<?php

/**
 * Google_Config_ImageSparkLine
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Config_ImageSparkLine
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Config_ImageSparkLine extends Google_Config_Base {

	protected $configuration = array(
		"color" => array("datatype" => "string"),
		"colors" => array("datatype" => "object"),
		"fill" => array("datatype" => "bool"),
		"height" => array("datatype" => "integer"),
		"labelPosition" => array("datatype" => "string"),
		"max" => array("datatype" => "array"),
		"min" => array("datatype" => "array"),
		"showAxisLines" => array("datatype" => "bool"),
		"showValueLines" => array("datatype" => "bool"),
		"title" => array("datatype" => "array"),
		"width" => array("datatype" => "integer"),
		"layout" => array("datatype" => "string"),
	);

	protected $methods = array(
		"draw" => array("data" => "var", "options" => "var,object"),
		"getSelection" => array(),
		"setSelection" => array("selection" => "var"),
	);

	protected $events = array(
		"select" => true
	);

}