<?php
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