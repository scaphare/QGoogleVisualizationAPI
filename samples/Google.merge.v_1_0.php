<?php
/**
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see <http://www.gnu.org/licenses/>.
 *
 * @author Thomas Schäfer <scaphare@googlemail.com>
 * @copyright 2009 Thomas Schäfer <scaphare@googlemail.com>
 * @since 2009-08-30
 * @license GNU General Public License
 * @version 1.0
 *
 */

/**-------TS61521-5ACB-6F1B-7967-AB8C-BA32-A191-31073--------*/
interface Google_Data_Interface {
	public function getData();
}

/**-------TS61521-FB3B-FE71-942B-81A9-9376-505E-31073--------*/

/**
 * Google_Exception
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
 */
/**
 * Google_Exception
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Exception extends Exception {

	/**
	 * @var array $parameters
	 */
	private $parameters = array();
	/**
	 * @var mixed $data
	 */
	private $data;

	/**
	 * setParameter
	 * @param string $name
	 * @param mixed $value
	 */
	public function setParameter($name, $value) {
		$this->parameters[$name] = $value;
	}

	/**
	 * getParameter
	 * @param $string $name
	 * @return mixed
	 */
	public function getParameter($name) {
		if($this->hasParameter($name)) {
			return $this->parameters[$name];
		}
		return false;
	}

	/**
	 * hasParameter
	 * @param string $name
	 * @return bool
	 */
	public function hasParameter($name) {
		if(array_key_exists($name, $this->parameters)) {
			return true;
		}
		return false;
	}

	/**
	 * templateFile
	 * @desc returns path to template
	 * @param string $name
	 * @var static
	 * @return string
	 */
	private static function templateFile($name) {
		return 'Exception'.DIRECTORY_SEPARATOR.$name.".phtml";
	}

	/**
	 * template
	 * @desc renders template
	 * @param string $name
	 * @return string
	 */
	private function template($name=null) {

		ob_start();
		include_once(self::templateFile(($name?$name:__CLASS__)));
		$template = ob_get_contents();
		ob_end_clean();
		return $template;

	}

	/**
	 * show
	 * @desc prints out exception
	 * @param string $name
	 * @param mixed $data
	 */
	public function show($name=null, $data=null) {
		$this->data = $data;
		echo $this->template($name);
		exit;
	}
}

/**-------TS61521-26CB-341D-EA2A-E961-07E8-C73F-31073--------*/

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
/**-------TS61521-EE7F-FD69-DB4E-5AA1-6D8C-1D6E-31073--------*/

/**
 *
 * Google_Exception_Data
 *
 * @package Google
 * @subpackage Google_Exception
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-07-10

 * @desc throw data exceptions
 */
/**
 *
 * Google_Exception_Data
 *
 * @package Google
 * @subpackage Google_Exception
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-07-10

 * @desc throw data exceptions
 */
class Google_Exception_Data extends Google_Exception {}
/**-------TS61521-6076-7BCD-9E94-DDD9-6EBD-05FD-31073--------*/
/**
 *
 * Google_Exception_Format
 *
 * @package Google
 * @subpackage Google_Exception
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-07-10

 * @desc throw formatter exceptions
 */
/**
 *
 * Google_Exception_Format
 *
 * @package Google
 * @subpackage Google_Exception
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-07-10

 * @desc throw formatter exceptions
 */
class Google_Exception_Format extends Google_Exception {}

/**-------TS61521-630A-F73C-E813-4327-2D07-C39F-31073--------*/

/**
 * Google_Base
 * @desc class holding api wide used methods
 * @package Google
 * @author Thomas Schäfer
 * @link scaphare@gmail.com
 */
/**
 * Google_Base
 * @desc class holding api wide used methods
 * @package Google
 * @author Thomas Schäfer
 * @link scaphare@gmail.com
 */
class Google_Base
{
	/**
	 * @var const VERSION
	 */
	const VERSION = '1.0.1';

	/**
	 * @staticvar bool $comment used to switch comments
	 */
	private static $comment = true;
	/**
	 * @var const cbrace
	 */
	const cbrace = '}';
	/**
	 * @var const cbracelb
	 */
	const cbracelb = "}\n";
	/**
	 * @var const cb
	 */
	const cb = "};\n";
	/**
	 * @var const obrace
	 */
	const obrace = '{';
	/**
	 * @var const cbracket
	 */
	const cbracket = ']';
	/**
	 * @var const cbracketlr
	 */
	const cbracketlr = "]\n";
	/**
	 * @var const closefunc
	 */
	const closefunc = "\n});\n";
	/**
	 * @var const obracket
	 */
	const obracket = '[';
	/**
	 * @var const semicolon
	 */
	const semicolon = ';';
	/**
	 * @var const colon
	 */
	const colon = '.';
	/**
	 * @var const lb
	 */
	const lb = "\n";
	/**
	 * @staticvar static $instance
	 */
	private static $instance;
	/**
	 * @var array $options
	 */
	protected $options = array ();
	/**
	 * @var array $objectStack
	 */
	protected $objectStack = array ();
	/**
	 * @var array $json_objectStack
	 */
	private $json_objectStack = array ();

	/**
	 * constructor
	 * @return void
	 */
	public function __construct()
	{
		$this->options['maxObjectDepth'] = 10;
		$this->options['maxArrayDepth'] = 20;
		$this->options['useNativeJsonEncode'] = false;
		$this->options['includeLineNumbers'] = true;
	}

	/**
	 * getElementById
	 * @desc wrapper for js document.getElementById command
	 * @var static
	 * @access public
	 * @param string $id
	 * @return string
	 */
	public static function getElementById($id){
		return "document.getElementById('$id')";
	}

	/**
	 * getVarById
	 * @desc returns a js line of code, which represents an dom object to var
	 * action.
	 * @param $id
	 * @access public
	 * @var static
	 * @return string
	 */
	public static function getVarById($id){
		return "var $id=".self::getElementById($id).";";
	}

	/**
	 * get
	 * @desc returns an instance of this class
	 * @access public
	 * @var static
	 * @return Google_Base
	 */
	public function get()
	{
		if (empty (self :: $instance))
		{
			return new Google_Base;
		}
		return self :: $instance;
	}

	/**
	 * encodeData
	 * @desc converts an array of objects into JSON object
	 * @param array $data
	 * @static
	 * @return string JSON
	 */
	public static function encodeData(array $data){
		$obj = new stdClass;
		foreach($data as $key => $values){
			$obj->{$key} = $values;
		}
		return Google_Base::get()->encode($obj);
	}

	/**
	 * commentable
	 * @desc flag set for switching comments on and off
	 * @param bool $bool
	 * @static
	 * @return void
	 */
	public static function commentable($bool){
		self::$comment = (bool) $bool;
	}

	/**
	 * isCommentable
	 * @desc check static var
	 * @static
	 * @return bool
	 */
	public static function isCommentable(){
		return self::$comment;
	}

	/**
	 * begin
	 * @desc comment starting line
	 * @param string $name
	 * @static
	 * @return string
	 */
	public static function begin($name){
		return self::comment($name, "begin");
	}

	/**
	 * end
	 * @desc comment ending line
	 * @param string $name
	 * @static
	 * @return string
	 */
	public static function end($name){
		return self::comment($name, "end");
	}

	/**
	 * comment
	 * @desc comment line
	 * @static
	 * @param string $name
	 * @param string $prefix
	 * @return string
	 */
	public static function comment($name, $prefix="begin"){
		if(self::$comment){
			return "<!-- $prefix $name -->".Mocha::lb;
		}
		return "";
	}

	/**
	 * encode
	 * @desc encodes deep object structures into JSON.
	 * This is the interfaces to call various encoding operations.
	 * @param object $Object
	 * @param bool $skipObjectEncode
	 * @return string
	 */
	public function encode($Object, $skipObjectEncode = false) {
		if (!$skipObjectEncode) {
			$Object = $this->encodeObject($Object);
		}
		if (function_exists('json_encode') && $this->options['useNativeJsonEncode'] != false) {
			return json_encode($Object);
		} else {
			return $this->json_encode($Object);
		}
	}

	/**
	 * encodeObject
	 * @desc
	 * @access protected
	 * @param object $Object
	 * @param integer $ObjectDepth maximum object tree depth to recurse
	 * @param integer $ArrayDepth maximum array tree depth to recurse
	 * @return string>
	 */
	protected function encodeObject($Object, $ObjectDepth = 1, $ArrayDepth = 1) {
		$return = array ();
		if (is_resource($Object)) {
			return '** ' . (string) $Object . ' **';
		} elseif (is_object($Object)) {
			if ($ObjectDepth > $this->options['maxObjectDepth']) {
				return '** Max Object Depth (' . $this->options['maxObjectDepth'] . ') **';
			}

			foreach ($this->objectStack as $refVal) {
				if ($refVal === $Object) {
					return '** Recursion (' . get_class($Object) . ') **';
				}
			}
			array_push($this->objectStack, $Object);
			$return['__className'] = $class = get_class($Object);
			$reflectionClass = new ReflectionClass($class);
			$properties = array ();
			foreach ($reflectionClass->getProperties() as $property) {
				$properties[$property->getName()] = $property;
			}

			$members = (array) $Object;
			foreach ($properties as $raw_name => $property) {
				$name = $raw_name;
				if ($property->isStatic()) {
					$name = '' . $name;
				}

				if ($property->isPublic()) {
					$name = '' . $name;
				} elseif ($property->isPrivate()) {
					$name = '' . $name;
					$raw_name = "\0" . $class . "\0" . $raw_name;
				} elseif ($property->isProtected()) {
						//$name = 'protected:' . $name;
						//$name = '' . $name;
						//$raw_name = "\0" . '*' . "\0" . $raw_name;
				}

				if (!(isset ($this->objectFilters[$class]) && is_array($this->objectFilters[$class]) && in_array($raw_name, $this->objectFilters[$class]))) {
					if (array_key_exists($raw_name, $members) && !$property->isStatic()) {
						$return[$name] = $this->encodeObject($members[$raw_name], $ObjectDepth +1, 1);
					} else {
						if (method_exists($property, 'setAccessible')) {
							$property->setAccessible(true);
							$return[$name] = $this->encodeObject($property->getValue($Object), $ObjectDepth +1, 1);
						} elseif ($property->isPublic()) {
							$return[$name] = $this->encodeObject($property->getValue($Object), $ObjectDepth +1, 1);
						} else {
							//$return[$name] = '** Need PHP 5.3 to get value **';
							//$return[$name] = '';
						}
					}
				} else {
						//$return[$name] = '** Excluded by Filter **';
						//$return[$name] = '';
				}
			}
			// Include all members that are not defined in the class
			// but exist in the object
			foreach ($members as $raw_name => $value) {
				$name = $raw_name;
				if ($name{0}== "\0") {
					$parts = explode("\0", $name);
					$name = $parts[2];
				}
				if (!isset ($properties[$name])) {
					$name = '' . $name;
					if (!(isset ($this->objectFilters[$class]) && is_array($this->objectFilters[$class]) && in_array($raw_name, $this->objectFilters[$class]))) {
						$return[$name] = $this->encodeObject($value, $ObjectDepth +1, 1);
					} else {
						$return[$name] = '';
					}
				}
			}
			array_pop($this->objectStack);
		} elseif (is_array($Object)) {
			if ($ArrayDepth > $this->options['maxArrayDepth']) {
				return '** Max Array Depth (' . $this->options['maxArrayDepth'] . ') **';
			}
			foreach ($Object as $key => $val) {
				// Encoding the $GLOBALS PHP array causes an infinite loop
				// if the recursion is not reset here as it contains
				// a reference to itself. This is the only way I have come up
				// with to stop infinite recursion in this case.
				if ($key == 'GLOBALS' && is_array($val) && array_key_exists('GLOBALS', $val)) {
					$val['GLOBALS'] = '** Recursion (GLOBALS) **';
				}
				$return[$key] = $this->encodeObject($val, 1, $ArrayDepth +1);
			}
		} else {
			if (self :: is_utf8($Object)) {
				return $Object;
			} else {
				return utf8_encode($Object);
			}
		}
		unset($return["__className"]);
		return $return;
	}


	/**
	 * is_utf8
	 * @desc Returns true if $string is valid UTF-8 and false otherwise.
	 * @param mixed $str String to be tested
	 * @access protected
	 * @return boolean
	 */
	protected static function is_utf8($str) {
		$c = 0;
		$b = 0;
		$bits = 0;
		$len = strlen($str);
		for ($i = 0; $i < $len; $i++) {
			$c = ord($str[$i]);
			if ($c > 128) {
				if (($c >= 254)) return false;
				elseif ($c >= 252) $bits = 6;
				elseif ($c >= 248) $bits = 5;
				elseif ($c >= 240) $bits = 4;
				elseif ($c >= 224) $bits = 3;
				elseif ($c >= 192) $bits = 2;
				else return false;
				if (($i + $bits) > $len) return false;
				while ($bits > 1) {
					$i++;
					$b = ord($str[$i]);
					if ($b < 128 || $b > 191) return false;
					$bits--;
				}
			}
		}
		return true;
	}

	/*
	/**
	 * Converts to and from JSON format.
	 *
	 * JSON (JavaScript Object Notation) is a lightweight data-interchange
	 * format. It is easy for humans to read and write. It is easy for machines
	 * to parse and generate. It is based on a subset of the JavaScript
	 * Programming Language, Standard ECMA-262 3rd Edition - December 1999.
	 * This feature can also be found in  Python. JSON is a text format that is
	 * completely language independent but uses conventions that are familiar
	 * to programmers of the C-family of languages, including C, C++, C#, Java,
	 * JavaScript, Perl, TCL, and many others. These properties make JSON an
	 * ideal data-interchange language.
	 *
	 * This package provides a simple encoder and decoder for JSON notation. It
	 * is intended for use with client-side Javascript applications that make
	 * use of HTTPRequest to perform server communication functions - data can
	 * be encoded into JSON notation for use in a client-side javascript, or
	 * decoded from incoming Javascript requests. JSON format is native to
	 * Javascript, and can be directly eval()'ed with no further parsing
	 * overhead
	 *
	 * All strings should be in ASCII or UTF-8 format!
	 *
	 * LICENSE: Redistribution and use in source and binary forms, with or
	 * without modification, are permitted provided that the following
	 * conditions are met: Redistributions of source code must retain the
	 * above copyright notice, this list of conditions and the following
	 * disclaimer. Redistributions in binary form must reproduce the above
	 * copyright notice, this list of conditions and the following disclaimer
	 * in the documentation and/or other materials provided with the
	 * distribution.
	 *
	 * THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED
	 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
	 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN
	 * NO EVENT SHALL CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
	 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
	 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS
	 * OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
	 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR
	 * TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
	 * USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
	 * DAMAGE.
	 *
	 * @category
	 * @package     Services_JSON
	 * @author      Michal Migurski <mike-json@teczno.com>
	 * @author      Matt Knapp <mdknapp[at]gmail[dot]com>
	 * @author      Brett Stimmerman <brettstimmerman[at]gmail[dot]com>
	 * @author      Christoph Dorn <christoph@christophdorn.com>
	 * @copyright   2005 Michal Migurski
	 * @version     CVS: $Id: JSON.php,v 1.31 2006/06/28 05:54:17 migurski Exp $
	 * @license     http://www.opensource.org/licenses/bsd-license.php
	 * @link        http://pear.php.net/pepr/pepr-proposal-show.php?id=198
	 */
	/**
	 * Keep a list of objects as we descend into the array so we can detect recursion.
	 */

	/**
	 * convert a string from one UTF-8 char to one UTF-16 char
	 *
	 * Normally should be handled by mb_convert_encoding, but
	 * provides a slower PHP-only method for installations
	 * that lack the multibye string extension.
	 *
	 * @param    string  $utf8   UTF-8 character
	 * @return   string  UTF-16 character
	 * @access   private
	 */
	private function json_utf82utf16($utf8) {
		// oh please oh please oh please oh please oh please
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($utf8, 'UTF-16', 'UTF-8');
		}

		switch (strlen($utf8)) {
			case 1 :
				// this case should never be reached, because we are in ASCII range
				// see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
				return $utf8;
			case 2 :
				// return a UTF-16 character from a 2-byte UTF-8 char
				// see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
				return chr(0x07 & (ord($utf8 {
					0 }) >> 2)) . chr((0xC0 & (ord($utf8 {
					0 }) << 6)) | (0x3F & ord($utf8 {
					1 })));
			case 3 :
				// return a UTF-16 character from a 3-byte UTF-8 char
				// see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
				return chr((0xF0 & (ord($utf8 {
					0 }) << 4)) | (0x0F & (ord($utf8 {
					1 }) >> 2))) . chr((0xC0 & (ord($utf8 {
					1 }) << 6)) | (0x7F & ord($utf8 {
					2 })));
		}
		// ignoring UTF-32 for now, sorry
		return '';
	}

	/**
	 * encodes an arbitrary variable into JSON format
	 *
	 * @param    mixed   $var    any number, boolean, string, array, or object to be encoded.
	 *                           see argument 1 to Services_JSON() above for array-parsing behavior.
	 *                           if var is a strng, note that encode() always expects it
	 *                           to be in ASCII or UTF-8 format!
	 *
	 * @return   mixed   JSON string representation of input var or an error if a problem occurs
	 * @access   public
	 */
	private function json_encode($var) {
		if (is_object($var)) {
			if (in_array($var, $this->json_objectStack)) {
				return '"** Recursion **"';
			}
		}

		switch (gettype($var)) {
			case 'boolean' :
				return $var ? 'true' : 'false';
			case 'NULL' :
				return 'null';
			case 'integer' :
				return (int) $var;
			case 'double' :
			case 'float' :
				return (float) $var;
			case 'string' :
				if(is_string($var) and stristr($var,"@VAR")){
					return substr($var,strlen("@VAR["),-1);
				} else if(is_string($var) and stristr($var,"@FUNC")){
					return substr($var,strlen("@FUNC["),-1);
				} else if(is_string($var) and stristr($var,"null")){
					return "null";
				}

				// STRINGS ARE EXPECTED TO BE IN ASCII OR UTF-8 FORMAT
				$ascii = '';
				$strlen_var = strlen($var);
				/*
				 * Iterate over every character in the string,
				 * escaping with a slash or encoding to UTF-8 where necessary
				 */
				for ($c = 0; $c < $strlen_var; ++ $c) {
					$ord_var_c = ord($var{$c});
					switch (true) {
						case $ord_var_c == 0x08 :
							$ascii .= '\b';
							break;
						case $ord_var_c == 0x09 :
							$ascii .= '\t';
							break;
						case $ord_var_c == 0x0A :
							$ascii .= '\n';
							break;
						case $ord_var_c == 0x0C :
							$ascii .= '\f';
							break;
						case $ord_var_c == 0x0D :
							$ascii .= '\r';
							break;
						case $ord_var_c == 0x22 :
						case $ord_var_c == 0x2F :
						case $ord_var_c == 0x5C :
							// double quote, slash, slosh
							$ascii .= '\\' . $var{$c};
							break;
						case (($ord_var_c >= 0x20) && ($ord_var_c <= 0x7F)):
							// characters U-00000000 - U-0000007F (same as ASCII)
							$ascii .= $var{$c};
							break;
						case (($ord_var_c & 0xE0) == 0xC0) :
							// characters U-00000080 - U-000007FF, mask 110XXXXX
							// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
							$char = pack('C*', $ord_var_c, ord($var{$c+1}));
							$c += 1;
							$utf16 = $this->json_utf82utf16($char);
							$ascii .= sprintf('\u%04s', bin2hex($utf16));
							break;
						case (($ord_var_c & 0xF0) == 0xE0) :
							// characters U-00000800 - U-0000FFFF, mask 1110XXXX
							// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
							$char = pack('C*', $ord_var_c, ord($var{$c+1}), ord($var{$c+2}));
							$c += 2;
							$utf16 = $this->json_utf82utf16($char);
							$ascii .= sprintf('\u%04s', bin2hex($utf16));
							break;
						case (($ord_var_c & 0xF8) == 0xF0) :
							// characters U-00010000 - U-001FFFFF, mask 11110XXX
							// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
							$char = pack('C*', $ord_var_c, ord($var{$c+1}), ord($var{$c+2}), ord($var{$c+3}));
							$c += 3;
							$utf16 = $this->json_utf82utf16($char);
							$ascii .= sprintf('\u%04s', bin2hex($utf16));
							break;
						case (($ord_var_c & 0xFC) == 0xF8) :
							// characters U-00200000 - U-03FFFFFF, mask 111110XX
							// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
							$char = pack('C*', $ord_var_c, ord($var{$c+1}), ord($var{$c+2}), ord($var{$c+3}), ord($var{$c+4}));
							$c += 4;
							$utf16 = $this->json_utf82utf16($char);
							$ascii .= sprintf('\u%04s', bin2hex($utf16));
							break;
						case (($ord_var_c & 0xFE) == 0xFC) :
							// characters U-04000000 - U-7FFFFFFF, mask 1111110X
							// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
							$char = pack('C*', $ord_var_c, ord($var{$c+1}), ord($var{$c+2}), ord($var{$c+3}), ord($var{$c+4}), ord($var{$c+5}));
							$c += 5;
							$utf16 = $this->json_utf82utf16($char);
							$ascii .= sprintf('\u%04s', bin2hex($utf16));
							break;
					}
				}
				return '"' . $ascii . '"';
			case 'array' :
				/*
				 * As per JSON spec if any array key is not an integer
				 * we must treat the the whole array as an object. We
				 * also try to catch a sparsely populated associative
				 * array with numeric keys here because some JS engines
				 * will create an array with empty indexes up to
				 * max_index which can cause memory issues and because
				 * the keys, which may be relevant, will be remapped
				 * otherwise.
				 *
				 * As per the ECMA and JSON specification an object may
				 * have any string as a property. Unfortunately due to
				 * a hole in the ECMA specification if the key is a
				 * ECMA reserved word or starts with a digit the
				 * parameter is only accessible using ECMAScript's
				 * bracket notation.
				 */
				// treat as a JSON object
				if (is_array($var) && count($var) && (array_keys($var) !== range(0, sizeof($var) - 1)))
				{
					$this->json_objectStack[] = $var;
					$properties = array_map(array($this,'json_name_value'), array_keys($var), array_values($var));
					array_pop($this->json_objectStack);
					foreach ($properties as $property) {
						if ($property instanceof Exception) {
							return $property;
						}
					}
					return '{' . join(',', $properties) . '}';
				}
				$this->json_objectStack[] = $var;
				// treat it like a regular array
				$elements = array_map(array (
					$this,
					'json_encode'
				), $var);
				array_pop($this->json_objectStack);
				foreach ($elements as $element) {
					if ($element instanceof Exception) {
						return $element;
					}
				}
				return '[' . join(',', $elements) . ']';
			case 'object' :
				$vars = self :: encodeObject($var);
				$this->json_objectStack[] = $var;
				$properties = array_map(array (
					$this,
					'json_name_value'
				), array_keys($vars), array_values($vars));
				array_pop($this->json_objectStack);
				foreach ($properties as $property) {
					if ($property instanceof Exception) {
						return $property;
					}
				}
				return '{' . join(',', $properties) . '}';
			default :
				return null;
		}
	}

	/**
	 * array-walking function for use in generating JSON-formatted name-value pairs
	 *
	 * @param    string  $name   name of key to use
	 * @param    mixed   $value  reference to an array element to be encoded
	 *
	 * @return   string  JSON-formatted name-value pair, like '"name":value'
	 * @access   private
	 */
	private function json_name_value($name, $value) {
		// Encoding the $GLOBALS PHP array causes an infinite loop
		// if the recursion is not reset here as it contains
		// a reference to itself. This is the only way I have come up
		// with to stop infinite recursion in this case.
		if ($name == 'GLOBALS' && is_array($value) && array_key_exists('GLOBALS', $value)) {
			$value['GLOBALS'] = '** Recursion **';
		}
		$encoded_value = $this->json_encode($value);
		if ($encoded_value instanceof Exception) {
			return $encoded_value;
		}
		return $this->json_encode(strval($name)) . ':' . $encoded_value;
	}

	/**
	 * toJSON
	 * @param array $data
	 * @param boolean $escape
	 * @return string
	 */
	public static function toJSON($data = false, $escape = true) {

		$register = array (
			"charts", "data", "value", "scope", "name", "ref", "props", "column",
			"width", "height", "zoomStartTime","zoomEndTime","allowHtml","colors",
			"title","displayAnnotations", "region", "showOneTab", "wmode", "scaleType",
			"displayExactValues", "displayAnnotationsFilter", "annotationsWidth",
			"min","max","axisColor","axisBackgroundColor","backgroundColor","borderColor",
			"focusBorderColor","is3D","isStacked","legendBackgroundColor","legend",
			"legendTextColor", "reverseAxis","titleX","titleY","titleColor","lineSize",
			"pointSize","showRowNumber","language","provider","type", "version"
		);

		if (is_null ( $data )) {
			return 'null';
		}
		if ($data === false) {
			return 'false';
		}
		if ($data === true) {
			return 'true';
		}
		if (is_scalar ( $data )) {
			if (is_float ( $data )) {
				$data = str_replace ( ",", ".", strval ( $data ) );
			}

			if (is_string ( $data )) {
				static $jsonReplaces = array (array ("\\", "/", "\n", "\t", "\r", "\b", "\f", '"' ), array ('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"' ) );
				if (stristr($data,"new")) {
					return str_replace ( $jsonReplaces [0], $jsonReplaces [1], $data ) ;
				} else if ($escape) {
					if (is_numeric ( $data ) or is_bool($data)) {
						return str_replace ( $jsonReplaces [0], $jsonReplaces [1], $data );
					} else {
						return '"' . str_replace ( $jsonReplaces [0], $jsonReplaces [1], $data ) . '"';
					}
				} else {
					return str_replace ( $jsonReplaces [0], $jsonReplaces [1], $data );
				}
			} else {
				return $data;
			}
		}
		$isList = true;
		for($i = 0, reset ( $data ); $i < count ( $data ); $i ++, next ( $data )) {
			if (key ( $data ) !== $i) {
				$isList = false;
				break;
			}
		}
		$result = array ();
		if ($isList) {
			foreach ( $data as $value ) {
				$result[] = self::toJSON($value);
			}
			return '[' . join ( ',', $result ) . ']';
		} else {
			foreach ( $data as $key => $value ) {
				$escKey = (stristr ( $key, "function(" ) or in_array ( $key, $register )) ? false : true;
				$result [] = self::toJSON ( $key, $escKey ) . ':' . self::toJSON ( $value);
			}
			return '{' . join ( ',', $result ) . '}';
		}
	}

	/**
	 * getMethodType
	 * @desc extract method informations
	 * @param string $string
	 */
	public static function getMethodType($string) {
		$tmp = explode("_", Google_Base::underscore($string));
		$methodType = array();
		$methodType["length"] = strlen($tmp[0]);
		$methodType["type"] = $tmp[0];
		$methodType["name"] = substr($string, $methodType["length"]);
		return $methodType;
	}

	/**
	 * ucFirstDown
	 * @desc lowercases first char of a string
	 * @param string $string
	 * @access public
	 * @return string
	 */
	public static function ucFirstDown($string) {
		return strtolower(substr($string,0,1)).substr($string,1);
	}

	/**
	 * ucFirstUp
	 * @desc uppercases first char of a string
	 * @param string $string
	 * @access public
	 * @return string
	 */
	public static function ucFirstUp($string) {
		return strtoupper(substr($string,0,1)).substr($string,1);
	}

	/**
	 * underscore
	 * @desc turns a camelcased string to a lowercase underscored string
	 * @param string $word
	 * @access public
	 * @return string
	 */
	public static function underscore($word = null) {
		$tmp = Google_Base::replace($word, array (
		'/([A-Z]+)([A-Z][a-z])/' => '\\1_\\2',
		'/([a-z\d])([A-Z])/' => '\\1_\\2'
		));
		return strtolower($tmp);
	}

	/**
	 * replace
	 * @desc helper method to replace chars within a string
	 * @param string $search
	 * @param array $replacePairs
	 * @access public
	 * @return string
	 */
	public static function replace($search, $replacePairs) {
		return preg_replace(array_keys($replacePairs), array_values($replacePairs), $search);
	}

}
/**-------TS61521-901B-38D0-E33B-603A-87EB-08BE-31073--------*/
/**
 * Google_Chart
 * Class to setup chart objects
 */

