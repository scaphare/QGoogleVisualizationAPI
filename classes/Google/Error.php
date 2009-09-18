<?php

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