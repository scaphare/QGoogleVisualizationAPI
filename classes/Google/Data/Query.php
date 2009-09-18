<?php
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