/**
 * Google_Chart
 * @desc Class to setup chart objects
 * @package Google
 * @author Thomas Schäfer
 * @link scaphare@gmail.com
 * @desc
 */
class Google_Chart {

	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = '';
	/**
	 * @var array $data
	 */
	private $data;
	/**
	 * @var string $version
	 */
	private $version;
	/**
	 * @var array $properties
	 */
	private $properties=null;
	/**
	 * @var array $options
	 */
	private $options=null;
	/**
	 * @var string $dataTable
	 */
	private $dataTable='';

	/**
	 * constructor
	 * @param string $type
	 * @param array $data
	 * @param string $version
	 * @return void
	 */
	public function __construct($type, $data, $version=null) {
		$this->type = $type;
		$this->data = $data;
		$this->version = $version;
	}


	/**
	 * getDataTable
	 * @desc getter for data table name
	 * @return string
	 */
	public function getDataTable() {
		return $this->dataTable;
	}

	/**
	 * setDataTable
	 * @param srting $name
	 * @return void
	 */
	public function setDataTable($name) {
		$this->dataTable = $name;
	}

	/**
	 * draw
	 * @desc php method to simulate Google's default draw method
	 * @param array|Google_Data_View $data
	 * @param array $options
	 * @return void
	 */
	public function draw($data, $options=null) {
		$this->options = $options;

		$arr = array();
		if($data instanceof Google_Data_View) {
			$arr[] = $data->getViewTable();
		} else {
			$this->dataTable = $data;
			$arr[] = $data;
		}

		if($options) {
			$_options =  $options->getProperties();
			if($_options instanceof Google_Config_Default or $_options instanceof stdClass) {
				$arr[] = Google_Base::toJSON($_options);
			} else {
				$arr[] = $options->getProperties();
			}
		} else {
			$arr[] = 'null';
		}
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * render
	 * @desc prints out the rendered chart object
	 * @return string
	 */
	public function render() {
		$string = $this->getDataTable().'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		if($this->options instanceof Google_Config_Default) {
			$string .= $this->options->getConfigObject()->type;
		} else {
			$string .= $this->type;
		}
		$string .= '(';
		if($this->data) $string .= $this->data;
		if($this->version) $string .= ','.$this->version;
		$string .= ');';
		$string .= "\n";

		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= ' '.$this->getDataTable().'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		return $string;
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		$string = 'var chart_'.$this->data.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		if($this->options instanceof Google_Config_Default) {
			$string .= $this->options->getConfigObject()->type;
		} else {
			$string .= $this->type;
		}
		$string .= '(';
		if($this->data) $string .= $this->data;
		if($this->version) $string .= ','.$this->version;
		$string .= ');';
		$string .= "\n";

		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= 'chart_'.$this->data.'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		$string .= "\n";
		return $string;
	}

}
/**-------TS61521-2782-EE32-C8D6-58D7-3A30-E42A-31073--------*/

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

/**-------TS61521-D1AC-0394-BBB4-EF7B-690C-88EE-31073--------*/

/**
 * Google_Config_AreaChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/gallery/areachart.html
 * @desc Interactive area chart.
 */
/**
 * Google_Config_AreaChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/gallery/areachart.html
 * @desc Interactive area chart.
 */
class Google_Config_AreaChart extends Google_Config_Base {

	protected $configuration = array(
		"title" => array("datatype" => "string", "description" => "Text to display above the chart."),
		"titleX" => array("datatype" => "string", "description" => "Text to display below the horizontal axis."),
		"titleY" => array("datatype" => "string", "description" => "Text to display by the vertical axis."),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
		"lineSize" => array("datatype" => "integer", "description" => "Line width in pixels. Use zero to hide all lines and show only the points."),
		"pointSize" => array("datatype" => "integer", "description" => "Size of displayed points in pixels. Use zero to hide all points."),
		"isStacked" => array("datatype" => "bool", "description" => "If set to true, line values are stacked (accumulated)."),
		"reverseAxis" => array("datatype" => "bool", "description" => "If set to true, will draw categories from right to left. The default is to draw left-to-right."),
		"legend" => array(
			"values" => array("right", "left", "top", "bottom", "none"),
			"datatype" => "string",
		    "description" => "Position and type of legend. Can be one of the following:<ul><li><b>right</b> - To the right of the chart.</li><li><b>left</b> - To the left of the chart.</li><li><b>top</b> - Above the chart.</li><li><b>bottom</b> - Below the chart.</li><li><b>none</b> - No legend is displayed.</li></ul>"
		),
		"legendBackgroundColor" => array("datatype" => "string,object", "description" => "The background color for the legend area of the chart. Possible values are as those of the backgroundColor configuration option."),
		"legendTextColor" => array("datatype" => "string,object", "description" => "The color for the text entries of the legend. Possible values are as those of the backgroundColor configuration option."),
		"titleColor" => array("datatype" => "string,object", "description" => "The color for the chart's title. Possible values are as those of the backgroundColor configuration option."),
		"axisColor" => array("datatype" => "string,object", "description" => "The color of the axis. Possible values are as those of the backgroundColor configuration option."),
		"axisBackgroundColor" => array("datatype" => "string,object", "description" => "The border around axis background. Possible values are as those of the backgroundColor configuration option."),
		"backgroundColor" => array("datatype" => "string,object", "description" => "The background color for the main area of the chart. May be one of the following options:<ul><li>A string with color supported by HTML, for example 'red' or '#00cc00'</li><li>An object with properties stroke fill and strokeSize.</li></ul>stroke and fill should be a string with a color. strokeSize is a number.<br/>For example: {backgroundColor: {stroke:'black', fill:'#eee', strokeSize: 1}. To use just fill, without a stroke, use stroke:null, strokeSize: 0."),
		"borderColor" => array("datatype" => "string,object", "description" => "The border around chart elements. Possible values are as those of the backgroundColor configuration option."),
		"colors" => array("datatype" => "array", "description" => "The colors to use for the chart elements. An array of strings. Each element is a string that is a color supported by HTML, for example 'red' or '#00cc00'."),
		"focusBorderColor" => array("datatype" => "string,object", "description" => "The border around chart elements that are in focus (pointed by the mouse). Possible values are as those of the backgroundColor configuration option."),
	);
}
/**-------TS61521-E1AB-EC89-F1DC-C534-7165-347B-31073--------*/

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
/**-------TS61521-C0F4-C96D-19A2-76E2-27E7-2A5F-31073--------*/

