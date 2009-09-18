<?php

include_once '../config.inc.php';

$v = new Google_Visualization("Gauge");
$c = new Google_Config("Gauge");
$o = new Google_Data_Base;

// config
$c->defaultConfig("MyTestGauge");
$c->setProperty("min",0);
$c->setProperty("max",280);
$c->setProperty("yellowFrom",200);
$c->setProperty("yellowTo",250);
$c->setProperty("redFrom",250);
$c->setProperty("redTo",280);
$c->setProperty("minorTicks",5);

$v->setConfig($c);

// data
$o->addColumn("0","Engine","number");
$o->addColumn("1","Torpedo","number");

$o->addNewRow();
$o->addNumberCellToRow(120, "400.0");
$o->addNumberCellToRow(80, "400.0");

$v->setData($o);

?><html>
<head>
<?php
	echo $v->render();
?>
</head>
<body>
	<div id="chart"></div>
	<input type='button' value='Go Faster' onclick='changeTemp(1)' />
	<input type='button' value='Slow down' onclick='changeTemp(-1)' />

</body>
</html>
