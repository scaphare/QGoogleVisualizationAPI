<?php

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