/**
 * Google_Config_Base
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Config_Base
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
abstract class Google_Config_Base {

	/**
	 * @var array $configuration
	 */
	protected $configuration = array();

	/**
	 * getProperty
	 * @param string $name
	 * @return mixed
	 */
	public function getProperty($name) {
		if($this->hasProperty($name)) {
			return $this->configuration[$name];
		} else {
			throw new Exception('no such property available: '. $name);
			return false;
		}
	}

	/**
	 * hasProperty
	 * @desc checks on config property
	 * @param string $name
	 * @return bool
	 */
	public function hasProperty($name) {
		if(array_key_exists($name, $this->configuration)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * getProperties
	 * @return array
	 */
	public function getProperties() {
		return $this->configuration;
	}

	/**
	 * defaultConfig
	 * @return bool
	 */
	protected static function defaultConfig() {
		return false;
	}

	/**
	 * getDefaultConfig
	 * @desc
	 * Loads the default configuration for a chart type.
	 * On default it loads data from Config::defaultConfig().
	 * If you want to configure it individually then you have to implement
	 * a static method named defaultConfig into each chart type object.
	 * A sample implementation can be found in the file ./Google/Config/BarChart.php,
	 * where the class Google_Config_BarChart resides.
	 *
	 * @param string $type chart type
	 * @return mixed
	 */
	public function getDefaultConfig($type) {
		$res = call_user_func(array('Google_Config_'.$type, 'defaultConfig'));
		if(!empty($res) and $res instanceof stdClass) {
			return $res;
		}
		return null;
	}

}
/**-------TS61521-EEBE-CBEB-8AE5-329C-0946-55DE-31073--------*/

/**
 * Google_Config_ColumnChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/columnchart.html
 */
/**
 * Google_Config_ColumnChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/columnchart.html
 */
class Google_Config_ColumnChart extends Google_Config_Base {

	protected $configuration = array(
		"title" => array("datatype" => "string", "description" => "Text to display above the chart."),
		"titleX" => array("datatype" => "string", "description" => "Text to display below the horizontal axis."),
		"titleY" => array("datatype" => "string", "description" => "Text to display by the vertical axis."),
		"legend" => array(
			"values" => array("right", "left", "top", "bottom", "none"),
			"datatype" => "string",
			"description" => "Position and type of legend. Can be one of the following:<ul><li><b>right</b> - To the right of the chart.</li><li><b>left</b> - To the left of the chart.</li><li><b>top</b> - Above the chart.</li><li><b>bottom</b> - Below the chart.</li><li><b>none</b> - No legend is displayed.</li></ul>"
		),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"is3D" => array("datatype" => "bool", "description" => "If set to true, displays a three-dimensional change."),
		"isStacked" => array("datatype" => "bool", "description" => "If set to true, line values are stacked (accumulated)."),
		"reverseAxis" => array("datatype" => "bool", "description" => "If set to true, will draw categories from right to left. The default is to draw left-to-right."),
		"axisColor" => array("datatype" => "string,object", "description" => "The color of the axis. Possible values are as those of the backgroundColor configuration option. "),
		"axisBackgroundColor" => array("datatype" => "string,object", "description" => "The border around axis background. Possible values are as those of the backgroundColor configuration option."),
		"backgroundColor" => array("datatype" => "string,object", "description" => "The background color for the main area of the chart. May be one of the following options:<ul><li>A string with color supported by HTML, for example 'red' or '#00cc00'</li><li>An object with properties stroke fill and strokeSize.</li></ul>stroke and fill should be a string with a color. strokeSize is a number.<br/>For example: {backgroundColor: {stroke:'black', fill:'#eee', strokeSize: 1}. To use just fill, without a stroke, use stroke:null, strokeSize: 0.
		"),
		"borderColor" => array("datatype" => "string,object", "description" => "The border around chart elements. Possible values are as those of the backgroundColor configuration option. "),
		"colors" => array("datatype" => "array", "description" => "The colors to use for the chart elements. An array of strings. Each element is a string that is a color supported by HTML, for example 'red' or '#00cc00'."),
		"focusBorderColor" => array("datatype" => "string,object", "description" => "The border around chart elements that are in focus (pointed by the mouse). Possible values are as those of the backgroundColor configuration option."),
		"legendBackgroundColor" => array("datatype" => "string,object", "description" => "The background color for the legend area of the chart. Possible values are as those of the backgroundColor configuration option."),
		"legendTextColor" => array("datatype" => "string,object", "description" => "The color for the text entries of the legend. Possible values are as those of the backgroundColor configuration option. "),
		"pointSize" => array("datatype" => "integer", "description" => "If set to true, will draw categories from right to left. The default is to draw left-to-right."),
		"titleColor" => array("datatype" => "string,object", "description" => "The color for the chart's title. Possible values are as those of the backgroundColor configuration option."),
	);
}
/**-------TS61521-C5FB-306C-662E-29D7-49EC-60F2-31073--------*/

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
/**-------TS61521-DFD4-626F-1D4D-5059-91D9-D496-31073--------*/

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
/**-------TS61521-9A47-9B25-FABB-BA16-467B-A167-31073--------*/

/**
 * Google_Config_ImageAreaChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Config_ImageAreaChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Config_ImageAreaChart extends Google_Config_AreaChart {}
/**-------TS61521-749E-D4DC-204F-6E0C-D1CD-34E1-31073--------*/

/**
 * Google_Config_ImageBarChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Config_ImageBarChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Config_ImageBarChart extends Google_Config_BarChart {}
/**-------TS61521-34C3-7D9D-BB78-49A6-8E4C-5190-31073--------*/

/**
 * Google_Config_ImageLineChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Config_ImageLineChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Config_ImageLineChart extends Google_Config_LineChart {}
/**-------TS61521-5A09-384E-9212-14F6-4353-21F6-31073--------*/

/**
 * Google_Config_ImagePieChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Config_ImagePieChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Config_ImagePieChart extends Google_Config_PieChart {}
/**-------TS61521-DCD5-9BEC-3F71-A974-E92E-0726-31073--------*/

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
/**-------TS61521-88E1-3AD4-0FC2-4A8D-B06D-84E1-31073--------*/

/**
 * Google_Config_IntensityMap
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/intensitymap.html
 * @desc configuration object for intensity maps
 * {@example test_google_vis_data_source.php}
 */
/**
 * Google_Config_IntensityMap
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/intensitymap.html
 * @desc configuration object for intensity maps
 */
class Google_Config_IntensityMap extends Google_Config_Base {

	protected $configuration = array(
			"colors" => array("datatype" => "string", "description" => "The colors to use for each tab. An array of strings. Each element is a string in the format #rrggbb. For example '#00cc00'."),
			"height" => array("datatype" => "array", "description" => "Height of the map in pixels."),
			"width" => array("datatype" => "array", "description" => "Width of the map in pixels."),
			"showOneTab" => array("datatype" => "bool", "description" => "The intensity map can display one or more numeric columns. Each column is displayed as a separate map, and tabs on top enable selection of which map to show. When the data table contains only one numeric column, the tabs are not displayed. To display tabs even for a single numeric column, set this option to true."),
			"region" => array(
				"values" => array("world", "africa", "asia", "europe", "middle_east", "south_america", "usa"),
				"datatype" => "string",
				"description" => "The required region. Possible values are: world, africa, asia, europe, middle_east, south_america, and usa.",

				"usa" => array(
					"AL" => "Alabama" , "LA" => "Louisiana", "OH" => "Ohio",
					"AK" => "Alaska" , "ME" => "Maine", "OK" => "Oklahoma",
					"AZ" => "Arizona" , "MD" => "Maryland", "OR" => "Oregon",
					"AR" => "Arkansas" , "MA" => "Massachusetts", "PA" => "Pennsylvania",
					"CA" => "California" , "MI" => "Michigan", "RI" => "Rhode Island",
					"CO" => "Colorado" , "MN" => "Minnesota", "SC" => "S Carolina",
					"CT" => "Connecticut" , "MS" => "Mississippi", "SD" => "S Dakota",
					"DE" => "Delaware", "MO" => "Missouri", "TN" => "Tennessee",
					"FL" => "Florida", "MT" => "Montana", "TX" => "Texas",
					"GA" => "Georgia", "NE" => "Nebraska", "UT" => "Utah",
					"HI" => "Hawaii", "NV" => "Nevada", "VT" => "Vermont",
					"ID" => "Idaho", "NH" => "New Hampshire", "VA" => "Virginia",
					"IL" => "Illinois", "NJ" => "New Jersey", "WA" => "Washington",
					"IN" => "Indiana", "NM" => "New Mexico", "WV" => "W Virginia",
					"IA" => "Iowa", "NY" => "New York", "WI" => "Wisconsin",
					"KS" => "Kansas", "NC" => "N Carolina", "WY" => "Wyoming",
					"KY" => "Kentucky", "ND" => "N Dakota"
				),
				"iso" => array(
					"AFGHANISTAN" => "AF",
					"Ã…LAND ISLANDS" => "AX",
					"ALBANIA" => "AL",
					"ALGERIA" => "DZ",
					"AMERICAN SAMOA" => "AS",
					"ANDORRA" => "AD",
					"ANGOLA" => "AO",
					"ANGUILLA" => "AI",
					"ANTARCTICA" => "AQ",
					"ANTIGUA AND BARBUDA" => "AG",
					"ARGENTINA" => "AR",
					"ARMENIA" => "AM",
					"ARUBA" => "AW",
					"AUSTRALIA" => "AU",
					"AUSTRIA" => "AT",
					"AZERBAIJAN" => "AZ",
					"BAHAMAS" => "BS",
					"BAHRAIN" => "BH",
					"BANGLADESH" => "BD",
					"BARBADOS" => "BB",
					"BELARUS" => "BY",
					"BELGIUM" => "BE",
					"BELIZE" => "BZ",
					"BENIN" => "BJ",
					"BERMUDA" => "BM",
					"BHUTAN" => "BT",
					"BOLIVIA" => "BO",
					"BOSNIA AND HERZEGOVINA" => "BA",
					"BOTSWANA" => "BW",
					"BOUVET ISLAND" => "BV",
					"BRAZIL" => "BR",
					"BRITISH INDIAN OCEAN TERRITORY" => "IO",
					"BRUNEI DARUSSALAM" => "BN",
					"BULGARIA" => "BG",
					"BURKINA FASO" => "BF",
					"BURUNDI" => "BI",
					"CAMBODIA" => "KH",
					"CAMEROON" => "CM",
					"CANADA" => "CA",
					"CAPE VERDE" => "CV",
					"CAYMAN ISLANDS" => "KY",
					"CENTRAL AFRICAN REPUBLIC" => "CF",
					"CHAD" => "TD",
					"CHILE" => "CL",
					"CHINA" => "CN",
					"CHRISTMAS ISLAND" => "CX",
					"COCOS (KEELING) ISLANDS" => "CC",
					"COLOMBIA" => "CO",
					"COMOROS" => "KM",
					"CONGO" => "CG",
					"CONGO, THE DEMOCRATIC REPUBLIC OF THE" => "CD",
					"COOK ISLANDS" => "CK",
					"COSTA RICA" => "CR",
					"CÃ”TE D'IVOIRE" => "CI",
					"CROATIA" => "HR",
					"CUBA" => "CU",
					"CYPRUS" => "CY",
					"CZECH REPUBLIC" => "CZ",
					"DENMARK" => "DK",
					"DJIBOUTI" => "DJ",
					"DOMINICA" => "DM",
					"DOMINICAN REPUBLIC" => "DO",
					"ECUADOR" => "EC",
					"EGYPT" => "EG",
					"EL SALVADOR" => "SV",
					"EQUATORIAL GUINEA" => "GQ",
					"ERITREA" => "ER",
					"ESTONIA" => "EE",
					"ETHIOPIA" => "ET",
					"FALKLAND ISLANDS (MALVINAS)" => "FK",
					"FAROE ISLANDS" => "FO",
					"FIJI" => "FJ",
					"FINLAND" => "FI",
					"FRANCE" => "FR",
					"FRENCH GUIANA" => "GF",
					"FRENCH POLYNESIA" => "PF",
					"FRENCH SOUTHERN TERRITORIES" => "TF",
					"GABON" => "GA",
					"GAMBIA" => "GM",
					"GEORGIA" => "GE",
					"GERMANY" => "DE",
					"GHANA" => "GH",
					"GIBRALTAR" => "GI",
					"GREECE" => "GR",
					"GREENLAND" => "GL",
					"GRENADA" => "GD",
					"GUADELOUPE" => "GP",
					"GUAM" => "GU",
					"GUATEMALA" => "GT",
					"GUERNSEY" => "GG",
					"GUINEA" => "GN",
					"GUINEA-BISSAU" => "GW",
					"GUYANA" => "GY",
					"HAITI" => "HT",
					"HEARD ISLAND AND MCDONALD ISLANDS" => "HM",
					"HOLY SEE (VATICAN CITY STATE)" => "VA",
					"HONDURAS" => "HN",
					"HONG KONG" => "HK",
					"HUNGARY" => "HU",
					"ICELAND" => "IS",
					"INDIA" => "IN",
					"INDONESIA" => "ID",
					"IRAN, ISLAMIC REPUBLIC OF" => "IR",
					"IRAQ" => "IQ",
					"IRELAND" => "IE",
					"ISLE OF MAN" => "IM",
					"ISRAEL" => "IL",
					"ITALY" => "IT",
					"JAMAICA" => "JM",
					"JAPAN" => "JP",
					"JERSEY" => "JE",
					"JORDAN" => "JO",
					"KAZAKHSTAN" => "KZ",
					"KENYA" => "KE",
					"KIRIBATI" => "KI",
					"KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF" => "KP",
					"KOREA, REPUBLIC OF" => "KR",
					"KUWAIT" => "KW",
					"KYRGYZSTAN" => "KG",
					"LAO PEOPLE'S DEMOCRATIC REPUBLIC" => "LA",
					"LATVIA" => "LV",
					"LEBANON" => "LB",
					"LESOTHO" => "LS",
					"LIBERIA" => "LR",
					"LIBYAN ARAB JAMAHIRIYA" => "LY",
					"LIECHTENSTEIN" => "LI",
					"LITHUANIA" => "LT",
					"LUXEMBOURG" => "LU",
					"MACAO" => "MO",
					"MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF" => "MK",
					"MADAGASCAR" => "MG",
					"MALAWI" => "MW",
					"MALAYSIA" => "MY",
					"MALDIVES" => "MV",
					"MALI" => "ML",
					"MALTA" => "MT",
					"MARSHALL ISLANDS" => "MH",
					"MARTINIQUE" => "MQ",
					"MAURITANIA" => "MR",
					"MAURITIUS" => "MU",
					"MAYOTTE" => "YT",
					"MEXICO" => "MX",
					"MICRONESIA, FEDERATED STATES OF" => "FM",
					"MOLDOVA, REPUBLIC OF" => "MD",
					"MONACO" => "MC",
					"MONGOLIA" => "MN",
					"MONTENEGRO" => "ME",
					"MONTSERRAT" => "MS",
					"MOROCCO" => "MA",
					"MOZAMBIQUE" => "MZ",
					"MYANMAR" => "MM",
					"NAMIBIA" => "NA",
					"NAURU" => "NR",
					"NEPAL" => "NP",
					"NETHERLANDS" => "NL",
					"NETHERLANDS ANTILLES" => "AN",
					"NEW CALEDONIA" => "NC",
					"NEW ZEALAND" => "NZ",
					"NICARAGUA" => "NI",
					"NIGER" => "NE",
					"NIGERIA" => "NG",
					"NIUE" => "NU",
					"NORFOLK ISLAND" => "NF",
					"NORTHERN MARIANA ISLANDS" => "MP",
					"NORWAY" => "NO",
					"OMAN" => "OM",
					"PAKISTAN" => "PK",
					"PALAU" => "PW",
					"PALESTINIAN TERRITORY, OCCUPIED" => "PS",
					"PANAMA" => "PA",
					"PAPUA NEW GUINEA" => "PG",
					"PARAGUAY" => "PY",
					"PERU" => "PE",
					"PHILIPPINES" => "PH",
					"PITCAIRN" => "PN",
					"POLAND" => "PL",
					"PORTUGAL" => "PT",
					"PUERTO RICO" => "PR",
					"QATAR" => "QA",
					"RÃ‰UNION" => "RE",
					"ROMANIA" => "RO",
					"RUSSIAN FEDERATION" => "RU",
					"RWANDA" => "RW",
					"SAINT BARTHÃ‰LEMY" => "BL",
					"SAINT HELENA" => "SH",
					"SAINT KITTS AND NEVIS" => "KN",
					"SAINT LUCIA" => "LC",
					"SAINT MARTIN" => "MF",
					"SAINT PIERRE AND MIQUELON" => "PM",
					"SAINT VINCENT AND THE GRENADINES" => "VC",
					"SAMOA" => "WS",
					"SAN MARINO" => "SM",
					"SAO TOME AND PRINCIPE" => "ST",
					"SAUDI ARABIA" => "SA",
					"SENEGAL" => "SN",
					"SERBIA" => "RS",
					"SEYCHELLES" => "SC",
					"SIERRA LEONE" => "SL",
					"SINGAPORE" => "SG",
					"SLOVAKIA" => "SK",
					"SLOVENIA" => "SI",
					"SOLOMON ISLANDS" => "SB",
					"SOMALIA" => "SO",
					"SOUTH AFRICA" => "ZA",
					"SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS" => "GS",
					"SPAIN" => "ES",
					"SRI LANKA" => "LK",
					"SUDAN" => "SD",
					"SURINAME" => "SR",
					"SVALBARD AND JAN MAYEN" => "SJ",
					"SWAZILAND" => "SZ",
					"SWEDEN" => "SE",
					"SWITZERLAND" => "CH",
					"SYRIAN ARAB REPUBLIC" => "SY",
					"TAIWAN, PROVINCE OF CHINA" => "TW",
					"TAJIKISTAN" => "TJ",
					"TANZANIA, UNITED REPUBLIC OF" => "TZ",
					"THAILAND" => "TH",
					"TIMOR-LESTE" => "TL",
					"TOGO" => "TG",
					"TOKELAU" => "TK",
					"TONGA" => "TO",
					"TRINIDAD AND TOBAGO" => "TT",
					"TUNISIA" => "TN",
					"TURKEY" => "TR",
					"TURKMENISTAN" => "TM",
					"TURKS AND CAICOS ISLANDS" => "TC",
					"TUVALU" => "TV",
					"UGANDA" => "UG",
					"UKRAINE" => "UA",
					"UNITED ARAB EMIRATES" => "AE",
					"UNITED KINGDOM" => "GB",
					"UNITED STATES" => "US",
					"UNITED STATES MINOR OUTLYING ISLANDS" => "UM",
					"URUGUAY" => "UY",
					"UZBEKISTAN" => "UZ",
					"VANUATU" => "VU",
					"VATICAN CITY STATE" => "see HOLY SEE",
					"VENEZUELA" => "VE",
					"VIET NAM" => "VN",
					"VIRGIN ISLANDS, BRITISH" => "VG",
					"VIRGIN ISLANDS, U.S." => "VI",
					"WALLIS AND FUTUNA" => "WF",
					"WESTERN SAHARA" => "EH",
					"YEMEN" => "YE",
					"ZAMBIA" => "ZM",
					"ZIMBABWE" => "ZW"
				)
			),
		);
}
/**-------TS61521-AE9E-2B5E-FE84-08E7-BE45-49D8-31073--------*/

/**
 * Google_Config_LineChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/linechart.html
 */
/**
 * Google_Config_LineChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/linechart.html
 */
class Google_Config_LineChart extends Google_Config_Base {

	protected $configuration = array(
		"title" => array("datatype" => "string", "description" => "Text to display above the chart."),
		"titleX" => array("datatype" => "string", "description" => "Text to display below the horizontal axis."),
		"titleY" => array("datatype" => "string", "description" => "Text to display by the vertical axis."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"lineSize" => array("datatype" => "integer", "description" => "Line width in pixels. Use zero to hide all lines and show only the points."),
		"pointSize" => array("datatype" => "integer", "description" => "Size of displayed points in pixels. Use zero to hide all points."),
		"legend" => array(
			"values" => array("right", "left", "top", "bottom", "none"),
			"datatype" => "string",
		    "description" => "Position and type of legend. Can be one of the following:<ul><li><b>right</b> - To the right of the chart.</li><li><b>left</b> - To the left of the chart.</li><li><b>top</b> - Above the chart.</li><li><b>bottom</b> - Below the chart.</li><li><b>none</b> - No legend is displayed.</li></ul>"
		),
		"smoothLine" => array("datatype" => "bool", "description" => "Height of the chart in pixels."),
		"reverseAxis" => array("datatype" => "bool", "description" => "If set to true, will draw categories from right to left. The default is to draw left-to-right."),
		"titleColor" => array("datatype" => "string,object", "description" => "The color for the chart's title. Possible values are as those of the backgroundColor configuration option."),
		"axisColor" => array("datatype" => "string,object", "description" => "The color of the axis. Possible values are as those of the backgroundColor configuration option."),
		"axisBackgroundColor" => array("datatype" => "string,object", "description" => "The border around axis background. Possible values are as those of the backgroundColor configuration option."),
		"backgroundColor" => array("datatype" => "string,object", "description" => "The background color for the main area of the chart. May be one of the following options:<ul><li>A string with color supported by HTML, for example 'red' or '#00cc00'</li><li>An object with properties stroke fill and strokeSize.</li></ul>stroke and fill should be a string with a color. strokeSize is a number.<br/>For example: {backgroundColor: {stroke:'black', fill:'#eee', strokeSize: 1}. To use just fill, without a stroke, use stroke:null, strokeSize: 0."),
		"borderColor" => array("datatype" => "string,object", "description" => "The border around chart elements. Possible values are as those of the backgroundColor configuration option."),
		"colors" => array("datatype" => "array", "description" => "The colors to use for the chart elements. An array of strings. Each element is a string that is a color supported by HTML, for example 'red' or '#00cc00'."),
		"focusBorderColor" => array("datatype" => "string,object", "description" => "The border around chart elements that are in focus (pointed by the mouse). Possible values are as those of the backgroundColor configuration option."),
		"legendBackgroundColor" => array("datatype" => "string,object", "description" => "The background color for the legend area of the chart. Possible values are as those of the backgroundColor configuration option."),
		"legendTextColor" => array("datatype" => "string,object", "description" => "The color for the text entries of the legend. Possible values are as those of the backgroundColor configuration option."),
	);

}
/**-------TS61521-FCAB-0EBB-270F-6FD2-61A4-2094-31073--------*/

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
/**-------TS61521-CF26-DFAA-AA1D-18A5-474A-997C-31073--------*/

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
/**-------TS61521-C827-1660-18A6-DE10-6AA1-C8D8-31073--------*/

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
/**-------TS61521-AC63-95A4-9052-8FA5-4C35-141F-31073--------*/

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
/**-------TS61521-E6AC-ABE9-D5E3-48D3-18B2-F9CB-31073--------*/

/**
 * Google_Config_ScatterChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/scatterchart.html
 */
/**
 * Google_Config_ScatterChart
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/scatterchart.html
 */
class Google_Config_ScatterChart extends Google_Config_Base {

	protected $configuration = array(
		"axisColor" => array("datatype" => "string,object", "description" => "The color of the axis. Possible values are as those of the backgroundColor configuration option."),
		"axisBackgroundColor" => array("datatype" => "string,object", "description" => "The border around axis background. Possible values are as those of the backgroundColor configuration option."),
		"backgroundColor" => array("datatype" => "string,object", "description" => "The background color for the main area of the chart. May be one of the following options:<ul><li>A string with color supported by HTML, for example 'red' or '#00cc00'</li><li>An object with properties stroke fill and strokeSize.</li></ul>stroke and fill should be a string with a color. strokeSize is a number.<br/>For example: {backgroundColor: {stroke:'black', fill:'#eee', strokeSize: 1}. To use just fill, without a stroke, use stroke:null, strokeSize: 0."),
		"borderColor" => array("datatype" => "string,object", "description" => "The border around chart elements. Possible values are as those of the backgroundColor configuration option."),
		"colors" => array("datatype" => "array", "description" => "The colors to use for the chart elements. An array of strings. Each element is a string that is a color supported by HTML, for example 'red' or '#00cc00'."),
		"focusBorderColor" => array("datatype" => "string,object", "description" => "The border around chart elements that are in focus (pointed by the mouse). Possible values are as those of the backgroundColor configuration option."),
		"legend" => array(
			"values" => array("right", "left", "top", "bottom", "none"),
			"datatype" => "string",
		    "description" => "Position and type of legend. Can be one of the following:<ul><li><b>right</b> - To the right of the chart.</li><li><b>left</b> - To the left of the chart.</li><li><b>top</b> - Above the chart.</li><li><b>bottom</b> - Below the chart.</li><li><b>none</b> - No legend is displayed.</li></ul>"
		),
		"legendBackgroundColor" => array("datatype" => "string,object", "description" => "The background color for the legend area of the chart. Possible values are as those of the backgroundColor configuration option."),
		"legendTextColor" => array("datatype" => "string,object", "description" => "The color for the text entries of the legend. Possible values are as those of the backgroundColor configuration option."),
		"lineSize" => array("datatype" => "integer", "description" => "Line width in pixels. Use zero to hide all lines and show only the points."),
		"pointSize" => array("datatype" => "integer", "description" => "Size of displayed points in pixels. Use zero to hide all points."),
		"title" => array("datatype" => "string", "description" => "Text to display above the chart."),
		"titleX" => array("datatype" => "string", "description" => "Text to display below the horizontal axis."),
		"titleY" => array("datatype" => "string", "description" => "Text to display by the vertical axis."),
		"titleColor" => array("datatype" => "string,object", "description" => "The color for the chart's title. Possible values are as those of the backgroundColor configuration option."),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
	);
}
/**-------TS61521-7D39-937B-CD90-0ADA-60AB-96DD-31073--------*/

/**
 * Google_Config_Table
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/table.html
 */
/**
 * Google_Config_Table
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/table.html
 */
class Google_Config_Table extends Google_Config_Base {

	protected $configuration = array(
		"allowHtml" => array("datatype" => "bool", "description" => "If set to true, formatted values of cells that include HTML tags will be rendered as HTML. If set to false, most custom formatters  will not work properly."),
		"page" => array(
			"datatype" => "string,object",
			"values" => array("enable","event","disable"),
			"description" => "Possible values are <strong>enable</strong>, <strong>event</strong>, and <strong>disable</strong>.<br/>If <strong>enable</strong> is used, the table will include page-forward and page-back buttons. Clicking on these buttons will perform the paging operation and change the displayed page.<br/>If <strong>event</strong> is used, the table will include page-forward and page-back buttons. Clicking on these buttons will trigger a <strong>page</strong> event and will not change the displayed page. This option should be used when the page implements its own paging.<br/>If <strong>disable</strong> is used (the default), paging will not be used. "
			),
		"pageSize" => array("datatype" => "integer", "description" => "The number of rows in each page, when paging is enabled."),
		"sort" => array(
			"datatype" => "string,object",
			"values" => array("enable","event","disable"),
			"description" => array("Possible values are <strong>enable</strong>, <strong>event</strong>, and <strong>disable</strong>.<br/>If <strong>enable</strong> is used (the default), users can click on column headers to sort by the clicked column. When users click on the column header, the rows will be automatically sorted, and a <strong>sort</strong> event will be triggered.<br/>If <strong>event</strong> is used, users can click on column headers to sort by the clicked column. When users click on the column header, a <strong>sort</strong> event will be triggered, but the rows will not be automatically sorted. This option should be used when the page implements its own sort.<br/>If <strong>disable</strong> is used, clicking a column header has no effect.")
		),
		"showRowNumber" => array(
			"datatype" => "string,object",
			"values" => array("enable","event","disable"),
			"description" => "If set to true, shows the row number as the first column of the table."
		),
		"height" => array("datatype" => "integer", "description" => "Height of the chart in pixels."),
		"width" => array("datatype" => "integer", "description" => "Width of the chart in pixels."),
	);
}
/**-------TS61521-50CA-65A6-4E26-4D5C-2815-A7CB-31073--------*/


/**
 * Google_Config
 * @desc Class holds dynamically loaded chart configuration data.
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
 */
/**
 * Google_Config
 * @desc Class holds dynamically loaded chart configuration data.
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
 */
class Google_Config {

	/**
	 * template name part
	 * @var string $type
	 */
	private $type;

	/**
	 * @var stdClass $configObject
	 */
	private $configObject;

	/**
	 * chart config object
	 * @var gdBase $default
	 */
	protected $default;

	/**
	 * __construct
	 * @param string $type
	 */
	public function __construct($type, $title=null) {
		if(!empty($type)){
			$this->type = $type;
			$this->configObject = new stdClass;
			$clsName = __CLASS__."_".$type;
			$this->default = new $clsName;
			$this->configObject = $this->default->getDefaultConfig($type);
			if(empty($this->configObject)) {
				$this->defaultConfig($title);
			}
		}
	}

	/**
	 * setProperty
	 * @param string $name
	 * @param mixed $val
	 * @return void
	 */
    public function setProperty($name, $val){

        if($this->hasProperty($name)) {
            $this->configObject->props->$name = $val;
        } elseif(property_exists($this->configObject, $name)) {
            $this->configObject->$name = $val;
        } else {
            $e = new Google_Exception_Config("Chart $this->chartType does not support a property named $name.");
			echo $e->show($this);
        }
        return $this;
    }

	/**
	 * __call
	 * @desc Resolves dynamically build chart class methods from configuration data.
	 *
	 * @param string $name
	 * @param array $parameters
	 */
	public function __call($name, $parameters) {
		$methodObject = Google_Base::getMethodType($name);
		$methodType = $methodObject["type"];
		$name = $methodObject["name"];
		switch($methodType) {
			case "set":
				$firstDown = Google_Base::ucFirstDown($name);
				$this->setProperty($firstDown, $parameters[0]);
				break;
			default:
				break;
		}
	}

	/**
	 * hasProperty
	 * @desc test if a chart type has a specific property
	 * @param string $name
	 * @return bool
	 */
	public function hasProperty($name) {
		return $this->default->hasProperty($name);
	}

	/**
	 * setViewport
	 * @param integer $width
	 * @param integer $height
	 * @param string $class
	 * @return void
	 */
    public function setViewport($width=800, $height=600, $title=null, $class=null){
        $this->configObject->viewport->width = (int)$width;
        $this->configObject->viewport->height = (int)$height;
        if($title){
            $this->configObject->viewport->title = (string)$title;
		}
        if($class){
            $this->configObject->viewport->class = (string)$class;
		}
        return $this;
    }

    /**
     * defaultConfig
     * @param string $title
     * @return void
     */
    public function defaultConfig($title) {

        $objChart = $this->configObject;
        $objChart->type = $this->type;
        $objChart->provider = "google";
        $objChart->scope = "visualization";
        $objChart->version = 1;
        $objChart->language = "de_DE";
        $objChart->port = "chart";

        $objChart->props = new stdClass();
        $objChart->props->title = $title;
        $objChart->props->height = 600;
        $objChart->props->width = 800;

        $objChart->viewport = new stdClass();
        $objChart->viewport->height = 680;
        $objChart->viewport->width = 800;

        $this->configObject = $objChart;

        return $this;
    }

	/**
	 * render
	 * @return string
	 */
	public function render(){
		return Google_Base::toJson($this->configObject);
	}

	/**
	 * getProperties
	 * @desc returns chart property values
	 * @return array
	 */
	public function getProperties() {
		return $this->configObject->props;
	}

	/**
	 * getConfigObject
	 * @desc returns dynamically loaded chart object data
	 * @return Chart_Config
	 */
	public function getConfigObject() {
		return $this->configObject;
	}

	/**
	 * getDefault
	 * @desc returns a default configuation object
	 * @return Chart_Config
	 */
	public function getDefault(){
		return $this->default;
	}


	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		return Google_Base::toJson($this->configObject);
	}

	/**
	 * @TODO check for removal
	 * @return string
	 */
	public function getData(){
		return Google_Base::toJson($this->configObject);
	}

}
/**-------TS61521-CEA1-FE0B-EABA-C785-C510-A11B-31073--------*/

/**
 * Google_Container
 *
 * @desc Create a xhtml element container where the chart object resides.
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-31
 */
/**
 * Google_Container
 *
 * @desc Create a xhtml element container where the chart object resides.
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-31
 */
class Google_Container {

	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $errorContainer;

	/**
	 * @var Google_Container
	 */
	private $error;

	/**
	 * @var bool
	 */
	private $hasPrefix = false;

	/**
	 * @var string
	 */
	private $prefix = 'gc-';

	/**
	 * @var string
	 */
	private $element = 'div';

	/**
	 * @var array
	 */
	private $attributes = array();

	/**
	 * __construct
	 * @param array $attributes
	 * @param string $prefix
	 * @param string $element
	 */
	public function __construct($attributes=array(), $prefix=true, $element='div') {
		$this->element = (string) $element;
		$this->attributes = $attributes;
		$this->hasPrefix= (bool)$prefix;
	}

	/**
	 * reportTo
	 * @desc dependency injection of a container which is used to show
	 * repsonse messages
	 * @param string $name
	 * @param Google_Container $c
	 */
	public function reportTo($name, Google_Container $c) {
		if($this->id !== $c->getHash()){
			$this->errorContainer = $name;
			$this->error = $c;
		} else {
			throw new InvalidArgumentException("id and hash are equal. It is not allowed to inject an object into itself.");
		}
	}

	/**
	 * getErrorContainer
	 * @return string returns the name of the error container
	 */
	public function getErrorContainer() {
		return $this->errorContainer;
	}

	/**
	 * getError
	 * @desc returns the error container's name
	 * @return string
	 */
	public function getError() {
		if($this->error instanceof Google_Container) {
			return $this->error->getErrorContainer();
		} else {
			return '';
		}
	}

	/**
	 * setId
	 * @desc set the unique hash
	 * @return void
	 */
	public function setId(){
		$this->id = spl_object_hash($this);
	}

	/**
	 * getHash
	 * @return string
	 */
	public function getHash(){
		return $this->id;
	}

	/**
	 * getId
	 * @return string
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 *__toString
	 * render container into xhtml string
	 * @return string
	 */
	public function __toString() {
		$string = '<'. $this->element;
		$strAttr = array();
		if($this->id) { // make container unique
			$this->attributes["id"] = ($this->hasPrefix?$this->prefix:'').(array_key_exists("id",$this->attributes)?$this->attributes["id"]:$this->id);
			$this->attributes["class"] = $this->prefix.(array_key_exists("class",$this->attributes)?$this->attributes["class"]:"container");
		}

		if(count($this->attributes)) {
			foreach($this->attributes as $name => $val) {
				$strAttr[] = $name .'="'. (string)$val.'"';
			}

			if(count($strAttr)>0){
				$string .=' ';
				$string .= implode(" ", $strAttr);
			}
		}
		$string .= '>';
		$string .= '</'. $this->element.'>';
		return $string;
	}
}
/**-------TS61521-EC26-D718-098A-F400-C4D1-6A9C-31073--------*/

/**
 * Google_Data_Base
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_Base
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_Base implements Google_Data_Interface
{
	/**
	 * @var bool $isResponse
	 */
	private $isResponse = true;
	/**
	 * @var string $response
	 */
	protected $response = "";
	/**
	 * @var string $closeResponse
	 */
	protected $closeResponse = "";
	/**
	 * @var array $columns
	 */
	protected $columns;
	/**
	 * @var array $rows
	 */
	protected $rows = array ();
	/**
	 * @var string $requestID
	 */
	protected $requestID;
	/**
	 * @var string $strSignature
	 */
	protected $strSignature;
	/**
	 * @var string $dataObjectName
	 */
	private $dataObjectName = "dataObj";

	/**
	 * constructor
	 * @param string $tqx
	 */
	public function __construct($tqx = null){
		if(empty($tqx)) {
			$this->isResponse = false;
		}
		$this->init($tqx);
	}

	/**
	 * getName
	 * @desc returns the name of a data object
	 * @return string
	 */
	public function getName() {
		return $this->dataObjectName;
	}

	/**
	 * setName
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->dataObjectName = (string) $name;
	}

	/**
	 * init
	 * @param string $tqx
	 * @return void
	 */
	public function init($tqx = null)
	{
		$this->response = "google.visualization.Query.setResponse({";
		$requestID = "0";
		$strSignature = $this->getSignature();
		$this->response .= "version:'0.5',";
		$this->response .= "reqId:'".$requestID."',";
		$this->response .= "status:'ok',";
		$this->response .= "sig:'".$strSignature."',";
		$this->response .= "table:{";
		$this->closeResponse = "}});\n";

		$this->columns = new Google_Data_Columns();
	}

	/**
	 * addColumn
	 * @param string $id
	 * @param string $label
	 * @param string $type
	 * @param string $pattern
	 */
	public function addColumn($id, $label, $type, $pattern = "")
	{
		$this->columns->addColumn($id, $label, $type, $pattern);
	}

	/**
	 * addNewRow
	 * @return void
	 */
	public function addNewRow()
	{
		array_push($this->rows, new Google_Data_Rows());
	}

	/**
	 * setEmptyCell
	 * @return void
	 */
	public function setEmptyCell()
	{
		end($this->rows)->setEmptyCell();
	}

	/**
	 * addStringCellToRow
	 * @param mixed $value
	 * @param string $fValue
	 * @return void
	 */
	public function addStringCellToRow($value, $fValue = null)
	{
		end($this->rows)->setCell("string", $value, $fValue);
	}

	/**
	 * addNumberCellToRow
	 * @param mixed $value
	 * @param string $fValue
	 * @return void
	 */
	public function addNumberCellToRow($value, $fValue = null)
	{
		end($this->rows)->setCell("number", $value, $fValue);
	}

	/**
	 * addDateCellToRow
	 * @param integer $year
	 * @param integer $month
	 * @param integer $day
	 * @param integer $hour
	 * @param integer $minutes
	 * @param integer $seconds
	 * @param string $fValue
	 * @return void
	 */
	public function addDateCellToRow($year, $month, $day, $hour = 0, $minutes = 0, $seconds = 0, $fValue = null)
	{
		if ($month <= 0) {
			$month = 0;
		} else {
			$month -= 1;
		}
		end($this->rows)->setCell("date", (string) new Google_Type_Date($month, $day, $hour, $minutes, $seconds), $fValue);
	}

    /**
     * addDatetimeCellToRow
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minutes
     * @param int $seconds
     * @param string $fValue
	 * @return void
     */
	public function addDatetimeCellToRow($year, $month, $day, $hour = 0, $minutes = 0, $seconds = 0, $fValue = null)
	{
		if ($month <= 0) {
			$month = 0;
		} else {
			$month -= 1;
		}
		end($this->rows)->setCell("datetime", (string) new Google_Type_Date($month, $day, $hour, $minutes, $seconds), $fValue);
	}

	/**
	 * addTimeCellToRow
	 * @param integer $hour
	 * @param integer $minutes
	 * @param integer $seconds
	 * @param integer $timezoneOffset
	 * @param integer $fValue
	 * @return void
	 */
	public function addTimeCellToRow($hour, $minutes, $seconds = 0, $timezoneOffset = 0, $fValue = null)
	{
		end($this->rows)->setCell("time", (string) new Google_Type_Time($hour, $minutes, $seconds, $timezoneOffset), $fValue);
	}

	/**
	 * addBoolCellToRow
	 * @param mixed $value
	 * @param string $fValue
	 * @return void
	 */
	public function addBoolCellToRow($value, $fValue = null)
	{
		end($this->rows)->setCell("bool", $value, $fValue);
	}

	/**
	 * getData
	 * @desc returns the data values as json string
	 * @return string
	 */
    public function getData() {

		$strResult = "{";
		$strResult .= $this->columns;
		$strResult .= ",rows: [";
		$boolRows = reset($this->rows);
		while ($boolRows !== FALSE)
		{
			$strResult .= $boolRows;
			$boolRows = next($this->rows);
			if ($boolRows !== FALSE)
				$strResult .= ",";
		}
		$strResult .= "]";
		$strResult .= "}";
		$arrReplacements = array (
			"\r",
			"\n",
			"\t"
		);
		$strResult = str_replace($arrReplacements, "", $strResult);
		return $strResult;
    }

	/**
	 * returns pure json data object
	 * @return string
	 */
	public function __toString()
	{
		if(empty($this->isResponse)) {
			return $this->getData();
		}

		$strResult = $this->response;
		$strResult .= $this->columns;
		$strResult .= ",rows: [";
		$boolRows = reset($this->rows);
		while ($boolRows !== FALSE)
		{
			$strResult .= $boolRows;
			$boolRows = next($this->rows);
			if ($boolRows !== FALSE) {
				$strResult .= ",";
			}
		}
		$strResult .= "]";
		$strResult .= $this->closeResponse;
		$arrReplacements = array (
			"\r",
			"\n",
			"\t"
		);
		$strResult = str_replace($arrReplacements, "", $strResult);
		return $strResult;
	}

	/**
	 * getSignature
	 * @return string
	 */
	protected function getSignature()
	{
		srand($this->getMicrotime());
		$intRnd1 = rand();
		$intRnd2 = rand();
		$intRnd3 = rand();
		return strval($intRnd1).strval($intRnd2).strval($intRnd3);
	}

	/**
	 * getMicrotime
	 * @return float
	 */
	private function getMicrotime()
	{
		list ($strDatetime, $strMicrotime) = explode(' ', microtime());
		return (float) $strMicrotime + ((float) $strDatetime * 100000);
	}
}

/**-------TS61521-D809-8A79-1439-AC56-29A4-F455-31073--------*/

/**
 * Google_Data_ColumnCell
 * @desc setup column cells
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_ColumnCell
 * @desc setup column cells
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_ColumnCell
{
	/**
	 * @var string $id
	 */
	protected $id;
	/**
	 * @var string $label
	 */
	protected $label;
	/**
	 * @var string $type
	 */
	protected $type;
	/**
	 * @var string $pattern
	 */
	protected $pattern;

	/**
	 * constructor
	 * @param string $id
	 * @param string $label
	 * @param string $type
	 * @param string $pattern
	 */
	public function __construct($id, $label, $type, $pattern = "")
	{
		$this->setColumnId($id);
		$this->setColumnLabel($label);
		$this->setColumnType($type);
		$this->setColumnPattern($pattern);
	}

	/**
	 * setColumnId
	 * @desc set column id checking against filter
	 * @param string $id
	 * @return bool
	 */
	public function setColumnId($id)
	{
		$boolState = true;
		$searchKeywords = array (
			"and",
			"asc",
			"avg",
			"by",
			"count",
			"date",
			"datetime",
			"desc",
			"false",
			"format",
			"from",
			"group",
			"is",
			"label",
			"limit",
			"max",
			"min",
			"not",
			"null",
			"offset",
			"options",
			"or",
			"order",
			"pivot",
			"select",
			"sum",
			"timeofday",
			"timestamp",
			"true",
			"where"
		);
		$replaceKeywords = array (
			"and_id",
			"asc_id",
			"avg_id",
			"by_id",
			"count_id",
			"date_id",
			"datetime_id",
			"desc_id",
			"false_id",
			"format_id",
			"from_id",
			"group_id",
			"is_id",
			"label_id",
			"limit_id",
			"max_id",
			"min_id",
			"not_id",
			"null_id",
			"offset_id",
			"options_id",
			"or_id",
			"order_id",
			"pivot_id",
			"select_id",
			"sum_id",
			"timeofday_id",
			"timestamp_id",
			"true_id",
			"where_id"
		);
		if ((isset ($id)) && (!is_null($id)))
			$this->id = str_replace($searchKeywords, $replaceKeywords, $id);
		else
			$boolState = false;
		return $boolState;
	}

	/**
	 * setColumnLabel
	 * @param string $label
	 * @return bool
	 */
	public function setColumnLabel($label)
	{
		$boolState = true;
		if ((isset ($label)) && (!is_null($label))) {
			$this->label = $label;
		} else {
			$boolState = false;
		}
		return $boolState;
	}

	/**
	 * setColumnType
	 * @param string $type
	 * @return bool
	 */
	public function setColumnType($type)
	{
		$boolState = true;
		if ((isset ($type)) && (!is_null($type)))
		{
			switch ($type)
			{
				case "string" :
					$this->type = 'string';
					break;
				case "number" :
					$this->type = 'number';
					break;
				case "date" :
					$this->type = 'date';
					break;
				case "time" :
					$this->type = 'time';
					break;
				case "datetime" :
					$this->type = 'datetime';
					break;
				case "bool" :
					$this->type = 'boolean';
					break;
				default :
					$this->type = 'string';
			}
		}
		else
		{
			$boolState = false;
		}
		return $boolState;
	}

	/**
	 * setColumnPattern
	 * @param string $pattern
	 * @return bool
	 */
	public function setColumnPattern($pattern)
	{
		$boolState = true;
		if ((isset ($pattern)) && (!is_null($pattern))) {
			$this->pattern = $pattern;
		} else {
			$boolState = false;
		}
		return $boolState;
	}

	/**
	 * __toString
	 * @desc renders a column cell into a string
	 * @return string
	 */
	public function __toString()
	{
		if (isset ($this->type) && !is_null($this->type) && isset ($this->label) && !is_null($this->label) && isset ($this->id) && !is_null($this->id)) {
			$strResult = "{id:'".$this->id."',label:'".$this->label."',type:'".$this->type."',pattern:'".$this->pattern."'}";
		} else {
			$strResult = "Error: Some of the column properties are not set or null ";
		}
		return $strResult;
	}

}

