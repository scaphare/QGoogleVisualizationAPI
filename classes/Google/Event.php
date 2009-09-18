<?php

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