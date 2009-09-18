QGoogleVisualizationApi v1.0
================================
Google Visualization API for PHP 5+
================================
ver 1.0.1

- complete overhaul and redesign

# Intro
# Configuration
# Data + DataView
# Visualization
# Formatter


## Intro

After publishing several minor releases of the QGoogleVisualizationApi I decided
to completely overhaul this API.

Basically I separated the API into following sections:
- Configuration
- Data Handling
- Visualization
- Formatting

To reduce transfer volumina, the API uses the ability of the Google Web API to
work with JSON objects. Config and data objects are jsonified. The - outer -
visualization object renders the scriptings finally. Now, it is possible
to easily implement further scripts with deviating script logic. You just
have to create a template with a unique name. Inside the template you can
use php or pure javascript to write your own application.



## Configuration

The configuration section consists of following parts:
- Base Config Class => Google_Config
- folder ./Google/Config => contains Chart Type Config Object which all are childs
  of the Chart Type Default Object

Config Objects come along with default settings. The nested php stdClass is
parted into 3 sections:
- global properties
- chart type properties
- viewport properties

Global properties are commonly used by template scripts, Chart type properties
are being used by the defined chart type. The viewport properties can be used to
format the chart output container (width, height, class).


Configuring a chart object is easy. You only need to know which properties
a chart can handle. The Google Reference (@see http://code.google.com/apis/visualization/documentation/dev/index.html)
gives you an image of these properties.
Each chart object has its own set of properties.

For QGoogleVisualizationAPI you need to know that the chart properties are
a sub set of the configuration object. The main properties as provider, scope,
version etc. are used to address a javascript library. By the way, it is
possible to enhance the api to provide custom libraries which use the google api.
You need to write a js adapter class which hooks onto the provider
and scope property. Somewhat later I will go into detail.

The default configuration:

	// global properties
	$objChart->type = stdClass;
	$objChart->provider = "google";
	$objChart->scope = "visualization";
	$objChart->version = 1;
	$objChart->language = "de_DE";
	$objChart->port = "chart";
	// chart type dependent properties
	$objChart->props = new stdClass();
	$objChart->props->title = $title;
	$objChart->props->height = 600;
	$objChart->props->width = 800;
	// viewport properties
	$objChart->viewport = new stdClass();
	$objChart->viewport->height = 680;
	$objChart->viewport->width = 800;


sample usage:

	$c = new Google_Config("AreaChart", "My Title");
	$c->setProperty("width", 300);
	$c->setProperty("height", 200);

	echo $c;

output:

	{"type":"AreaChart","provider":"google",scope:"visualization","version":1,"language":"de_DE","port":"chart",props:{title:"My Title",height:200,width:300},"viewport":{height:680,width:800}}

Within a template you can access the object like this:

sample:

<script>
	var cObj = --output here from above--;
	var chartType = cObj.type; // referencing the chart type;
	var viewportWidth = cObj.viewport.width // get the width of the viewport container
</script>

Now you can easily write your custom script without the need to handle with
php api objects and methods.

What does this mean?

A template is set in the constructor of Google_Visualization object. The api comes
a long with some default templates used by the different charts. If you need
your a deviating javascript application logic or further functionality then
implement your own template, where you provide these capabilities.

Call it as shown below:

	$v = new Google_Visualization("MySpecialTemplate"); // template file name => ./classes/Google/Template/MySpecialTemplate.phtml



## Data Handling

sample usage:

	$o = Google_Data::getInstance()->getDataObject();
	//$o = new Google_Data_Base;

	$o->addColumn("0","Country","string");
	$o->addColumn("1","Sales","number");
	$o->addColumn("1","Expenses","number");

	$o->addNewRow();
	$o->addStringCellToRow("US");
	$o->addNumberCellToRow(10000, "400.0");
	$o->addNumberCellToRow(8000, "400.0");

	echo $o;


The Google_Data object gives the access to following data objects:
- Google_Data_Base
- Google_Data_Extend (supports mysql resources)

The API uses the JSON Response Format for data objects.
Google_Data_Base objects offer methods to setup a data structure which finally is converted
into this format.