/**-------TS61521-52E4-C11E-6C14-10B3-0C63-9E46-31073--------*/

/**
 * Google_Data_Columns
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_Columns
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_Columns
{
	/**
	 * @var array $columns
	 */
	protected $columns = array ();

	/**
	 * addColumn
	 * @param string $id
	 * @param string $label
	 * @param string $type
	 * @param string $pattern
	 * @return bool
	 */
	public function addColumn($id, $label, $type, $pattern = "")
	{
		if (isset ($type) && !is_null($type) && isset ($label) && !is_null($label) && isset ($id) && !is_null($id)){
			array_push($this->columns, new Google_Data_ColumnCell($id, $label, $type, $pattern));
		} else {
			return false;
		}
	}

	/**
	 * __toString
	 * @desc render columns into string
	 * @return string
	 */
	public function __toString()
	{
		$strResult = "cols: [";
		$boolColumns = reset($this->columns);
		while ($boolColumns !== FALSE)
		{
			$strResult .= $boolColumns;
			$boolColumns = next($this->columns);
			if ($boolColumns !== FALSE)
				$strResult .= ",";
		}
		$strResult .= "]";
		return $strResult;
	}
}

/**-------TS61521-7308-D736-E993-4BF8-CAF6-588A-31073--------*/


/**-------TS61521-26A7-DD07-446D-5FAB-83E2-162A-31073--------*/
/**
 *
 * Google_Data_Query
 *
 * @desc Represents a query that is sent to a data source.
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

*/
/**
 *
 * Google_Data_Query
 *
 * @desc Represents a query that is sent to a data source.
 * {@example test_google_vis_data_source_request.php}
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

*/
class Google_Data_Query {

	/**
	 * @var string $provider
	 */
	private $provider = 'google';

	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';

	/**
	 * @var string $type name of scope method
	 */
	private $type = 'Query';

	/**
	 * @var array properties
	 */
	private $properties=null;

	/**
	 * @var string $dataTable
	 */
	private $dataTable='request';

	/**
	 * @var string $dataSourceUrl
	 */
	private $dataSourceUrl='';

	/**
	 * __construct
	 * @desc dataSourceUrl is of type string and is provided by the data source.
	 * For example, to get the dataSourceUrl from a Google Spreadsheet, do the following:
	 *    1. In your spreadsheet, select the range of cells.
	 *    2. Select 'Insert' and then 'Gadget' from the menu.
	 *    3. Open the gadget's menu by clicking on the top-right selector.
	 *    4. Select menu option 'Get data source URL'.
	 *
	 * @param string $url
	 * @param Google_Property $properties
	 */
	public function __construct($url, $properties = null) {
		$this->dataSourceUrl = $url;
		if($properties instanceof Google_Property) {
			$this->properties = $properties;
		}
	}

	/**
	 * setRefreshInterval
	 *
	 * @desc Sets the query to automatically call the send method every specified
	 * duration (number of seconds), starting from the first explicit call to send.
	 * seconds is a number greater than or equal to zero.
	 * If set to zero (the default), the query will not be automatically resent.
	 * This method, if used, should be called before calling the send method.
	 *
	 * @param integer $seconds
	 */
	public function setRefreshInterval($seconds) {
		$this->properties[__FUNCTION__][] = $seconds;
	}

	/**
	 * setTimeout
	 *
	 * @desc Sets the number of seconds to wait for the data source to respond
	 * before raising a timeout error. seconds is a number greater than zero.
	 * The default timeout is 30 seconds. This method, if used, should be called
	 * before calling the send method.
	 *
	 * @param integer $seconds
	 */
	public function setTimeout($seconds) {
		$this->properties[__FUNCTION__][] = $seconds;
	}

	/**
	 * setQuery
	 *
	 * @desc Sets the query string. The value of the string parameter should be
	 * a valid query.
	 * This method, if used, should be called before calling the send method.
	 *
	 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/querylanguage.html
	 * @param string $string
	 */
	public function setQuery($string) {
		$this->properties[__FUNCTION__][] = "'". $string ."'";
	}

	/**
	 * send
	 *
	 * @desc Sends the query to the data source. callback should be a function that will
	 * be called when the data source responds. The callback function will receive
	 * a single parameter of type
	 *
	 * @param string $callback
	 */
	public function send($callback) {
		$this->properties[__FUNCTION__][] = $callback;
	}

	/**
	 * validateUrl
	 * @TODO: manipulate $check["path"] And $check["query"] via parse_str
	 * $checks = array("scheme"=>false, "host"=> false, "port" => false, "user" => false, "pass" => false, "path" => false, "query" => false, "fragment" => false);
	 * @param string $value
	 * @return mixed
	 */
	public static function validateUrl($value) {

		$count = 0;
		$url = parse_url($value);

		foreach($url as $key => $item)
		{
			switch($key)
			{
				case 'scheme':
					switch(strtolower($item))
					{
						case 'http':
						case 'https':
						case 'ftp':
							break;
						default:
							return strtoupper("validateUrl_scheme");
					}
					break;
				case 'host':
					$domainSuffix = array(
						"ac","ac.uk","ad","ae","af","ag","ai","al","am","an","ao","aq","ar","arpa","as","at",
						"au","aw","az","ba","bb","bd","be","bf","bg","bh","bi","bj","bm","bn","bo",
						"br","bs","bt","bv","bw","by","bz","ca","cc","cd","cf","cg","ch","ci","ck",
						"cl","cm","cn","co","co.uk","com","cr","cs","cu","cv","cx","cy","cz","de",
						"dj","dk","dm","do","dz","ec","edu","ee","eg","eh","er","es","et","fi","fj",
						"fk","fm","fo","fr","ga","gd","ge","gf","gg","gh","gi","gl","gm","gn","gov",
						"gp","gq","aero","asia","biz","coop","eu","info","museum","name","pro","travel",
						"gr","gs","gt","gu","gw","gy","hk","hm","hn","hr","ht","hu","id","ie","il","im","in",
						"int","io","iq","ir","is","it","je","jm","jo","jp","ke","kg","kh","ki","km","kn","kp",
						"kr","kw","ky","kz","la","lb","lc","li","lk","lr","ls","lt","lu","lv","ly","ma","mc",
						"md","mg","mh","mil","mk","ml","mm","mn","mo","mp","mq","mr","ms","mt","mu","mv","mw",
						"mx","my","mz","na","nc","ne","net","nf","ng","ni","nl","no","np","nr","nt","nu","nz",
						"om","org","pa","pe","pf","pg","ph","pk","pl","pm","pn","pr","ps","pt","pw","py","qa",
						"re","ro","ru","rw","sa","sb","sc","sd","se","sg","sh","si","sj","sk","sl","sm","sn",
						"so","sr","sv","st","sy","sz","tc","td","tf","tg","th","tj","tk","tm","tn","to","tp",
						"tr","tt","tv","tw","tz","ua","ug","uk","um","us","uy","uz","va","vc","ve","vg","vi",
						"vn","vu","wf","ws","ye","yt","yu","za","zm","zw"
					);
					$invalidIp = self::validateIp($item);
					$invalidHost = false;
					$invalidDomainSuffix = false;

					if (empty($invalidIp))
					{
						$host = explode(".", $item,3);
						$arrDom = array_flip($domainSuffix);
						$invalidDomainSuffix = array_key_exists($host[2], $arrDom);

						if (false===($invalidDomainSuffix))
						{
							return strtoupper("validateUrl_invalidDomainSuffix");
						}
					}

					if (empty($invalidIp) && empty($invalidDomainSuffix))
					{
						return strtoupper("validateUrl_invalidIp");
					}
					break;
			}

			if(1===count($url) and isset($url["path"])) {
				return strtoupper("validateUrl_missingHost");
			}
			$count++;
		}

		return ($count>1?true:false);
	}

	public static function validateIp($value)
	{
		$regex ='/\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/';
		return (preg_match($regex, $value)) ? false : true;
	}

	/**
	 * __toString
	 * @desc render google.visualization.Query
	 * @return string
	 */
	public function __toString() {

		$string = '';

		# validate
		// set options for Query object as var
		if($this->properties instanceof Google_Property) {
			$string .= "var ";
			$string .= $this->dataTable.'Options';
			$string .= (string) $this->properties.";\n";
		}

		// @TODO replace by error response
//		if(!self::validateUrl($this->dataSourceUrl)) {
//			throw new InvalidArgumentException("expecting a string of type url. [$this->dataSourceUrl]");
//		}
//
//		if(strlen($this->data)<1) {
//			throw new LengthException("expecting a string with a length greater than 1.");
//		}

		$string .= 'var '.$this->dataTable.'DataSourceUrl="'.$this->dataSourceUrl.'";';
		$string .= "\n";
		$string .= ' var '.$this->dataTable.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;

		// setup method signature
		if($this->properties instanceof Google_Property) {
			$string .= '('.$this->dataTable.'DataSourceUrl, '.$this->dataTable.'Options);';
		} else {
			$string .= '('.$this->dataTable.'DataSourceUrl);';
		}
		$string .= "\n";

		// adding additional scope command
		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= ' '.$this->dataTable.'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		return $string;

	}
}
/**-------TS61521-0D2D-67CD-2F21-7898-3D4F-6CAB-31073--------*/
/**
 *
 * Google_Data_QueryResponse
 *
 * Represents a response of a query execution as received from the data source.
 * An instance of this class is passed as an argument to the callback function
 * that was set when Query.send was called.
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

*/
/**
 *
 * Google_Data_QueryResponse
 *
 * Represents a response of a query execution as received from the data source.
 * An instance of this class is passed as an argument to the callback function
 * that was set when Query.send was called.
 * {@example test_google_vis_using_the_query_language.php}
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

*/
class Google_Data_QueryResponse {

	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'QueryResponse';
	/**
	 * @var array $properties
	 */
	private $properties=null;
	/**
	 * @var string $dataTable
	 */
	private $dataTable='response';
	/**
	 * @var string $source
	 */
	private $source='';

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * getInstance
	 * @access public
	 * @var static
	 * @return Google_Data_QueryResponse
	 */
	public static function getInstance() {
		return new Google_Data_QueryResponse;
	}

	/**
	 * getDataTable
	 *
	 * @desc Returns the data table as returned by the data source. Returns null
	 * if the query execution failed and no data was returned.
	 */
	public function getDataTable() {
		$this->properties[__FUNCTION__][] = "";
		return $this->dataTable.'.'.__FUNCTION__.'()';
	}

	/**
	 * getDetailedMessage
	 *
	 * @desc Returns a detailed error message for queries that failed. If the query
	 * execution was successful, this method returns an empty string. The message
	 * returned is a message that is intended for developers, and may contain
	 * technical information, for example 'Column {salary} does not exist'.
	 */
	public function getDetailedMessage() {
		$this->properties[__FUNCTION__][] = "";
		return $this->dataTable.'.'.__FUNCTION__.'()';
	}

	/**
	 * getMessage
	 *
	 * @desc Returns a short error message for queries that failed. If the query
	 * execution was successful, this method returns an empty string. The message
	 * returned is a short message that is intended for end users, for example
	 * 'Invalid Query' or 'Access Denied'.
	 */
	public function getMessage() {
		$this->properties[__FUNCTION__][] = "";
		return $this->dataTable.'.'.__FUNCTION__.'()';
	}

	/**
	 * getReasons
	 *
	 * @desc Returns an array of zero of more entries. Each entry is a short string
	 * with an error or warning code that was raised while executing the query.
	 *
	 * Possible codes:
     * access_denied The user does not have permissions to access the data source.
     * invalid_query The specified query has a syntax error.
     * data_truncated One or more data rows that match the query selection were
	 * not returned due to output size limits. (warning).
     * timeout The query did not respond within the expected time.
	 */
	public function getReasons() {
		$this->properties[__FUNCTION__][] = "";
		return $this->dataTable.'.'.__FUNCTION__.'()';
	}

	/**
	 * hasWarning
	 *
	 * @desc Returns true if the query execution has any warning messages.
	 */
	public function hasWarning() {
		$this->properties[__FUNCTION__][] = "";
		return $this->dataTable.'.'.__FUNCTION__.'()';
	}

	/**
	 * isError
	 *
	 * @desc Returns true if the query execution failed, and the response does not
	 * contain any data table. Returns <false> if the query execution was
	 * successful and the response contains a data table.
	 */
	public function isError() {
		$this->properties[__FUNCTION__][] = "";
		return $this->dataTable.'.'.__FUNCTION__.'()';
	}

	/**
	 * asVar
	 * @desc inject a variable name for prefixing the output
	 * @param string $name
	 * @return void
	 */
	public function asVar($name) {
		$this->source = 'var '.$name.'=';
		return $this;
	}

	/**
	 * getResponse
	 * @return string name of data table
	 */
	public function getResponse() {
		return $this->dataTable;
	}

	/**
	 * render
	 * @desc returns QueryResponse without variable assignment
	 * @param bool $mode
	 * @return string
	 */
	public function render($mode=false) {
		$string = '';
		if($mode) {
			$string .= $this->source;
		}
		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= $this->dataTable.'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		return $string;
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {

		$string = 'var '.$this->dataTable.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '();';
		$string .= "\n";
		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= $this->dataTable.'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		$string .= "\n";
		return $string;
	}
}
/**-------TS61521-944A-C48D-D9D9-590D-65CB-7913-31073--------*/

/**
 * Google_Data_RowCell
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_RowCell
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_RowCell
{
	/**
	 * @var string $value
	 */
	protected $value;
	/**
	 * @var string $fvalue
	 */
	protected $fValue;
	/**
	 * @var string $type
	 */
	protected $type;

	/**
	 * constructor
	 * @param string $type
	 * @param string $value
	 * @param string $fValue formatting value expression
	 */
	public function __construct($type = null, $value = null, $fValue = null)
	{
		$this->value = null;
		$this->fValue = null;
		$this->type = null;
		$this->setValue($value);
		$this->setFormat($fValue);
		$this->setColumnType($type);
	}

	/**
	 * setValue
	 * @param mixed $value
	 * @return void
	 */
	public function setValue($value)
	{
		if ((isset ($value)) && (!is_null($value)))
			$this->value = $value;
	}

	/**
	 * setFormat
	 * @param string $fValue
	 * @return void
	 */
	public function setFormat($fValue)
	{
		if ((isset ($fValue)) && (!is_null($fValue)))
			$this->fValue = $fValue;
	}

	/**
	 * setColumnType
	 * @param value $type
	 * @return void
	 */
	public function setColumnType($type)
	{
		if ((isset ($type)) && (!is_null($type)))
			$this->type = $type;
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString()
	{
		if (is_null($this->value) && is_null($this->fValue)) {
			return "";
		}
		// values
		$strResult = "{v:";
		$strResult .= $this->type == "string" ? "'" : "";

		if ($this->value === true) {
			$strResult .= "true";
		} elseif ($this->value === false) {
			$strResult .= "false";
		} else {
			$strResult .= $this->value;
		}

		$strResult .= $this->type == "string" ? "'" : "";

		// format
		if ((isset ($this->fValue)) && (!is_null($this->fValue))) {
			$strResult .= ",f:'".$this->fValue."'";
		}
		$strResult .= "}";
		return $strResult;
	}
}

/**-------TS61521-9AE2-0373-F186-EBDC-2BBD-0ECA-31073--------*/

/**
 * Google_Data_Rows
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Data_Rows
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Data_Rows
{
	/**
	 * @var array $rows
	 */
	protected $rows = array ();

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * getInstance
	 * @var static
	 * @return Google_Data_Rows
	 */
	public static function getInstance() {
		return new Google_Data_Rows;
	}

	/**
	 * setCell
	 * @param string $type
	 * @param mixed $value
	 * @param string $fValue
	 */
	public function setCell($type, $value, $fValue)
	{
		if(is_string($type)) {
			switch($type) {
				case "string":
				case "number":
				case "date":
				case "time":
				case "datetime":
				case "bool":
					array_push($this->rows, new Google_Data_RowCell($type, $value, $fValue));
					break;
				default:
					$e = new Google_Exception_Data("Following type are supported: [string, number, date, time, datetime, bool]");
					$e->show();
					break;
			}
		} else {
			$e = new Google_Exception_Data("expecting a string.");
			$e->show();
		}
	}

	/**
	 * setEmptyCell
	 */
	public function setEmptyCell()
	{
		array_push($this->rows, new Google_Data_RowCell(null, null, null));
	}

	/**
	 * __toString
	 * @desc returns columnized rows
	 * @return string
	 */
	public function __toString()
	{
		$strResult = "{c:[";
		$boolRows = reset($this->rows);
		while ($boolRows !== FALSE)
		{
			$strResult .= $boolRows;
			$boolRows = next($this->rows);
			if ($boolRows !== FALSE)
				$strResult .= ",";
		}
		$strResult .= "]}";
		return $strResult;
	}
}

