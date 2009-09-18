<?php

/**
 *
 * Google_Exception_Config
 *
 * @package Google
 * @subpackage Google_Exception
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-07-10

 *
 */
/**
 *
 * Google_Exception_Config
 *
 * @package Google
 * @subpackage Google_Exception
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-07-10

 *
 */
class Google_Exception_Config extends Google_Exception {

	/**
	 * show
	 * @desc throws a formatted Exception for Config Objects
	 * @param mixed $object Chart Config Object
	 */
	public function show($object=null) {
		parent::show(get_class($this), $object->getDefault());
	}
}