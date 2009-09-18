<?php


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
			if(is_file(dirname(__FILE__).DS."Config".DS.$type.".php")) {
				include_once(dirname(__FILE__).DS."Config".DS.$type.".php");
				$clsName = __CLASS__."_".$type;
				$this->default = new $clsName;
				$this->configObject = $this->default->getDefaultConfig($type);
				if(empty($this->configObject)) {
					$this->defaultConfig($title);
				}

			} else {
				$e = new Google_Exception_Config("configuration file for chart $type does not exist.");
				echo $e->show();
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