/**-------TS61521-E8B5-921B-22DF-7736-E7CD-325D-31073--------*/

/**
 * Google_Data_Table
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Represents a two-dimensional table of values. Every column has a single data type.
 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/reference.html#DataTable
 */
/**
 * Google_Data_Table
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Represents a two-dimensional table of values. Every column has a single data type.
 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/reference.html#DataTable
 */
class Google_Data_Table {

	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'DataTable';
	/**
	 * @var string $dataTable
	 */
	private $dataTable='data';

	private $properties=null;
	/**
	 * @var Google_Data_Rows $properties
	 */
	private $data;
	/**
	 * @var string $version
	 */
	private $version;
	/**
	 * @var Google_Data_Base|string $assigned_data
	 */
	private $assigned_data = null;

	/**
	 * constructor
	 * @param Google_Data_Rows $data
	 * @param string $version
	 */
	public function __construct($data = null, $version = null) {
		$this->data = $data;
		$this->version = $version;
	}

	/**
	 * addColumn
	 *
	 * @desc adds a new column to the data table, and returns the index of the
	 * new column. All the cells of the new column are assigned a null value.
     * type should be a string with the data type of the values of the column.
	 * The type can be one of the following:
	 * 'string' 'number' 'boolean' 'date' 'datetime' 'timeofday'.
     * label should be a string with the label of the column. The column label
	 * is typically displayed as part of the visualization, for example as a
	 * column header in a table, or as a legend label in a pie chart. If not
	 * value is specified, an empty string is assigned.
     * id should be a string with a unique identifier for the column. If not
	 * value is specified, an empty string is assigned.
	 *
	 * @param string $type
	 * @param string $label
	 * @param string $id
	 * @return void
	 */
	public function addColumn($type, $label=null, $id=null) {

		if($type) {
			$arr = array();
			switch($type) {
				case "string":
				case "number":
				case "boolean":
				case "date":
				case "datetime":
				case "timeofday":
					$arr[] = "'$type'";
					break;
			}
			if($label) {
				$arr[] = "'$label'";
			}
			if(!$label and $id) {
				$arr[] = "''";
				$arr[] = "'$id'";
			} elseif($label and $id) {
				$arr[] = "'$id'";
			}
			$this->properties[__FUNCTION__][] = $arr;
		}
	}

	/**
	 * addRows
	 * @desc Adds a new row to the data table, and returns the index of the new
	 * row. All the cells of the new row are assigned a null value.
	 * @return void
	 */
	public function addRow() {
		$this->properties[__FUNCTION__][] = '';
	}

	/**
	 * addRows
	 * @desc Adds new rows to the data table, and returns the index of the last
	 * added row.
     * numberOfRows is the number of rows to add. All the cells of the new rows
	 * are assigned a null value.
	 * @param integer $numberOfRows
	 * @return void
	 */
	public function addRows($numberOfRows) {
		$this->properties[__FUNCTION__][] = $numberOfRows;
	}

	public function clon() {
		$this->properties["clone"][] = '';
	}

	/**
	 * getColumnId
	 * @desc Returns the identifier of a given column specified by the column
	 * index in the underlying table.
	 * @param integer$columnIndex
	 * @return void
	 */
	public function getColumnId($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnLabel
	 * @desc Returns the label of a given column specified by the column index
	 * in the underlying table. The column label is typically displayed as part
	 * of the visualization. For example the column label can be displayed as a
	 * column header in a table, or as the legend label in a pie chart.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnLabel($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnPattern
	 * @desc Returns the formatting pattern used to format the values of the specified column.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnPattern($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified column.
	 * @param integer $columnIndex
	 * @param string $name
	 * @return void
	 */
	public function getColumnProperty($columnIndex, $name) {
		$this->properties[__FUNCTION__][] = $columnIndex.",".$name;
	}

	/**
	 * getColumnRange
	 * @desc Returns the minimal and maximal values of values in a specified column.
	 * The returned object has properties min and max. If the range has no values,
	 * min and max will contain null.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnRange($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnType
	 * @desc Returns the type of a given column specified by the column index.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnType($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getDistinctValues
	 * @desc Returns the unique values in a certain column, in ascending order.
	 * @param index $columnIndex
	 * @return void
	 */
	public function getDistinctValues($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getFilteredRows
	 * @desc Returns the row indexes for rows that match all of the given filters.
	 * The indexes are returned in ascending order.
     *
	 * filters an array of filter objects that describe an acceptable row. A row
	 * index is returned by this method if it matches all of the given filters.
	 * Each filter is an object with a numeric 'column' property that specifies
	 * the index of the column in the row to assess, and one of the following:
	 * o a 'value' property with a value that must be matched exactly by the
	 *   specified column in the row. It should be of the same type as the column;
	 *   or
	 * o both 'minValue' and 'maxValue' properties, where a row value matches the
	 *   filter if minValue <= row value <= maxValue. Both properties should be
	 *   of the same type as the column.
	 *
	 * @param array $filters
	 * @return void
	 */
	public function getFilteredRows(array $filters) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($filters);
	}

	/**
	 * getFormattedValue
	 * @desc Returns the formatted value of the cell at the given row and column indexes.
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getFormattedValue($rowIndex, $columnIndex) {
		$this->properties[__FUNCTION__][] = $rowIndex.",".$columnIndex;
	}

	/**
	 * getNumberOfColumns
	 * @desc Returns the number of columns in the table.
	 * @return void
	 */
	public function getNumberOfColumns() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getNumberOfRows
	 * @desc Returns the number of rows in the table.
	 * @return void
	 */
	public function getNumberOfRows() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified cell.
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $name
	 * @return void
	 */
	public function getProperty($rowIndex, $columnIndex, $name) {
		$this->properties[__FUNCTION__][] = implode(",",array($rowIndex, $columnIndex, $name));
	}

	/**
	 * getRowProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified row.
	 * @param integer $rowIndex
	 * @param string $name
	 * @return void
	 */
	public function getRowProperty($rowIndex, $name) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $name));
	}

	/**
	 * getSortedRows
	 * @desc Returns a sorted version of the table without modifying the order of
	 * the underlying data. To permanently sort the underlying data, call sort().
	 * You can specify sorting in a number of ways, depending on the type you pass
	 * in to the sortColumns parameter:
	 * @param array $sortColumns
	 * @return void
	 */
	public function getSortedRows($sortColumns) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($sortColumns);
	}

	/**
	 * getTableProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the table.
     * name is a string with the property name.
	 * @param string $name
	 * @return void
	 */
	public function getTableProperty($name) {
		$this->properties[__FUNCTION__][] = $name;
	}

	/**
	 * getValue
	 * @desc
	 * Returns the value of the cell at the given row and column indexes.
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
	 *
	 * The type of the returned value depends on the column type (see getColumnType):
     * If the column type is 'string', the value is a string.
     * If the column type is 'number', the value is a number.
     * If the column type is 'boolean', the value is a boolean.
     * If the column type is 'date' or 'datetime', the value is a Date object.
     * If the column type is 'timeofday', the value is an array of four numbers:
	 * [hour, minute, second, millisenconds].
     * If the column value is a null value, regardless of the column type, the returned value is null.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getValue($rowIndex, $columnIndex) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $columnIndex));
	}

	/**
	 * getTableColumnIndex
	 * @desc Returns the index in the underlying table (or view) of a given column
	 * specified by its index in this view. viewColumnIndex should be a number
	 * greater than or equal to zero, and less than the number of columns as
	 * returned by the getNumberOfColumns() method.
	 * @example If setColumns([3, 1, 4]) was previously called, then
	 * getTableColumnIndex(2) will return 4.
	 * @param integer $viewColumnIndex
	 * @return void
	 */
	public function getTableColumnIndex($viewColumnIndex) {
		$this->properties[__FUNCTION__][] = $viewColumnIndex;
	}

	/**
	 * getTableRowIndex
	 * @desc Returns the index in the underlying table (or view) of a given row
	 * specified by its index in this view. viewRowIndex should be a number
	 * greater than or equal to zero, and less than the number of rows as returned
	 * by the getNumberOfRows() method.
	 * If setRows([3, 1, 4]) was previously called, then
	 * getTableRowIndex(2) will return 4.
	 *
	 * @example
	 * @param integer $viewRowIndex
	 * @return void
	 */
	public function getTableRowIndex($viewRowIndex) {
		$this->properties[__FUNCTION__][] = $viewRowIndex;
	}

	/**
	 * getViewColumnIndex
	 * @desc Returns the index in this view that maps to a given column specified
	 * by its index in the underlying table (or view). If more than one such index
	 * exists, returns the first (smallest) one. If no such index exists (the
	 * specified column is not in the view), returns -1. tableColumnIndex should
	 * be a number greater than or equal to zero, and less than the number of
	 * columns as returned by the getNumberOfColumns() method of the underlying
	 * table/view.
	 * @example If setColumns([3, 1, 4]) was previously called, then
	 * getViewColumnIndex(4) will return 2.
	 * @param integer $tableColumnIndex
	 * @return void
	 */
	public function getViewColumnIndex($tableColumnIndex) {
		$this->properties[__FUNCTION__][] = $tableColumnIndex;
	}

	/**
	 * getViewRowIndex
	 * @desc Returns the index in this view that maps to a given row specified by
	 * its index in the underlying table (or view). If more than one such index
	 * exists, returns the first (smallest) one. If no such index exists (the
	 * specified row is not in the view), returns -1. tableRowIndex should be a
	 * number greater than or equal to zero, and less than the number of rows as
	 * returned by the getNumberOfRows() method of the underlying table/view.
	 * @example If setRows([3, 1, 4]) was previously called, then getViewRowIndex(4)
	 * will return 2.
	 * @param integer $tableRowIndex
	 * @return void
	 */
	public function getViewRowIndex($tableRowIndex) {
		$this->properties[__FUNCTION__][] = $tableRowIndex;
	}

	/**
	 * hideColumns
	 * @desc Hides the specified columns from the current view. columnIndexes is
	 * an array of numbers representing the indexes of the columns to hide. These
	 * indexes are the index numbers in the underlying table/view. The numbers in
	 * columnIndexes do not have to be in order (that is, [3,4,1] is fine). The
	 * remaining columns retain their index order when you iterate through them.
	 * Entering an index number for a column already hidden is not an error, but
	 * entering an index that does not exist in the underlying table/view will
	 * throw an error. To unhide columns, call setColumns().
	 * @example If you have a table with 10 columns, and you call setColumns([2,7,1,7,9]),
	 * and then hideColumns([7,9]), the columns in the view will then be [2,1].
	 * @param array $columnIndexes
	 * @return void
	 */
	public function hideColumns($columnIndexes=null) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($columnIndexes);
	}

	/**
	 * getViewColumns
	 * @desc Returns the columns in this view, in order. That is, if you call
	 * setColumns with some array, and then call getViewColumns() you should get
	 * an identical array.
	 * @return void
	 */
	public function getViewColumns() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getViewRows
	 * @desc Returns the rows in this view, in order. That is, if you call
	 * setRows with some array, and then call getViewRows() you should get an
	 * identical array.
	 * @return void
	 */
	public function getViewRows() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * hideRows
	 * @desc Hides the specified rows from the current view. rowIndexes is an
	 * array of numbers representing the indexes of the rows to hide. These
	 * indexes are the index numbers in the underlying table/view. The numbers
	 * in rowIndexes do not have to be in order (that is, [3,4,1] is fine). The
	 * remaining rows retain their index order. Entering an index number for a
	 * row already hidden is not an error, but entering an index that does not
	 * exist in the underlying table/view will throw an error. To unhide rows,
	 * call setRows().
	 * @example If you have a table with 10 rows, and you call setRows([2,7,1,7,9]),
	 * and then hideRows([7,9]), the rows in the view will then be [2,1].
	 * @param array $rowIndexes
	 * @return void
	 */
	public function hideRows($rowIndexes = null) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($rowIndexes);
	}

	/**
	 * insertColumn
	 * @desc Inserts a new column to the data table, at the specifid index. All
	 * existing columns at or after the specified index are shifted to a higher
	 * index.
	 *
     * columnIndex is a number with the required index of the new column.
     * type should be a string with the data type of the values of the column.
	 * The type can be one of the following:
	 * 'string' 'number' 'boolean' 'date' 'datetime' 'timeofday'.
     * label should be a string with the label of the column. The column label
	 * is typically displayed as part of the visualization, for example as a
	 * column header in a table, or as a legend label in a pie chart. If no
	 * value is specified, an empty string is assigned.
     * id should be a string with a unique identifier for the column. If no
	 * value is specified, an empty string is assigned.
	 *
	 * @param integer $columnIndex
	 * @param string $type
	 * @param string $label
	 * @param string $id
	 * @return void
	 */
	public function insertColumn($columnIndex, $type, $label=null, $id=null) {
		$arr = array();
		$arr[] = $columnIndex;
		if($type) {
			switch($type) {
				case "string":
				case "number":
				case "boolean":
				case "date":
				case "datetime":
				case "timeofday":
					$arr[] = "'$type'";
					break;
			}
			if($label) {
				$arr[] = "'$label'";
			}
			if(!$label and $id) {
				$arr[] = "''";
				$arr[] = "'$id'";
			} elseif($label and $id) {
				$arr[] = "'$id'";
			}
			$this->properties[__FUNCTION__][] = $arr;
		}
	}

	/**
	 * insertRows
	 * @desc Insert the specified number of rows at the specified row index.
     * rowIndex is a number with the required index of the first new row.
	 * @param <type> $rowIndex
	 * @param <type> $numberOfRows
	 * @return void
	 */
	public function insertRows($rowIndex, $numberOfRows) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $numberOfRows));
	}

	/**
	 * removeColumn
	 * @desc Removes the column at the specified index.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function removeColumn($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * removeColumns
	 * @desc Removes the specified number of columns starting from the column
	 * at the specified index.
	 * @param integer $columnIndex is the number of columns to remove.
	 * @param integer $numberOfColumns should be a number with a valid column index.
	 * @return void
	 */
	public function removeColumns($columnIndex, $numberOfColumns) {
		$this->properties[__FUNCTION__][] = implode(",", array($columnIndex, $numberOfColumns));
	}

	/**
	 * removeRow
	 * @desc Removes the row at the specified index.
	 * @param integer $rowIndex
	 * @return void
	 */
	public function removeRow($rowIndex) {
		$this->properties[__FUNCTION__][] = $rowIndex;
	}

	/**
	 * removeRows
	 * @desc Removes the specified number of rows starting from the row
	 * at the specified index.
	 * @param integer $rowsIndex is the number of rows to remove.
	 * @param integer $numberOfRows should be a number with a valid row index.
	 * @return void
	 */
	public function removeRows($rowIndex, $numberOfRows) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $numberOfRows));
	}

	/**
	 * setCell
	 *
	 * @desc Sets the value, and optionally the formatted value and properties,
	 * of a cell. To simply change the cell value, use setValue
	 * # rowIndex should be a number greater than or equal to zero, and less
	 *   than the number of rows as returned by the getNumberOfRows() method.
	 * # columnIndex should be a number greater than or equal to zero, and less
	 *   than the number of columns as returned by the getNumberOfColumns()
	 *   method.
	 * # value is the value assigned to the specified cell. The type of the
	 *   returned value depends on the column type (see getColumnType):
     *   - If the column type is 'string', the value should be a string.
     *   - If the column type is 'number', the value should be a number.
     *   - If the column type is 'boolean', the value should be a boolean.
     *   - If the column type is 'date' or 'datetime', the value should be a Date object.
     *   - If the column type is 'timeofday', the value should be an array of
	 *     four numbers: [hour, minute, second, millisenconds].
     *     For any column type, the value can be set to null.
	 * # formattedValue is a string with the value formatted as a string. If null
	 *   is specified, or if this parameter is omitted, the default formatting
	 *   will be applied. The formatted value is typically used by visualizations
	 *   to display value labels. For example the formatted value can appear as a
	 *   label text within a pie chart.
	 * # properties is an optional Object (name/value map) with additional properties
	 *   for this cell. If null is specified, or if this parameter is omitted, no
	 *   additional properties are assigned to this cell. Some visualizations support
	 *   row, column, or cell properties to modify their display or behavior;
	 *   see the visualization documentation to see what properties are supported
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $value
	 * @param string $formattedValue
	 * @param stdClass $properties
	 * @return void
	 */
	public function setCell($rowIndex, $columnIndex, $value, $formattedValue=null, $properties=null) {

		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = $value;

		if($formattedValue) {
			$arr[] = $formattedValue;
		}
		if($properties instanceof stdClass) {
			$arr[] = Google_Base::toJSON($properties);
		}
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setColumnLabel
	 *
	 * @desc Sets the label of a column.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
     * label is a string with the label to assign to the column. The column label
	 * is typically displayed as part of the visualization. For example the column
	 * label can be displayed as a column header in a table, or as the legend
	 * label in a pie chart.
	 *
	 * @param integer $columnIndex
	 * @param string $label
	 * @return void
	 */
	public function setColumnLabel($columnIndex, $label) {
		$this->properties[__FUNCTION__][] = $columnIndex . ",'".$label."'";
	}

	/**
	 * setColumnProperty
	 *
	 * @desc Sets a single column property. Some visualizations support row,
	 * column, or cell properties to modify their display or behavior; see the
	 * visualization documentation to see what properties are supported.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
     * name is a string with the property name.
     * value is a value of any type to assign to the specified named property of
	 * the specified column.
	 *
	 * @param integer $columnIndex
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function setColumnProperty($columnIndex, $name, $value) {
		$arr = array();
		$arr[] = $columnIndex;
		$arr[] = "'". $name . "'";

		$t = gettype($value);
		switch($t) {
			case 'bool':
				$arr[] = true===$value?'true':'false';
				break;
			case 'array':
			case 'object':
				$arr[] = Google_Base::toJSON($value);
				break;
			default:
				$arr[] = $value;
				break;
		}

		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setColumnProperties
	 *
	 * @desc Sets multiple column properties. Some visualizations support row,
	 * column, or cell properties to modify their display or behavior;
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
     * properties is an Object (name/value map) with additional properties for
	 * this column. If null is specified, all additional properties of the
	 * column will be removed.
	 *
	 * @param integer $columnIndex
	 * @param stdClass $properties
	 * @return void
	 */
	public function setColumnProperties($columnIndex, $properties) {
		$arr = array();
		$arr[] = $columnIndex;
		$arr[] = Google_Base::toJSON($value);
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setFormattedValue
	 *
	 * @desc Sets the formatted value of a cell.
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
     * formattedValue is a string with the value formatted for display.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $formattedValue
	 * @return void
	 */
	public function setFormattedValue($rowIndex, $columnIndex, $formattedValue) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = "'". $formattedValue."'";
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setProperty
	 *
	 * @desc Sets a cell property. Some visualizations support row, column, or
	 * cell properties to modify their display or behavior;
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less than
	 * the number of columns as returned by the getNumberOfColumns() method.
     * name is a string with the property name.
     * value is a value of any type to assign to the specified named property of
	 * the specified cell.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $name
	 * @param string $value
	 * @return void
	 */
	public function setProperty($rowIndex, $columnIndex, $name, $value) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = "'".$name."'";
		$arr[] = $value; // @TODO recognition of data type

		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setProperties
	 *
	 * @desc Sets multiple cell properties. Some visualizations support row, column,
	 * or cell properties to modify their display or behavior;
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less than
	 * the number of columns as returned by the getNumberOfColumns() method.
     * properties is an Object (name/value map) with additional properties for
	 * this cell. If null is specified, all additional properties of the cell
	 * will be removed.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param stdClass $properties
	 * @return void
	 */
	public function setProperties($rowIndex, $columnIndex, $properties) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = Google_Base::toJSON($properties);
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setRowProperty
	 *
	 * @desc Sets a row property. Some visualizations support row, column, or
	 * cell properties to modify their display or behavior;
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * name is a string with the property name.
     * value is a value of any type to assign to the specified named property of
	 * the specified row.
	 *
	 * @param integer $rowIndex
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function setRowProperty($rowIndex, $name, $value) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = "'".$name."'";
		$arr[] = $value; // @TODO recognition of data type

		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setRowProperties
	 *
	 * @desc Sets multiple row properties. Some visualizations support row,
	 * column, or cell properties to modify their display or behavior;
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * properties is an Object (name/value map) with additional properties for
	 * this row. If null is specified, all additional properties of the row will
	 * be removed.
	 *
	 * @param integer $rowIndex
	 * @param stdClass $properties
	 * @return void
	 */
	public function setRowProperties($rowIndex, $properties) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = Google_Base::toJSON($properties);
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setTableProperty
	 *
	 * @desc Sets a single table property. Some visualizations support table,
	 * row, column, or cell properties to modify their display or behavior;
     * name is a string with the property name.
     * value is a value of any type to assign to the specified named property of the table.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function setTableProperty($name, $value) {
		$arr = array();
		$arr[] = "'".$name."'";
		$arr[] = $value; // @TODO recognition of data type
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setTableProperties
	 *
	 * @desc Sets multiple table table. Some visualizations support table, row,
	 * column, or cell properties to modify their display or behavior;
	 *
     * properties is an Object (name/value map) with additional properties for
	 * the table. If null is specified, all additional properties of the table will be removed.
	 *
	 * @param stdClass $properties
	 * @return void
	 */
	public function setTableProperties($properties) {
		$arr = array();
		$arr[] = Google_Base::toJSON($properties);
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * setValue
	 *
	 * @desc Sets the value of a cell. In addition to overwriting any existing
	 * cell value, this method will also clear out any formatted value and
	 * properties for the cell.
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
	 * This method does not let you set a formatted value for this cell;
	 * to do that, call setFormattedValue().
     * value is the value assigned to the specified cell. The type of the returned
	 * value depends on the column type (see getColumnType):
     *     o If the column type is 'string', the value should be a string.
     *     o If the column type is 'number', the value should be a number.
     *     o If the column type is 'boolean', the value should be a boolean.
     *     o If the column type is 'date' or 'datetime', the value should be a
	 *       Date object.
     *     o If the column type is 'timeofday', the value should be an array of
	 *       four numbers: [hour, minute, second, millisenconds].
     *     o For any column type, the value can be set to null.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param mixed $value
	 * @return void
	 */
	public function setValue($rowIndex, $columnIndex, $value) {
		$arr = array();
		$arr[] = $rowIndex;
		$arr[] = $columnIndex;
		$arr[] = $value; // @TODO recognition of data type
		$this->properties[__FUNCTION__][] = $arr;
	}

	/**
	 * sort
	 *
	 * @desc Sorts the rows, according to the specified sort columns.
	 * The DataTable is modified by this method. See getSortedRows() for a
	 * description of the sorting details. This method does not return the
	 * sorted data.
	 * @see getSortedRows
	 * @example To sort by the third column and then by the second column,
	 * @uses data.sort([{column: 2}, {column: 1}]);
	 *
	 * @param array $sortColumns
	 * @return void
	 */
	public function sort(array $sortColumns) {
		$this->properties[__FUNCTION__][] = Google_Base::toJSON($sortColumns);
	}

	/**
	 * custom function
	 */
	/**
	 * assignData
	 * @param Google_Data_Base $data
	 * @return void
	 */
	public function assignData(Google_Data_Base $data) {
		$this->assigned_data = $data;
	}

	/**
	 * setDataTable
	 * @desc change the javascript variable name of the data table
	 * @param string $name
	 * @return void
	 */
	public function setDataTable($name) {
		$this->dataTable = (string)$name;
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		$string = '';
		if($this->assigned_data instanceof Google_Data_Base) {
			$this->data = $this->assigned_data->getName();
			$string .= 'var '.$this->data.'='.$this->assigned_data->getData().";\n";
		}

		$string .= 'var '.$this->dataTable.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '(';
		if($this->data) $string .= $this->data;
		if($this->version) $string .= ','.$this->version;
		$string .= ')';
		$string .= ";\n";

		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= $this->dataTable.'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		$string .= "\n";
		return $string;

	}
}

/**-------TS61521-088A-593A-4DEB-F523-30CE-D564-31073--------*/

/**
 *
 * Google_Data_View
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 *
 * @desc
 * A read-only view of an underlying DataTable. A DataView allows selection of
 * only a subset of the columns and/or rows. It also allows reordering columns/rows,
 * and duplicating columns/rows.
 *
 * A view does not copy the data or meta-data of the underlying table. Every
 * change to the values in the underlying table is immediately reflected in the
 * view. Note the following:
 *
 * Adding/inserting/removing columns to the underlying table is not reflected in
 * the view, and might cause unexpected behavior in the view.
 * Adding/inserting/removing rows to the underlying table is only safe to use
 * and reflected in the view if none of the functions changing the rows-part of
 * the view were called (hideRows, setRows).
 * Changing values in existing rows/columns in the underlying table is always
 * immediately reflected in the view.
 * It is also possible to create a DataView on an underlying DataView. Note that
 * whenever an underlying table or view is mentioned, it refers to the level
 * immediately below this level. In other words, it refers to the data object
 * used to construct this DataView.
 *
 */
/**
 *
 * Google_Data_View
 *
 * @package Google
 * @subpackage Google_Data
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 *
 * @desc
 * A read-only view of an underlying DataTable. A DataView allows selection of
 * only a subset of the columns and/or rows. It also allows reordering columns/rows,
 * and duplicating columns/rows.
 *
 * A view does not copy the data or meta-data of the underlying table. Every
 * change to the values in the underlying table is immediately reflected in the
 * view. Note the following:
 *
 * Adding/inserting/removing columns to the underlying table is not reflected in
 * the view, and might cause unexpected behavior in the view.
 * Adding/inserting/removing rows to the underlying table is only safe to use
 * and reflected in the view if none of the functions changing the rows-part of
 * the view were called (hideRows, setRows).
 * Changing values in existing rows/columns in the underlying table is always
 * immediately reflected in the view.
 * It is also possible to create a DataView on an underlying DataView. Note that
 * whenever an underlying table or view is mentioned, it refers to the level
 * immediately below this level. In other words, it refers to the data object
 * used to construct this DataView.
 *
 */
class Google_Data_View {

	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'DataView';
	/**
	 * @var array $properties
	 */
	private $properties=null;
	/**
	 * @var string $dataTable
	 */
	private $dataTable='data';
	/**
	 * @var string $viewTable
	 */
	private $viewTable='dataView';

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * getInstance
	 * @var static
	 * @return Google_Data_View
	 */
	public static function getInstance() {
		return new Google_Data_View;
	}

	/**
	 * returns view table name
	 * @return string
	 */
	public function getViewTable(){
		return $this->viewTable;
	}

	/**
	 * setViewTable
	 * @param string $viewTable
	 * @return void
	 */
	public function setViewTable($viewTable) {
		$this->viewTable = $viewTable;
	}

	/**
	 * setDataTable
	 * @param string $dataTable
	 * @return void
	 */
	public function setDataTable($dataTable) {
		$this->dataTable = $dataTable;
	}

	/**
	 * getColumnId
	 * @desc Returns the identifier of a given column specified by the column
	 * index in the underlying table.
	 * @param integer$columnIndex
	 * @return void
	 */
	public function getColumnId($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnLabel
	 * @desc Returns the label of a given column specified by the column index
	 * in the underlying table. The column label is typically displayed as part
	 * of the visualization. For example the column label can be displayed as a
	 * column header in a table, or as the legend label in a pie chart.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnLabel($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnPattern
	 * @desc Returns the formatting pattern used to format the values of the specified column.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnPattern($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified column.
	 * @param integer $columnIndex
	 * @param string $name
	 * @return void
	 */
	public function getColumnProperty($columnIndex, $name) {
		$this->properties[__FUNCTION__][] = $columnIndex.",".$name;
	}

	/**
	 * getColumnRange
	 * @desc Returns the minimal and maximal values of values in a specified column.
	 * The returned object has properties min and max. If the range has no values,
	 * min and max will contain null.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnRange($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getColumnType
	 * @desc Returns the type of a given column specified by the column index.
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getColumnType($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getDistinctValues
	 * @desc Returns the unique values in a certain column, in ascending order.
	 * @param index $columnIndex
	 * @return void
	 */
	public function getDistinctValues($columnIndex) {
		$this->properties[__FUNCTION__][] = $columnIndex;
	}

	/**
	 * getFilteredRows
	 * @desc Returns the row indexes for rows that match all of the given filters.
	 * The indexes are returned in ascending order.
     *
	 * filters an array of filter objects that describe an acceptable row. A row
	 * index is returned by this method if it matches all of the given filters.
	 * Each filter is an object with a numeric 'column' property that specifies
	 * the index of the column in the row to assess, and one of the following:
	 * o a 'value' property with a value that must be matched exactly by the
	 *   specified column in the row. It should be of the same type as the column;
	 *   or
	 * o both 'minValue' and 'maxValue' properties, where a row value matches the
	 *   filter if minValue <= row value <= maxValue. Both properties should be
	 *   of the same type as the column.
	 *
	 * @param array $filters
	 * @return void
	 */
	public function getFilteredRows(array $filters) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($filters);
	}

	/**
	 * getFormattedValue
	 * @desc Returns the formatted value of the cell at the given row and column indexes.
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getFormattedValue($rowIndex, $columnIndex) {
		$this->properties[__FUNCTION__][] = $rowIndex.",".$columnIndex;
	}

	/**
	 * getNumberOfColumns
	 * @desc Returns the number of columns in the table.
	 */
	public function getNumberOfColumns() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getNumberOfRows
	 * @desc Returns the number of rows in the table.
	 * @return void
	 */
	public function getNumberOfRows() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified cell.
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @param string $name
	 * @return void
	 */
	public function getProperty($rowIndex, $columnIndex, $name) {
		$this->properties[__FUNCTION__][] = implode(",",array($rowIndex, $columnIndex, $name));
	}

	/**
	 * getRowProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the specified row.
	 * @param integer $rowIndex
	 * @param string $name
	 * @return void
	 */
	public function getRowProperty($rowIndex, $name) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $name));
	}

	/**
	 * getSortedRows
	 * @desc Returns a sorted version of the table without modifying the order of
	 * the underlying data. To permanently sort the underlying data, call sort().
	 * You can specify sorting in a number of ways, depending on the type you pass
	 * in to the sortColumns parameter:
	 * @param array $sortColumns
	 * @return void
	 */
	public function getSortedRows($sortColumns) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($sortColumns);
	}

	/**
	 * getTableProperty
	 * @desc Returns the value of a named property, or null if no such property
	 * is set for the table.
     * name is a string with the property name.
	 * @param string $name
	 * @return void
	 */
	public function getTableProperty($name) {
		$this->properties[__FUNCTION__][] = $name;
	}

	/**
	 * getValue
	 * @desc
	 * Returns the value of the cell at the given row and column indexes.
	 *
     * rowIndex should be a number greater than or equal to zero, and less than
	 * the number of rows as returned by the getNumberOfRows() method.
     * columnIndex should be a number greater than or equal to zero, and less
	 * than the number of columns as returned by the getNumberOfColumns() method.
	 *
	 * The type of the returned value depends on the column type (see getColumnType):
     * If the column type is 'string', the value is a string.
     * If the column type is 'number', the value is a number.
     * If the column type is 'boolean', the value is a boolean.
     * If the column type is 'date' or 'datetime', the value is a Date object.
     * If the column type is 'timeofday', the value is an array of four numbers:
	 * [hour, minute, second, millisenconds].
     * If the column value is a null value, regardless of the column type, the returned value is null.
	 *
	 * @param integer $rowIndex
	 * @param integer $columnIndex
	 * @return void
	 */
	public function getValue($rowIndex, $columnIndex) {
		$this->properties[__FUNCTION__][] = implode(",", array($rowIndex, $columnIndex));
	}

	/**
	 * getTableColumnIndex
	 * @desc Returns the index in the underlying table (or view) of a given column
	 * specified by its index in this view. viewColumnIndex should be a number
	 * greater than or equal to zero, and less than the number of columns as
	 * returned by the getNumberOfColumns() method.
	 * @example If setColumns([3, 1, 4]) was previously called, then
	 * getTableColumnIndex(2) will return 4.
	 * @param integer $viewColumnIndex
	 * @return void
	 */
	public function getTableColumnIndex($viewColumnIndex) {
		$this->properties[__FUNCTION__][] = $viewColumnIndex;
	}

	/**
	 * getTableRowIndex
	 * @desc Returns the index in the underlying table (or view) of a given row
	 * specified by its index in this view. viewRowIndex should be a number
	 * greater than or equal to zero, and less than the number of rows as returned
	 * by the getNumberOfRows() method.
	 * @example If setRows([3, 1, 4]) was previously called, then
	 * getTableRowIndex(2) will return 4.
	 * @param integer $viewRowIndex
	 * @return void
	 */
	public function getTableRowIndex($viewRowIndex) {
		$this->properties[__FUNCTION__][] = $viewRowIndex;
	}

	/**
	 * getViewColumnIndex
	 * @desc Returns the index in this view that maps to a given column specified
	 * by its index in the underlying table (or view). If more than one such index
	 * exists, returns the first (smallest) one. If no such index exists (the
	 * specified column is not in the view), returns -1. tableColumnIndex should
	 * be a number greater than or equal to zero, and less than the number of
	 * columns as returned by the getNumberOfColumns() method of the underlying
	 * table/view.
	 * @example If setColumns([3, 1, 4]) was previously called, then
	 * getViewColumnIndex(4) will return 2.
	 * @param integer $tableColumnIndex
	 * @return void
	 */
	public function getViewColumnIndex($tableColumnIndex) {
		$this->properties[__FUNCTION__][] = $tableColumnIndex;
	}

	/**
	 * getViewRowIndex
	 * @desc Returns the index in this view that maps to a given row specified by
	 * its index in the underlying table (or view). If more than one such index
	 * exists, returns the first (smallest) one. If no such index exists (the
	 * specified row is not in the view), returns -1. tableRowIndex should be a
	 * number greater than or equal to zero, and less than the number of rows as
	 * returned by the getNumberOfRows() method of the underlying table/view.
	 * @example If setRows([3, 1, 4]) was previously called, then getViewRowIndex(4)
	 * will return 2.
	 * @param integer $tableRowIndex
	 * @return void
	 */
	public function getViewRowIndex($tableRowIndex) {
		$this->properties[__FUNCTION__][] = $tableRowIndex;
	}

	/**
	 * hideColumns
	 * @desc Hides the specified columns from the current view. columnIndexes is
	 * an array of numbers representing the indexes of the columns to hide. These
	 * indexes are the index numbers in the underlying table/view. The numbers in
	 * columnIndexes do not have to be in order (that is, [3,4,1] is fine). The
	 * remaining columns retain their index order when you iterate through them.
	 * Entering an index number for a column already hidden is not an error, but
	 * entering an index that does not exist in the underlying table/view will
	 * throw an error. To unhide columns, call setColumns().
	 * @example If you have a table with 10 columns, and you call setColumns([2,7,1,7,9]),
	 * and then hideColumns([7,9]), the columns in the view will then be [2,1].
	 * @param array $columnIndexes
	 * @return void
	 */
	public function hideColumns($columnIndexes=null) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($columnIndexes);
	}

	/**
	 * getViewColumns
	 * @desc Returns the columns in this view, in order. That is, if you call
	 * setColumns with some array, and then call getViewColumns() you should get
	 * an identical array.
	 * @return void
	 */
	public function getViewColumns() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * getViewRows
	 * @desc Returns the rows in this view, in order. That is, if you call
	 * setRows with some array, and then call getViewRows() you should get an
	 * identical array.
	 * @return void
	 */
	public function getViewRows() {
		$this->properties[__FUNCTION__][] = "";
	}

	/**
	 * hideRows
	 * @desc Hides the specified rows from the current view. rowIndexes is an
	 * array of numbers representing the indexes of the rows to hide. These
	 * indexes are the index numbers in the underlying table/view. The numbers
	 * in rowIndexes do not have to be in order (that is, [3,4,1] is fine). The
	 * remaining rows retain their index order. Entering an index number for a
	 * row already hidden is not an error, but entering an index that does not
	 * exist in the underlying table/view will throw an error. To unhide rows,
	 * call setRows().
	 * @example If you have a table with 10 rows, and you call setRows([2,7,1,7,9]),
	 * and then hideRows([7,9]), the rows in the view will then be [2,1].
	 * @param array $rowIndexes
	 * @return void
	 */
	public function hideRows($rowIndexes = null) {
		$this->properties[__FUNCTION__][] = Google_Base::toJson($rowIndexes);
	}

	/**
	 * setColumns
	 * @desc Sets the columns in this view based on indexes from the underlying
	 * table/view. columnIndexes should be an array of numbers, greater than or
	 * equal to zero, and less than the number of columns as returned by the
	 * getNumberOfColumns() method of the underlying table/view. The specified
	 * column indexes are the indexes in the underlying table/view, which will
	 * be in the view, in the specified order. Note that only  the columns
	 * specified in columnIndexes will be shown; this method clears all other
	 * columns from the view. The array can also contain duplicates, effectively
	 * duplicating the specified column in this view (for example, setColumns([3, 4, 3, 2])
	 * will cause column 3 to appear twice in the view). The array thus provides
	 * a mapping of the columns from the underlying table/view to this view.
	 * @example To create a view with column three and zero of an underlying
	 * table/view: view.setColumns([3, 0])
	 * @param array|int $columnIndexes
	 * @param int $max
	 * @return void
	 */
	public function setColumns($columnIndexes, $max=null) {
		if(is_integer($max) and is_integer($columnIndexes)) {
			$this->properties[__FUNCTION__][] = Google_Base::toJson(array($columnIndexes, $max));
		} else {
			$this->properties[__FUNCTION__][] = Google_Base::toJson($columnIndexes);
		}
	}

	/**
	 * setRows
	 * @desc Sets the rows in this view based on indexes from the underlying
	 * table/view. rowIndexes should be an array of numbers, greater than or
	 * equal to zero, and less than the number of rows as returned by the
	 * getNumberOfRows() method of the underlying table/view. The specified row
	 * indexes are the indexes in the underlying table/view, which will be in
	 * the view, in the specified order. Note that only  the rows specified in
	 * rowIndexes will bw shown; this method clears all other rows from the view.
	 * The array can also contain duplicates, effectively duplicating the specified
	 * row in this view (for example, setRows([3, 4, 3, 2]) will cause row 3 to
	 * appear twice in this view). The array thus provides a mapping of the rows
	 * from the underlying table/view to this view.
	 * @example To create a view with rows three and zero of an underlying
	 * table/view: view.setRows([3, 0])
	 * @param array|int $rowIndexes
	 * @param int $max
	 * @return void
	 */
	public function setRows($rowIndexes, $max=null) {
		if(is_integer($max) and is_integer($rowIndexes)) {
			$this->properties[__FUNCTION__][] = '['.$rowIndexes.','.$max.']';
		} else {
			$this->properties[__FUNCTION__][] = Google_Base::toJson($rowIndexes);
		}
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		$string = 'var '.$this->viewTable.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '('. $this->dataTable.');';
		$string .= "\n";
		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= $this->viewTable .'.'.$method.'('.(is_array($signature)?implode(',',$signature):$signature).');'."\n";
				}
			}
		}
		$string .= "\n";
		return $string;
	}

}

/**-------TS61521-F689-F2C9-47BD-9B5C-7D66-551F-31073--------*/

/**
 * Google_Data
 * @desc Class to create a data object with rows and columns.
 * In default mode a data object is composed by various methods. The extended
 * mode allows to build data object directly from result sets.
 *
 * {@example test_google_data.php}
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
 */
/**
 * Google_Data
 * @desc Class to create a data object with rows and columns.
 * In default mode a data object is composed by various methods. The extended
 * mode allows to build data object directly from result sets.
 *
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
 */
class Google_Data {

	/**
	 * @var Google_Data_Base $data
	 */
	private $data;

	/**
	 * constructor
	 * @param string $type
	 */
	public function __construct($type=null) {
		switch($type){
			case "ext":
			case "extended":
				$this->data = new Google_Data_Extend();
				break;
			default:
				$this->data = new Google_Data_Base();
				break;
		}
	}

	/**
	 * getInstance
	 * @param string $type ext|NULL
	 * @return Google_Data
	 */
	public function getInstance($type=null) {
		return new Google_Data($type);
	}

	/**
	 * getData
	 * @return string
	 */
	public function getData(){
		/** @var $data Google_Data_Base */
		return $this->data->getData();
	}

	/**
	 * @desc returns a Google_Data object
	 * @return Google_Data
	 */
	public function getDataObject(){
		return $this->data;
	}

	/**
	 * init
	 * @access private
	 * @return void
	 */
	private function init() {
		$this->data->init();
	}

}
/**-------TS61521-F5AA-8928-D971-1B9A-1979-C9E5-31073--------*/

/**
 *
 * Google_Error
 *
 * @desc
 * The API provides several functions to help you display nicely-formatted error
 * messages to your users. To use these functions, provide a container element
 * on the page (typically a <div>), into which the API will draw a formatted error
 * message. This container can be either the visualization container element, or
 * a container just for errors. If you specify the visualization container element,
 * the error message will be displayed above the visualization. Then call the
 * appropriate function below to show, or remove, the error message. All functions
 * are static functions in the namespace google.visualization.errors.
 *
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
*/
/**
 *
 * Google_Error
 *
 * @desc
 * The API provides several functions to help you display nicely-formatted error
 * messages to your users. To use these functions, provide a container element
 * on the page (typically a <div>), into which the API will draw a formatted error
 * message. This container can be either the visualization container element, or
 * a container just for errors. If you specify the visualization container element,
 * the error message will be displayed above the visualization. Then call the
 * appropriate function below to show, or remove, the error message. All functions
 * are static functions in the namespace google.visualization.errors.
 *
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
*/
class Google_Error {
	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $errors
	 */
	private $type = 'errors';
	/**
	 * @var string $signature
	 */
	private $signature=null;
	/**
	 * @var integer $numOfArgs
	 */
	private $numOfArg = 0;

	public function __construct() {}

	/**
	 * @desc enabling fluent design
	 * @return Google_Error
	 */
	public static function getInstance() {
		return new Google_Error;
	}

	/**
	 * addError
	 * @desc Adds an error display block to the specified page element, with
	 * specified text and formatting.
	 *
	 * <b>container</b> - The DOM element into which to insert the error message.
	 * If the container cannot be found, the function will throw a JavaScript
	 * error.<br/><br/>
	 * <b>message</b> - A string message to display.<br/><br/>
	 * <b>opt_detailedMessage</b> - An optional detailed message string. By
	 * default, this is mouseover text, but that can be changed in the
	 * opt_options.showInToolTip property described below.<br/><br/>
	 * <b>opt_options</b> - An optional object with properties that set various
	 * display options for the message. The following options are supported:<br/>
	 * <b>showInTooltip</b> - A boolean value where true shows the detailed
	 * message only as tooltip text, and false shows the detailed message in the
	 * container body after the short message. Default value is true.<br/>
	 * <b>type</b> - A string describing the error type, which determines which
	 * css styles should be applied to this message. The supported values are
	 * 'error' and 'warning'. Default value is 'error'.<br/>
	 * <b>style</b> - A style string for the error message. This style will
	 * override any styles applied to the warning type (opt_options.type).
	 * Example: 'background-color: #33ff99; padding: 2px;' Default value is an
	 * empty string.<br/>
	 * <b>removable</b> - A boolean value, where true means that the message can
	 * be closed by a mouse click from the user. Default value is false.
	 *
	 * @param Google_Container $container
	 * @param Google_Type_String $message
	 * @param Google_Type_String $opt_detailedMessage
	 * @param Google_Properties $opt_options
	 * @return string String ID value that identifies the error object created.
	 * This is a unique value on the page, and can be used to remove the error
	 * or find its containing element.
	 */
	public function addError($container, $message, $opt_detailedMessage=null, $opt_options=null) {

		$this->numOfArg = 2;
		$signature = array();
		if(!$container instanceof Google_Container) {
			throw new InvalidArgumentException("expecting an instance of Google_Container");
		}
		$signature[] = $container->getErrorContainer();

		if(!$message instanceof Google_Type_String) {
			throw new InvalidArgumentException("expecting an instance of Google_Type_String");
		}
		$signature[] = $message;

		if(!empty($opt_detailedMessage) and !$event_args instanceof Google_Type_String) {
			throw new InvalidArgumentException("expecting an instance of Google_Type_String");
		}elseif(!empty($opt_detailedMessage)) {
			$signature[] = $opt_detailedMessage;
		}

		if(!empty($opt_options) and !$opt_options instanceof Google_Property) {
			throw new InvalidArgumentException("expecting an instance of Google_Property");
		}elseif(!empty($opt_options)) {
			if(count($signature)==2){
				$signature[] = 'null';
			}
			$signature[] = $opt_options;
		}
		$this->signature = array();
		$this->signature = $signature;

	}

	/**
	 * addErrorFromQueryResponse
	 *
	 * @desc Pass a query response and error message container to this method:
	 * if the query response indicates a query error, displays an error message
	 * in the specified page element. If the query response is null, the method
	 * will throw a Javascript error. Pass your QueryResponse received in your
	 * query handler to this message to display an error. <br/>
	 * It will also set the style of the display appropriate to the type (error
	 * or warning, similar to addError(opt_options.type))<br/><br/>
	 * <b>container</b> - The DOM element into which to insert the error message.
	 * If the container cannot be found, the function will throw a JavaScript
	 * error.<br/>
	 * <b>response</b> - A QueryResponse object received by your query handler in
	 * response to a query. If this is null, the method will throw a Javascript
	 * error.<br/><br/>
	 *
	 * @param Google_Container $container
	 * @param Google_Data_QueryResponse $response
	 * @return string String ID value that identifies the error object created,
	 * or null if the response didn't indicate an error. <br/>
	 * This is a unique value on the page, and can be used to remove the error
	 * or find its containing element.<br/>
	 */
	public function addErrorFromQueryResponse($container, $response) {
		$this->numOfArg = 2;
		$signature = array();
		if(!$container instanceof Google_Container) {
			throw new InvalidArgumentException("expecting an instance of Google_Container");
		}
		$signature[] = $container->getErrorContainer();

		if(!$response instanceof Google_Data_QueryResponse) {
			throw new InvalidArgumentException("expecting an instance of Google_Data_QueryResponse");
		}
		$signature[] = $response->getResponse();

		$this->signature = array();
		$this->signature = $signature;

	}

	/**
	 * removeError
	 * @desc Removes the error specified by ID from the page.
	 * id - The string ID of an error created using addError() or
	 * addErrorFromQueryResponse().
	 *
	 * @param string $id
	 * @return bool Boolean: true if the error was removed; false otherwise.
	 */
	public function removeError($id){
		$this->numOfArg = 1;
		if(!is_string($id)) {
			throw new InvalidArgumentException("expecting a string");
		}
		$signature[] = $id;
		$this->signature = array();
		$this->signature = $signature;

	}

	/**
	 * removeAll
	 * @desc Removes all error blocks from a specified container. If the
	 * specified container does not exist, this will throw an error.<br/>
	 * container - The DOM element holding the error strings to remove. If the
	 * container cannot be found, the function will throw a JavaScript error.
	 *
	 * @param Google_Container $container
	 * @return void
	 */
	public function removeAll(Google_Container $container) {
		$this->numOfArg = 1;
		if(!$container instanceof Google_Container) {
			throw new InvalidArgumentException("expecting a string");
		}
		$signature[] = $container->getErrorContainer();
		$this->signature = array();
		$this->signature = $signature;
	}

	/**
	 * getContainer
	 * @desc Retrieves a handle to the container element holding the error
	 * specified by errorID.<br/>
	 * errorId - String ID of an error created using addError() or
	 * addErrorFromQueryResponse().
	 *
	 * @param string $errorId
	 * @return void Handle to a DOM element holding the error specified, or null
	 * if it could not be found.
	 */
	public function getContainer($errorId) {
		$this->numOfArg = 1;
		if(!is_string($errorId)) {
			throw new InvalidArgumentException("expecting a string");
		}
		$signature[] = $errorId;
		$this->signature = array();
		$this->signature = $signature;
	}

	/**
	 * @desc renders error
	 * @return string
	 */
	public function __toString() {

		$string = '';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;

		if(count($this->signature) >= $this->numOfArg) {
			$string .= '(';
			$string .= implode(",", $this->signature);
			$string .= ');';
		} else {
			$e = new Google_Exception("method signature has to few arguments (required: $this->numOfArg argument(s)). ");
			$e->show();
		}
		$string .= "\n";
		return $string;
	}

}
/**-------TS61521-1F05-50BD-F3B7-AC6B-12DF-4640-31073--------*/

/**
 *
 * Google_Event
 *
 * Registering to Catch Events
 *
 * Your visualizations can fire and receive events, and exposes the following
 * two methods to enable you to do so:
 *
 * google.visualization.events.trigger()
 * google.visualization.events.addListener()
 *
 * Commonly Exposed Events
 *
 * Visualizations can fire a number of events. Every visualization can define
 * the details of the events it fires, but the following event should be
 * implemented in a standard way:
 * ready event
 * select event
 *
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
*/
/**
 *
 * Google_Event
 *
 * Registering to Catch Events
 *
 * Your visualizations can fire and receive events, and exposes the following
 * two methods to enable you to do so:
 *
 * google.visualization.events.trigger()
 * google.visualization.events.addListener()
 *
 * Commonly Exposed Events
 *
 * Visualizations can fire a number of events. Every visualization can define
 * the details of the events it fires, but the following event should be
 * implemented in a standard way:
 * ready event
 * select event
 *
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20
*/
class Google_Event {

	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'errors';
	/**
	 * @var string $signature
	 */
	private $signature=null;
	/**
	 * @var integer $numOfArg
	 */
	private $numOfArg = 0;

	public function __construct() {}

	/**
	 * trigger
	 *
	 * @desc Called by visualization implementers. Call this method from your
	 * visualization to fire an event with an arbitrary name and set of values.
	 *
	 * source_visualization
	 * A handle to the source visualization instance. If you are calling this
	 * function from within a method defined by the sending visualization, you
	 * can simply pass in the this keyword.
	 *
	 * event_name
	 * A string name to call the event. You can choose any string value that you want.
	 *
	 * event_args
	 * [optional] A map of name/value pairs to pass to the receiving method.
	 * For example: {message: "Hello there!", score: 10, name: "Fred"}.
	 * You can pass null if no events are needed; the receiver should be prepared
	 * to accept null for this parameter.
	 *
	 * @example
	 * Here is an example of a visualization that throws a method named "select"
	 * when its onclick method is called. It does not pass back any values.
	 *
	 * MyVisualization.prototype.onclick = function(rowIndex) {
	 *   this.highlightRow(this.selectedRow, false); // Clear previous selection
	 *   this.highlightRow(rowIndex, true); // Highlight new selection
	 *
	 *   // Save the selected row index in case getSelection is called.
	 *   this.selectedRow = rowIndex;
	 *
	 *   // Trigger a select event.
	 *   google.visualization.events.trigger(this, 'select', null);
	 * };
	 *
	 * @param Google_Type_Base $source_visualization
	 * @param Google_Type_Base $event_name
	 * @param Google_Type_Base $event_args
	 */
	public function trigger($source_visualization, $event_name, $event_args=null) {
		$signature = array();
		if(!$source_visualization instanceof Google_Type_Base) {
			throw new InvalidArgumentException("expecting an instance of Google_Type_Base");
		}
		$signature[] = $source_visualization;

		if(!$event_name instanceof Google_Type_Base) {
			throw new InvalidArgumentException("expecting an instance of Google_Type_Base");
		}
		$signature[] = $event_name;

		if(!empty($event_args) and !$event_args instanceof Google_Type_Base) {
			throw new InvalidArgumentException("expecting an instance of Google_Type_Base");
		}elseif(!empty($event_args)) {
			$signature[] = $event_args;
		}

		$this->numOfArg = 2;
		$this->signature = array();
		$this->signature = $signature;
		return $this;
	}

	/**
	 * addListener
	 *
	 * @desc Used by visualization users. Call this method to register to receive
	 * events fired by a visualization hosted on your page. Note that this will
	 * not work for gadget visualizations. The visualization should document what
	 * event arguments, if any, will be passed to the handling function.
	 *
	 * source_visualization
	 * A handle to the source visualization instance.
	 *
	 * event_name
	 * The string name of the event to listen for. A visualization should document
	 * which events it throws.
	 *
	 * handling_function
	 * The name of the local JavaScript function to call when source_visualization
	 * fires the event_name event. The handling function will be passed any event
	 * arguments as parameters.
	 *
	 * @example
	 * Here is an example of registering to receive the selection event
	 *
	 * var table = new google.visualization.Table(document.getElementById('table_div'));
	 * table.draw(data, options);
	 *
	 * google.visualization.events.addListener(table, 'select', selectHandler);
	 *
	 * function selectHandler() {
	 *   alert('A table row was selected');
	 * }
	 *
	 * @param Google_Type_Base $source_visualization
	 * @param Google_Type_Base $event_name
	 * @param Google_Type_Base $handling_function
	 */
	public function addListener($source_visualization, $event_name, $handling_function) {
		$signature = array();
		if(!$source_visualization instanceof Google_Type_Base) {
			throw new InvalidArgumentException("expecting an instance of Google_Type_Base");
		}
		$signature[] = $source_visualization;

		if(!$event_name instanceof Google_Type_Base) {
			throw new InvalidArgumentException("expecting an instance of Google_Type_Base");
		}
		$signature[] = $event_name;

		if(!$handling_function instanceof Google_Type_Base) {
			throw new InvalidArgumentException("expecting an instance of Google_Type_Base");
		}
		$signature[] = $handling_function;

		$this->numOfArg = 3;
		$this->signature = array();
		$this->signature = $signature;
		return $this;
	}

	/**
	 * @desc renders event
	 * @return string
	 */
	public function __toString() {

		$string = '';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;

		if(count($this->signature) >= $this->numOfArg) {
			$string .= '(';
			$string .= implode(",", $this->signature);
			$string .= ');';
			$string .= "\n";
		} else {
			$e = new Google_Exception("method signature has to few arguments (required: $this->numOfArg argument(s)). ");
			$e->show();
		}
		return $string;
	}

}


/**-------TS61521-D104-4329-65AA-B948-6915-FB65-31073--------*/

/**
 * Google_Format_Arrow
 *
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds an up or down arrow to a numeric cell, depending on whether the
 * value is above or below a specified base value. If equal to the base value,
 * no arrow is shown.
 */
/**
 * Google_Format_Arrow
 *
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds an up or down arrow to a numeric cell, depending on whether the
 * value is above or below a specified base value. If equal to the base value,
 * no arrow is shown.
 * {@example test_google_vis_table_arrow.php}
 */
class Google_Format_Arrow extends Google_Format implements Google_Format_Interface {

	/**
	 * @staticvar array isRegistered
	 */
	private static $isRegistered = array(
		"base"=>true
	);
	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'ArrowFormat';
	/**
	 * @var string $dataTable
	 */
	private $dataTable = 'data';
	/**
	 * @var integer $srcColumnIndices
	 */
	private $srcColumnIndices = 0;
	/**
	 * @var array $properties
	 */
	protected $properties=null;

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * getInstance
	 * @return Google_Format_Arrow
	 */
	public static function getInstance() {
		return Google_Format_Arrow;
	}

	/**
	 * desc The standard format() method to apply formatting to the specified
	 * column.
	 * @param string $dataTable
	 * @param integer $srcColumnIndices
	 */
	public function format($dataTable, $srcColumnIndices) {
		if(is_string($dataTable)) {
			$this->dataTable = $dataTable;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
		if(is_integer($srcColumnIndices) or is_array($srcColumnIndices) ) {
			$this->srcColumnIndices = $srcColumnIndices;
		} else {
			$e = new Google_Exception_Format("source column is expecting a parameter of type integer or array of integers. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * __toString
	 * @desc returns table arrow formatter template
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '('. (!empty($this->properties)?Google_Base::toJson($this->properties):'').');';
		$string .= "\n";
		$string .= 'formatter.format('.$this->dataTable.', '.$this->srcColumnIndices.');';
		$string .= "\n";
		return $string;
	}
}
/**-------TS61521-5F4A-DB87-AC65-A471-579F-271A-31073--------*/

/**
 * Google_Format_Bar
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds a colored bar to a numeric cell indicating whether the cell value
 * is above or below a specified base value.
 *
 */
/**
 * Google_Format_Bar
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds a colored bar to a numeric cell indicating whether the cell value
 * is above or below a specified base value.
 * {@example test_google_vis_table_bar.php}
 *
 */
class Google_Format_Bar extends Google_Format implements Google_Format_Interface {

	/**
	 * @staticvar array $isRegistered
	 */
	private static $isRegistered = array(
		"base"=>true,
		"colorNegative"=>true,
		"colorPositive"=>true,
		"drawZeroLine"=>true,
		"max"=>true,
		"min"=>true,
		"showValue"=>true,
		"width"=>true
	);
	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'BarFormat';
	/**
	 * @var string $dataTable
	 */
	private $dataTable = 'data';
	/**
	 * @var integer $srcColumnIndices
	 */
	private $srcColumnIndices = 0;

	/**
	 * @var array $properties
	 */
	protected $properties=null;

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * getInstance
	 * @desc call static to provide fluent design notation
	 * @return Google_Format_Bar
	 */
	public static function getInstance() {
		return new Google_Format_Bar;
	}

	/**
	 * format
	 * @param mixed $data
	 * @param integer $srcColumnIndices
	 */
	public function format($dataTable, $srcColumnIndices) {
		if(is_string($dataTable)) {
			$this->dataTable = $dataTable;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
		if(is_integer($srcColumnIndices) or is_array($srcColumnIndices) ) {
			$this->srcColumnIndices = $srcColumnIndices;
		} else {
			$e = new Google_Exception_Format("source column is expecting a parameter of type integer or array of integers. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * __toString
	 * @desc returns table bar formatter template
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '('. (!empty($this->properties)?Google_Base::toJson($this->properties):'').');';
		$string .= "\n";
		$string .= 'formatter.format('.$this->dataTable.', '.$this->srcColumnIndices.');';
		$string .= "\n";
		return $string;
	}
}
/**-------TS61521-B48C-A7A2-A172-A6E8-B056-D4BF-31073--------*/

/**
 * Google_Format_Bar
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds a colored bar to a numeric cell indicating whether the cell value
 * is above or below a specified base value.
 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/reference.html#arrowformatter
 */
/**
 * Google_Format_Bar
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Adds a colored bar to a numeric cell indicating whether the cell value
 * is above or below a specified base value.
 * {@example test_google_vis_table_color.php}
 */
class Google_Format_Color extends Google_Format implements Google_Format_Interface {

	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'ColorFormat';
	/**
	 * @var string $dataTable
	 */
	private $dataTable = 'data';
	/**
	 * @var integer $srcColumnIndices
	 */
	private $srcColumnIndices = 0;
	/**
	 * @var array $properties
	 */
	protected $properties=null;

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * format
	 * @desc The standard format() method to apply formatting to the specified
	 * column.
	 * @param string $dataTable
	 * @param integer $srcColumnIndices
	 * @return void
	 */
	public function format($dataTable, $srcColumnIndices) {
		if(is_string($dataTable)) {
			$this->dataTable = $dataTable;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
		if(is_integer($srcColumnIndices) or is_array($srcColumnIndices) ) {
			$this->srcColumnIndices = $srcColumnIndices;
		} else {
			$e = new Google_Exception_Format("source column is expecting a parameter of type integer or array of integers. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * addRange
	 * @desc Assigns a foreground color and/or background color to a cell,
	 * depending on its value. Any cell with a value in the range specified by
	 * from—to, non-inclusive, will be displayed with the colors assigned to
	 * color and bgcolor. It is important to realize that the range is
	 * non-inclusive, because creating a range from 1—1,000 and a second
	 * from 1,000—2,000 will not cover the value 1,000!
	 *
     * from - The low boundary (non-inclusive) of the numeric range, or null.
	 * If null, it will match -infinity.
     * to - The high boundary (non-inclusive) of the numeric range, or null.
	 * If null, it will match +infinity.
     * color - The color to apply to text in matching cells.
     * bgcolor - The color to apply to the background of matching cells.
	 *
	 * @param integer $from
	 * @param integer $to
	 * @param string $color
	 * @param string $bgColor
	 * @return void
	 */
	public function addRange($from, $to=0, $color='white', $bgColor='orange') {
		$this->addProperty("addRange", array((int) $from, (int) $to, "'".(string) $color."'", "'".(string) $bgColor."'"));
	}

	/**
	 * addGradientRange
	 *
	 * @desc
	 * Assigns a background color from a range, according to the cell value.
	 * The color is scaled to match the cell's value within a range from a lower
	 * boundary color to an upper boundary color. Tip: Color ranges are often
	 * hard for viewers to gauge accurately; the simplest and easiest to read
	 * range is from a fully saturated color to white (e.g., #FF0000 #FFFFFF).
	 *
     * from - The low boundary (non-inclusive) of the numeric range, or null.
	 * If null, it will match -infinity.
     * to - The high boundary (non-inclusive) of the numeric range, or null.
	 * If null, it will match +infinity.
     * color - The color to apply to text in matching cells. This color is the
	 * same for all cells, no matter what their value.
     * fromBgColor - The color at the low end of the gradient, to apply to the
	 * cell background.
     * toBgColor - The color at the high end of the gradient, to apply to the
	 * cell background.
	 *
	 * @param integer $from
	 * @param integer $to
	 * @param string $color
	 * @param string $bgColor
	 * @return void
	 */
	public function addGradientRange($from=1000, $to=0, $color='white', $bgColor='orange') {
		$this->addProperty("addGradientRange", array((int) $from, (int) $to, "'".(string) $color."'", "'".(string) $bgColor."'"));
	}

	/**
	 * @desc returns table color formatter template
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '()';
		$string .= "\n";
		if(is_array($this->properties)){
			foreach($this->properties as $method => $parameters) {
				foreach($parameters as $signature) {
					$string .= 'formatter.'.$method.'('.implode(',',$signature).');'."\n";
				}
			}
		}
		$string .= 'formatter.format('.$this->dataTable.', '.$this->srcColumnIndices.');';
		$string .= "\n";
		return $string;
	}


}
/**-------TS61521-1E83-B6E8-674B-D867-CD97-882D-31073--------*/

/**
 * Google_Format_Date
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Formats a JavaScript Date value in a variety of ways, including
 * "January 1, 2009," "1/1/09" and "Jan 1, 2009.
 *
 */
/**
 * Google_Format_Date
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Formats a JavaScript Date value in a variety of ways, including
 * "January 1, 2009," "1/1/09" and "Jan 1, 2009.
 * {@example test_google_vis_table_date.php}
 *
 */
class Google_Format_Date extends Google_Format implements Google_Format_Interface {

	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'DateFormat';
	/**
	 * @var string $dataTable
	 */
	private $dataTable = 'data';
	/**
	 * @var integer $srcColumnIndices
	 */
	private $srcColumnIndices = 0;

	/**
	 * @var string $prefix
	 */
	private $prefix = '';

	/**
	 * @var array $properties
	 */
	protected $properties;

	/**
	 * constructor
	 * @param string $prefix
	 */
	public function __construct($prefix='') {
		$this->prefix = '_'.$prefix;
		$this->properties = new stdClass;
	}

	/**
	 * desc The standard format() method to apply formatting to the specified
	 * column.
	 * @param string $dataTable
	 * @param integer $srcColumnIndices
	 */
	public function format($dataTable, $srcColumnIndices) {
		if(is_string($dataTable)) {
			$this->dataTable = $dataTable;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
		if(is_integer($srcColumnIndices) or is_array($srcColumnIndices) ) {
			$this->srcColumnIndices = $srcColumnIndices;
		} else {
			$e = new Google_Exception_Format("source column is expecting a parameter of type integer or array of integers. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * formatType
	 * @desc A quick formatting option for the date. The following string values
	 * are supported, reformatting the date February 28, 2008 as shown:
     * 'short' - Short format: e.g., "2/28/08"
     * 'medium' - Medium format: e.g., "Feb 28, 2008"
     * 'long' - Long format: e.g., "February 28, 2008"
	 * You cannot specify both formatType and pattern.
	 *
	 * @param string $column short|medium|long
	 * @return void
	 */
	public function formatType($formatType='short') {
		switch($formatType){
			case "short":
			case "medium":
			case "long":
				$this->properties->formatType = (string)$formatType;
				break;
		}
	}

	/**
	 * pattern
	 *
	 * @desc A custom format pattern to apply to the value, similar to the ICU
	 * date and time format.
	 * You cannot specify both formatType and pattern.
	 * @example
	 * <code>
	 * var formatter3 = new google.visualization.DateFormat({pattern: "EEE, MMM d, ''yy"});
	 * </code>
	 * @see http://code.google.com/intl/de-DE/apis/visualization/documentation/reference.html#dateformatter
	 * @param string $pattern
	 * @return void
	 */
	public function pattern($pattern) {
		$this->properties->pattern = $pattern;
	}

	/**
	 * timezone
	 * @desc The time zone in which to display the date value. This is a numeric
	 * value, indicating GMT + this number of time zones (can be negative). Date
	 * object are created by default with the assumed time zone of the computer
	 * on which they are created; this option is used to display that value in a
	 * different time zone. For example, if you created a Date object of 5pm noon
	 * on a computer located in Greenwich, England, and specified timeZone to be
	 * -5 (options['timeZone'] = -5, or Eastern Pacific Time in the US), the value
	 * displayed would be 12 noon.
	 *
	 * @param integer $timeZone
	 * @return void
	 */
	public function timezone($timeZone) {
		$this->properties->timeZone = (int) $timeZone;
	}

	/**
	 * @desc table date formatter template
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter'.$this->prefix.'=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '('.(!empty($this->properties)?Google_Base::toJson($this->properties):'').');';
		$string .= "\n";
		$string .= 'formatter'.$this->prefix.'.format('.$this->dataTable.', '.$this->srcColumnIndices.');';
		$string .= "\n";
		return $string;
	}
}
/**-------TS61521-8330-D157-33B3-8F9D-8244-D1BE-31073--------*/

/**
 * Google_Format_Interface
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
interface Google_Format_Interface {
	public function format($dataTable, $srcColumnIndices);
}
/**-------TS61521-A7DC-15E3-B5BC-2F7A-9A91-55E7-31073--------*/

/**
 * Google_Format_Number
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Describes how numeric columns should be formatted. Formatting options
 * include specifying a prefix symbol (such as a dollar sign) or the punctuation
 * to use as a thousands marker.
 */
/**
 * Google_Format_Number
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Describes how numeric columns should be formatted. Formatting options
 * include specifying a prefix symbol (such as a dollar sign) or the punctuation
 * to use as a thousands marker.
 * {@example test_google_vis_table_number.php}
 */
class Google_Format_Number extends Google_Format implements Google_Format_Interface {

	/**
	 * @staticvar array $isRegistered
	 */
	private static $isRegistered = array(
		"decimalSymbol"=>true,
		"fractionDigits"=>true,
		"groupingSymbol"=>true,
		"negativeColor"=>true,
		"negativeParens"=>true,
		"prefix"=>true,
		"suffix"=>true
	);
	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'NumberFormat';
	/**
	 * @var string $dataTable name of the function variable
	 */
	private $dataTable = 'data';
	/**
	 *
	 * @var integer srcColumnIndices
	 */
	private $srcColumnIndices = 0;

	/**
	 * @var array $properties
	 */
	protected $properties=null;


	/**
	 * desc The standard format() method to apply formatting to the specified
	 * column.
	 * @param string $dataTable
	 * @param integer $srcColumnIndices
	 */
	public function format($dataTable, $srcColumnIndices) {
		if(is_string($dataTable)) {
			$this->dataTable = $dataTable;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
		if(is_integer($srcColumnIndices) or is_array($srcColumnIndices) ) {
			$this->srcColumnIndices = $srcColumnIndices;
		} else {
			$e = new Google_Exception_Format("source column is expecting a parameter of type integer or array of integers. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '('. (!empty($this->properties)?Google_Base::toJson($this->properties):'').');';
		$string .= "\n";
		$string .= 'formatter.format('.$this->dataTable.', '.$this->srcColumnIndices.')';
		$string .= "\n";
		return $string;
	}


}
/**-------TS61521-6430-DA2D-AC89-0783-DEBA-7A2A-31073--------*/

/**
 * Google_Format_Pattern
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Enables you to merge the values of designated columns into a single
 * column, along with arbitrary text. So, for example, if you had a column for
 * first name and a column for last name, you could populate a third column with
 * {last name}, {first name}. This formatter does not follow the conventions for
 * the constructor and the format() method. See the Methods section below for
 * instructions.
 */
/**
 * Google_Format_Pattern
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @desc Enables you to merge the values of designated columns into a single
 * column, along with arbitrary text. So, for example, if you had a column for
 * first name and a column for last name, you could populate a third column with
 * {last name}, {first name}. This formatter does not follow the conventions for
 * the constructor and the format() method. See the Methods section below for
 * instructions.
 * {@example test_google_vis_table_pattern.php}
 */
class Google_Format_Pattern extends Google_Format implements Google_Format_Interface {

	public static $isRegistered = array(
		"decimalSymbol"=>true,
		"fractionDigits"=>true,
		"groupingSymbol"=>true,
		"negativeColor"=>true,
		"negativeParens"=>true,
		"prefix"=>true,
		"suffix"=>true
	);
	private $provider = 'google';
	private $scope = 'visualization';
	private $type = 'PatternFormat';
	private $dataTable = 'data';
	private $srcColumnIndices = 0;
	private $opt_dstColumnIndex = 0;
	private $pattern;

	public function __construct() {}

	/**
	 * pattern
	 * @desc set the pattern to be used with table
	 * @param string $pattern
	 */
	public function pattern($pattern) {
		if(is_string($pattern)) {
			$this->pattern = $pattern;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * @desc The standard formatting call, with a few additional parameters:
     * dataTable - The DataTable on which to operate.
     * srcColumnIndices - An array of one or more (zero-based) column indices to
	 * pull as the sources from the underlying DataTable. This will be used as a
	 * data source for the pattern parameter in the constructor. The column
	 * numbers do not have to be in sorted order.
     * opt_dstColumnIndex - [optional] The destination column to place the
	 * output of the pattern manipulation. If not specified, the first element
	 * in srcColumIndices will be used as the destination.
	 *
	 * @param string $dataTable
	 * @param integer $srcColumnIndices
	 * @param integer $opt_dstColumnIndex
	 */
	public function format($dataTable, $srcColumnIndices, $opt_dstColumnIndex=null) {
		if(is_string($dataTable)) {
			$this->dataTable = $dataTable;
		} else {
			$e = new Google_Exception_Format("Expecting a parameter of type string. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
		if(is_integer($srcColumnIndices) or is_array($srcColumnIndices) ) {
			$this->srcColumnIndices = $srcColumnIndices;
		} else {
			$e = new Google_Exception_Format("source column is expecting a parameter of type integer or array of integers. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
		if(null===$opt_dstColumnIndex or is_integer($opt_dstColumnIndex)) {
			$this->opt_dstColumnIndex = $opt_dstColumnIndex;
		} else {
			$e = new Google_Exception_Format("destination column is expecting a parameter of type integer. (transfered type: ". gettype($pattern).')');
			$e->show();
		}
	}

	/**
	 * __toString
	 * @return string
	 */
	public function __toString() {
		$string = 'var formatter=new ';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->scope;
		$string .= '.';
		$string .= $this->type;
		$string .= '(\''. (!empty($this->pattern)?(string)$this->pattern:'').'\');';
		$string .= "\n";
		if(empty($this->opt_dstColumnIndex)) {
			$string .= 'formatter.format('.$this->dataTable.', '.Google_Base::toJson($this->srcColumnIndices).');';
		} else {
			$string .= 'formatter.format('.$this->dataTable.', '.Google_Base::toJson($this->srcColumnIndices).', '.Google_Config::toJson($this->opt_dstColumnIndex).');';
		}
		$string .= "\n";
		return $string;
	}


}
/**-------TS61521-0B03-F247-0219-C2DA-05D9-128C-31073--------*/

/**
 * Google_Format
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20


 * @desc Factory to load a formatter object
 *
 * The Google Visualization API provides formatters that can be used to reformat
 * data in a visualization. These formatters change the formatted value of the
 * specified column in all rows. Note that it does not modify the underlying
 * values; just the formatted values. So, for example, the displayed value would
 * be "$1,000.00" but the underlying value would still be "1000". Formatters can
 * only affect one column at a time; to reformat multiple columns, apply a
 * formatter to each column that you want to change.
 *
 * Important: Formatters can only be used with a DataTable; they cannot be used
 * with a DataView (DataView objects are read-only).
 *
 * Here are the general steps for using a formatter:
 *
 *    1. Get your populated DataTable object.
 *    2. For each column that you want to reformat:
 *
 *          1. Create an object that specifies all the options for your formatter.
 *             This is a basic JavaScript object with a set of properties and
 *             values. Look at your formatter's documentation to see what
 *             properties are supported. (Optionally, you can pass in an object
 *             literal notation object specifying your options.)
 *          2. Create your formatter, passing in your options object.
 *          3. Call formatter.Format(table, colIndex), passing in the DataTable
 *             and the (zero-based) column number of the data to reformat.
 *             Important: Many formatters require HTML tags to display special
 *             formatting; if your visualization supports an allowHtml option,
 *             you should set it to true.
 *
 * Here is an example of changing the formatted date values of a date column to
 * use a long date format ("January 1, 2009"):
 *
 * @example
 * var data = new google.visualization.DataTable();
 * data.addColumn('string', 'Employee Name');
 * data.addColumn('date', 'Start Date');
 * data.addRows(3);
 * data.setCell(0, 0, 'Mike');
 * data.setCell(0, 1, new Date(2008, 1, 28));
 * data.setCell(1, 0, 'Bob');
 * data.setCell(1, 1, new Date(2007, 5, 1));
 * data.setCell(2, 0, 'Alice');
 * data.setCell(2, 1, new Date(2006, 7, 16));
 *
 * // Create a formatter.
 * // This example uses object literal notation to define the options.
 * var formatter = new google.visualization.DateFormat({formatType: 'long'});
 *
 * // Reformat our data.
 * formatter.format(data, 1);
 *
 * // Draw our data
 * var table = new google.visualization.Table(document.getElementById('dateformat_div'));
 * table.draw(data, {showRowNumber: true});
 *
 */
/**
 * Google_Format
 * @package Google
 * @subpackage Google_Format
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20


 * @desc Factory to load a formatter object
 *
 * The Google Visualization API provides formatters that can be used to reformat
 * data in a visualization. These formatters change the formatted value of the
 * specified column in all rows. Note that it does not modify the underlying
 * values; just the formatted values. So, for example, the displayed value would
 * be "$1,000.00" but the underlying value would still be "1000". Formatters can
 * only affect one column at a time; to reformat multiple columns, apply a
 * formatter to each column that you want to change.
 *
 * Important: Formatters can only be used with a DataTable; they cannot be used
 * with a DataView (DataView objects are read-only).
 *
 * Here are the general steps for using a formatter:
 *
 *    1. Get your populated DataTable object.
 *    2. For each column that you want to reformat:
 *
 *          1. Create an object that specifies all the options for your formatter.
 *             This is a basic JavaScript object with a set of properties and
 *             values. Look at your formatter's documentation to see what
 *             properties are supported. (Optionally, you can pass in an object
 *             literal notation object specifying your options.)
 *          2. Create your formatter, passing in your options object.
 *          3. Call formatter.Format(table, colIndex), passing in the DataTable
 *             and the (zero-based) column number of the data to reformat.
 *             Important: Many formatters require HTML tags to display special
 *             formatting; if your visualization supports an allowHtml option,
 *             you should set it to true.
 *
 * Here is an example of changing the formatted date values of a date column to
 * use a long date format ("January 1, 2009"):
 *
 * @example
 * var data = new google.visualization.DataTable();
 * data.addColumn('string', 'Employee Name');
 * data.addColumn('date', 'Start Date');
 * data.addRows(3);
 * data.setCell(0, 0, 'Mike');
 * data.setCell(0, 1, new Date(2008, 1, 28));
 * data.setCell(1, 0, 'Bob');
 * data.setCell(1, 1, new Date(2007, 5, 1));
 * data.setCell(2, 0, 'Alice');
 * data.setCell(2, 1, new Date(2006, 7, 16));
 *
 * // Create a formatter.
 * // This example uses object literal notation to define the options.
 * var formatter = new google.visualization.DateFormat({formatType: 'long'});
 *
 * // Reformat our data.
 * formatter.format(data, 1);
 *
 * // Draw our data
 * var table = new google.visualization.Table(document.getElementById('dateformat_div'));
 * table.draw(data, {showRowNumber: true});
 *
 */
class Google_Format {

	/**
	 * @var stdClass $properties
	 */
	protected $properties;

	/**
	 * constructor
	 */
	public function __construct() {}

	/**
	 * factory
	 * @desc factory class to call table formatter
	 * @param string $name
	 * @return instanceof Google_Format
	 */
	public static function factory($name) {

		switch($name) {
			case "Arrow":
				/** @var Google_Format_Arrow $arrow */
				$arrow = new Google_Format_Arrow;
				return $arrow;
			case "Bar":
				/** @var Google_Format_Pattern $bar */
				$bar = new Google_Format_Bar;
				return $bar;
			case "Color":
				/** @var Google_Format_Color $color */
				$color = new Google_Format_Color;
				return $color;
			case "Date":
				/** @var Google_Format_Date $date */
				$date = new Google_Format_Date;
				return $date;
			case "Number":
				/** @var Google_Format_Number $number */
				$number = new Google_Format_Number;
				return $number;
			case "Pattern":
				/** @var Google_Format_Pattern $pattern */
				$pattern = new Google_Format_Pattern;
				return $pattern;
			default:
				throw new Google_Exception_Format("A Formatter Object named $name does not exist.");
				break;
		}
	}

	/**
	 * __set
	 * @desc give direct access to object properties
	 * @example
	 * $obj->setDecimalSymbol(1) is equal to $obj->decimalSymbol = 1;
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value) {
		$this->setProperty($name, $value);
	}

	/**
	 * hasProperty
	 * @desc test if a chart type has a specific property
	 * @param string $name
	 * @return bool
	 */
	public function hasProperty($name, $properties) {
		return array_key_exists($name, $properties);
	}

	/**
	 * addProperty
	 * @param string $name
	 * @param array $parameters
	 * @return void
	 */
	protected function addProperty($name, array $parameters) {
		if(!$this->properties instanceof stdClass) {
			$this->properties = new stdClass;
			$this->properties->$name = array();
		}
		$this->properties->{$name}[] = $parameters;
	}

	/**
	 * setProperty
	 * @param string $name
	 * @param mixed $val
	 * @return void
	 */
    protected function setProperty($name, $val) {
		$r = new ReflectionClass(get_class($this));
		$arr = $r->getStaticProperties();
        if($this->hasProperty($name, $arr["isRegistered"])) {
			if(!$this->properties instanceof stdClass) {
				$this->properties = new stdClass;
			}
            $this->properties->$name = $val;
        } else {
            $e = new Google_Exception_Format("Formatter ".__CLASS__." does not support a property named $name.");
			echo $e->show();
        }
        return $this;
    }

	/**
	 * __call
	 * @desc sets a property while reflecting a formatter's registry
	 * @param string $name
	 * @param array $parameters
	 * @return void
	 */
	public function __call($name, $parameters) {
		// analyse property name
		$methodObject = Google_Base::getMethodType($name);
		$methodType = $methodObject["type"];
		$name = $methodObject["name"];
		switch($methodType) {
			case "set":
				$firstDown = Google_Base::ucFirstDown($name);
				$this->setProperty($firstDown, $parameters[0]);
				break;
		}
	}

	/**
	 * @return string empty string
	 */
	public function __toString() {
		return '';
	}

}
/**-------TS61521-757F-58C2-EE1A-A257-A16D-EE76-31073--------*/
/**
 *
 * Google_Function
 * @desc compose function on top of Google's Web Visualization API
 * {@example test_google_vis_using_the_query_language.php}
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 *
 * Google_Function
 * @desc compose function on top of Google's Web Visualization API
 * {@example test_google_vis_using_the_query_language.php}
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Function {
	/**
	 * @var string $name
	 */
	private $name = 'draw';
	/**
	 * @var array $stack
	 */
	private $stack = array();
	/**
	 * @var string $callback
	 */
	private $callback = '';

	/**
	 * constructor
	 * @param string $name function name
	 * @param array $parameters signature parameters
	 */
	public function __construct($name="draw", $parameters=array()) {
		$this->name = $name;
		$this->stack[] = 'function '.$name.'('.implode(", ", $parameters).'){';
	}

	/**
	 * add
	 * @desc append value to function stack
	 * @param mixed $part
	 * return void
	 */
	public function add($part) {
		$this->stack[] = $part;
		return $this;
	}

	/**
	 * getName
	 * @desc return function name
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * setCallBack
	 * @desc init and name Google callback onload function
	 * @return void
	 */
	public function setCallBack() {
		$this->callback = 'google.setOnLoadCallback('.$this->name.')'.";\n";
		return $this;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		$string = "\n".implode("\n ", $this->stack)."}\n";
		$string .= $this->callback;
		return $string;

	}
}
/**-------TS61521-BC08-EA22-D8FA-3379-95E8-A0AC-31073--------*/

class Google {
	const G_API_VERSION = 2;
}
/**-------TS61521-5D10-1176-5E28-708A-7B50-0C79-31073--------*/
/**
 *
 * Google_Package
 * @desc returns the package loader
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 *
 * Google_Package
 * @desc returns the package loader
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Package {

	/**
	 * @staticvar $isRegistered used to register items
	 */
	private static $isRegistered = array(
		"packages"=>true,
		"language"=>true,
	);

	/**
	 * @var array $properties
	 */
	private $properties = null;
	/**
	 * @var string $provider
	 */
	private $provider = 'google';
	/**
	 * @var string $scope
	 */
	private $scope = 'visualization';
	/**
	 * @var string $type
	 */
	private $type = 'load';
	/**
	 * @var integer $version
	 */
	private $version = 1;

	/**
	 *
	 * @param array $properties
	 * @param string $provider
	 * @param string $scope
	 */
	public function __construct(array $properties = array(), $provider=null, $scope=null) {
	    if(count($properties))
	    {
	      foreach($properties as $name => $value)
	      {
	          if(array_key_exists($name, self::$isRegistered)) {
    			if(empty($this->properties)) {
    				$this->properties = new stdClass;
    			}
    			$this->properties->{$name} = $value;
	          }
	      }
	    }
		if($provider) {
			$this->provider = $provider;
		}
		if($scope){
			$this->scope = $scope;
		}
	}

	/**
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value) {
		if(array_key_exists($name, self::$isRegistered)) {
			if(empty($this->properties)) {
				$this->properties = new stdClass;
			}
			$this->properties->{$name} = $value;
		} else {
			throw new Exception("no such property named ". $name);
		}
	}

	/**
	 * setType
	 * @desc sets the methodType
	 * @param mixed $type
	 */
	public function setType($type) {
		if(is_array($type)) {
			$this->type = implode(".", $type);
		} else {
			$this->type = $type;
		}
	}

	/**
	 * @return string
	 */
	public function __toString() {
		$string = '';
		$string .= $this->provider;
		$string .= '.';
		$string .= $this->type;
		$string .= '(';
		$string .= "'".$this->scope."',";
		$string .= "'".$this->version."',";
		$string .= (!empty($this->properties)?Google_Base::toJson($this->properties):'');
		$string .= ');';
		return $string;

	}
}
/**-------TS61521-F1A5-78BD-22EF-6187-1226-61B8-31073--------*/

/**
 * Google_Property
 *
 * @desc
 * Object used to prepare JSON Objects
 * @package Google
 * @author Thomas Schaefer
 * @since 2009-05-28
 */
/**
 * Google_Property
 *
 * @desc
 * Object used to prepare JSON Objects
 * @package Google
 * @author Thomas Schaefer
 * @since 2009-05-28
 */
class Google_Property {

	/**
	 * @var stdClass $properties
	 */
	private $properties;

	/**
	 * constructor
	 * @desc receives a nested array. The array may contain further
	 * JQuery objects or JQuery Elements
	 * @param array $properties
	 */
	public function __construct(array $properties) {
		$this->properties = new stdClass;
		if(is_array($properties)) {
			foreach($properties as $name => $val) {
				$this->properties->{$name} = $val;
			}
		}
	}

	/**
	 * __set
	 * @desc inject further properties
	 * @param string $name
	 * @param mixed $param
	 */
	public function __set($name, $param) {
		$this->properties->$name = $param;
	}

	/**
	 * render nested Google_Property Object to JSON
	 * @return string
	 */
	public function __toString() {
		return stripslashes(Google_Base::toJSON($this->properties));
	}

}
/**-------TS61521-E537-FC2F-FFC3-2493-3C2B-7F12-31073--------*/
/**
 * Google_Type_Array
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Array
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Array extends Google_Type_Base implements Google_Type {

	/**
	 * @var array $value
	 */
	private $values;

	/**
	 * constructor
	 * @param array $values
	 */
	public function __construct(array $values) {
		$this->values = $values;
	}

	/**
	 * __toString
	 * @desc convert an array to JSON data object
	 * @return string
	 */
	public function __toString(){
		return Google_Base::toJSON($this->values);
	}
}

/**-------TS61521-EA0F-17E8-50FD-7DFB-2DC5-845A-31073--------*/

/**
 * Google_Type
 * @desc interface for data types
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type
 * @desc interface for data types
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
interface Google_Type {
	public function __toString();
}
/**
 * Google_Type_Base
 * @desc Base class of all types
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Base
 * @desc Base class of all types
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Base {}
/**-------TS61521-4130-77D1-2AC1-F052-2479-2315-31073--------*/

/**
 * Google_Type_Bool
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Bool
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Bool extends Google_Type_Base {

	/**
	 * @var bool
	 */
	private $value;

	/**
	 * constructor
	 * @param bool $value
	 */
	public function __construct($value) {
		$this->value = is_bool($value)?$value:false;
	}

	/**
	 * __toString
	 * @desc converts a boolean value into its javascript string representation
	 * @return string
	 */
	public function __toString(){
		return (true===$this->value?'true':'false');
	}
}

/**-------TS61521-5F25-586D-2D21-AD2B-DD93-8758-31073--------*/
/**
 * Google_Type_Date
 * @desc data type date class
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Date
 * @desc data type date class
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Date extends Google_Type_Base {
	/**
	 * @var integer $year
	 */
	private $year;
	/**
	 * @var integer $month
	 */
	private $month;
	/**
	 * @var integer $day
	 */
	private $day;
	/**
	 * @var integer $hour
	 */
	private $hour;
	/**
	 * @var integer $minute
	 */
	private $minute;
	/**
	 * @var integer $seconds
	 */
	private $seconds;

	/**
	 *
	 * @param integer $year
	 * @param integer $month
	 * @param integer $day
	 * @param integer $hour
	 * @param integer $minutes
	 * @param integer $seconds
	 */
	public function __construct($year, $month, $day, $hour = 0, $minutes = 0, $seconds = 0) {

		if($year>2100) {
			throw new DomainException("Input data for year does not make sense;");
		}
		$this->year = (int)$year;

		if($month < 1 and $month>12) {
			throw new DomainException("Input value for month has to greater than 0 and lower than 13;");
		}
		$this->month = (int)$month;

		if($day < 1 and $day>31) {
			throw new DomainException("Input value for day has to greater than 0 and lower than 32;");
		}
		$this->day = (int)$day;

		if($hour < 0 and $hour>23) {
			throw new DomainException("Input value for hour has to between 0 and 23;");
		}
		$this->hour = $hour;

		if($minutes < 0 and $minutes>60) {
			throw new DomainException("Input value for minutes has to between 0 and 60;");
		}
		$this->minutes = $minutes;

		if($seconds < 0 and $seconds>60) {
			throw new DomainException("Input value for seconds has to between 0 and 60;");
		}
		$this->seconds = $seconds;
	}
	/**
	 * @return __toString
	 */
	public function __toString(){
		return "new Date(".$this->year.",".$this->month.",".$this->day.",".$this->hour.",".$this->minutes.",".$this->seconds.")";
	}
}

/**-------TS61521-BEFF-83C1-2617-1821-669A-AFA2-31073--------*/
/**
 * Google_Type_Object
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Object
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Number extends Google_Type_Base {

	/**
	 * @var integer $value
	 */
	private $value;
	/**
	 * constructor
	 * @param mixed $value
	 */
	public function __construct($value) {
		$this->value = is_numeric($value)?$value:0;
	}
	/**
	 * @return string
	 */
	public function __toString(){
		return (string)$this->value;
	}
}

/**-------TS61521-425F-5D90-1E04-DC56-363F-F5CA-31073--------*/
/**
 * Google_Type_Object
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Object
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Object extends Google_Type_Base {

	/**
	 * @var object $value
	 */
	private $value;

	/**
	 * constructor
	 * @param object $value
	 */
	public function __construct($value) {
		if(is_object($value)) {
			$this->value = $value;
		}
	}
	/**
	 * @return string
	 */
	public function __toString(){
		return Google::toJSON($this->value);
	}
}

/**-------TS61521-CD0A-B567-E16A-703C-3B26-3425-31073--------*/

/**
 * Google_Type_String
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_String
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_String extends Google_Type_Base {
	/**
	 * @var mixed $value
	 */
	private $value;
	/**
	 * constructor
	 * @param mixed $value
	 */
	public function __construct($value) {
		$this->value = $value;
	}
	/**
	 * @return string
	 */
	public function __toString(){
		return "'".(string)$this->value."'";
	}
}

/**-------TS61521-A1A1-CE61-A6A6-726E-C6F8-D36C-31073--------*/

/**
 * Google_Type_Time
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Time
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Time extends Google_Type_Base {
	/**
	 * @var integer $hour
	 */
	private $hour;
	/**
	 * @var integer $minutes
	 */
	private $minutes;
	/**
	 * @var integer $seconds
	 */
	private $seconds;
	/**
	 * @var integer $timezoneOffset
	 */
	private $timezoneOffset;

	/**
	 *
	 * @param integer $hour
	 * @param integer $minutes
	 * @param integer $seconds
	 * @param integer $timezoneOffset
	 */
	public function __construct($hour = 0, $minutes = 0, $seconds = 0, $timezoneOffset=0) {

		if($hour < 0 and $hour>23) {
			throw new DomainException("Input value for hour has to between 0 and 23;");
		}
		$this->hour = $hour;

		if($minutes < 0 and $minutes>60) {
			throw new DomainException("Input value for minutes has to between 0 and 60;");
		}
		$this->minutes = $minutes;

		if($seconds < 0 and $seconds>60) {
			throw new DomainException("Input value for seconds has to between 0 and 60;");
		}
		$this->seconds = $seconds;

		if($timezoneOffset < -12 and $timezoneOffset > 12) {
			throw new DomainException("Input value for timezoneOffset has to between -12 and 12;");
		}
		$this->timezoneOffset = $timezoneOffset;
	}

	/**
	 * @return string
	 */
	public function __toString(){
		return "[".$this->hour.",".$this->minutes.",".$this->seconds.",".$this->timezoneOffset."]";
	}
}

/**-------TS61521-001D-3C54-4A25-D239-B0F8-3465-31073--------*/

/**
 * Google_Type_Var
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Type_Var
 * @package Google
 * @package Google_Type
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Type_Var extends Google_Type_Base {
	/**
	 * @var mixed $value
	 */
	private $value;
	/**
	 * constructor
	 * @param mixed $value
	 */
	public function __construct($value) {
		$this->value = $value;
	}
	/**
	 *
	 * @return string
	 */
	public function __toString(){
		return (string)$this->value;
	}
}

/**-------TS61521-1936-6C55-DBC9-822A-1FE5-6E1C-31073--------*/

/**
 * Google_Visualization
 * @desc Class to build a complete visualization.
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
/**
 * Google_Visualization
 *
 * @package Google
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 */
class Google_Visualization
{

	/**
	 * @var APISCRIPT
	 */
	const APISCRIPT = "http://www.google.com/jsapi";
	/**
	 * @var string $vizReference
	 */
	private $vizReference = "http://code.google.com/apis/visualization/documentation/gallery/";

	/**
	 * @var string $name
	 */
	private $name = "Base";

	/**
	 * @var Google_Config $config
	 */
	private $config;
	/**
	 * @var Google_Data $data
	 */
	private $data;

	/**
	 * @var Google_Format $format
	 */
	private $format;

	/**
	 * @var Google_DataView $dataView
	 */
	private $dataView;

	/**
	 * @var string $dataTable
	 */
	private $dataTable='data';

	/**
	 * @var object $dataTableObject
	 */
	private $dataTableObject;
	/**
	 * @var Google_Function $functionObject
	 */
	private $functionObject;

	/**
	 * @var Google_Package $packageObject
	 */
	private $packageObject;

	/**
	 * @param string $name
	 */
	public function __construct($name = null) {
		if($name and is_file(self::templateFile($name))){
			$this->name = $name;
		}
	}

	/**
	 * @return mixed
	 */
	public function getDataTable(){
		if($this->dataTableObject instanceof Google_Data_Table) {
			return $this->dataTableObject;
		}
		return $this->dataTable;
	}

	/**
	 * setDataTable
	 * @param mixed $dataTable
	 * @return void
	 */
	public function setDataTable($dataTable) {
		if($dataTable instanceof Google_Data_Table) {
			$this->dataTableObject = $dataTable;
		} else {
			$this->dataTable = $dataTable;
		}
	}

	/**
	 * setFunction
	 * @param Google_Function $function
	 */
	public function setFunction(Google_Function $function) {
		$this->functionObject = $function;
	}

	/**
	 * addFunction
	 * @param Google_Function $function
	 */
	public function addFunction(Google_Function $function) {
		$array	= is_array($this->functionObject)
				? $this->functionObject
				: array($this->functionObject);
		$array[] = $function;
		$this->functionObject = $array;
	}

	/**
	 * setPackage
	 * @param Google_Package $package
	 */
	public function setPackage(Google_Package $package) {
		$this->packageObject = $package;
	}


	/**
	 * setConfig
	 * @param Google_Config $config
	 */
	public function setConfig(Google_Config $config) {
		$this->config = $config;
		return $this;
	}

	/**
	 * addConfig
	 * @param Google_Config $config
	 * @return $this
	 */
	public function addConfig(Google_Config $config) {
		$this->config[] = $config;
		return $this;
	}

	/**
	 * setData
	 * @param gdBase $data
	 */
	public function setData(Google_Data_Interface $data) {
		$this->data = $data;
		return $this;
	}

	/**
	 * setFormat
	 * @param Google_Format_Default $format
	 */
	public function setFormat(Google_Format_Interface $format) {
		$this->format = $format;
		return $this;
	}

	/**
	 * setDataView
	 * @param Google_Data_View $dataView
	 * @return void
	 */
	public function setDataView(Google_Data_View $dataView) {
		$this->dataView = $dataView;
		return $this;
	}

	/**
	 * render
	 * @desc global render function
	 * @return string
	 */
	public function render() {

		$configObject = $this->config;
		$dataObject = $this->data;
		$formatObject = $this->format;
		$dataViewObject = $this->dataView;

		if($this->dataTableObject instanceof Google_Data_Table) {
			$dataTableObject = $this->dataTableObject;
		}

		if($this->functionObject instanceof Google_Function or is_array($this->functionObject)) {
			$functionObject = $this->functionObject;
		}

		if($this->packageObject instanceof Google_Package) {
			$packageObject = $this->packageObject;
		}

		ob_start();
		include_once(self::templateFile($this->name));
		$template = ob_get_contents();
		ob_end_clean();

		return $template;
	}

	/**
	 * templateFile
	 * @var static
	 * @param string $name
	 * @return string
	 */
	private static function templateFile($name) {
		return dirname(__FILE__).DIRECTORY_SEPARATOR.'Template'.DIRECTORY_SEPARATOR.$name.".phtml";
	}

	/**
	 * getReferenceLink
	 * @return string
	 */
	public function getReferenceLink() {
		$link = '<a href="'.$this->vizReference;
		$link .= strtolower($this->config->getConfigObject()->type);
		$link .= '.html" target="_blank">Goto Google Visualization Web API Gallery</a>';
		return $link;
	}

}

