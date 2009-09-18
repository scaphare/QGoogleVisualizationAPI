<?php

include_once 'Google.merge.v_1_0.php';

// main
$v = new Google_Visualization("Table_Format");

// config
$c = new Google_Config("Table");
$c->setProperty("allowHtml", true);

// format
$f = Google_Format::factory("Number");
$f->prefix = '&euro;';
$f->negativeColor = 'red';
$f->negativeParens = true;
$f->format("data",1);

$c->setProperty("showRowNumber", true);

// data
$o = Google_Data::getInstance()->getDataObject();

$o->addColumn("0","Department","string");
$o->addColumn("1","Revenues","number");


$o->addNewRow();
$o->addStringCellToRow("Shoes");
$o->addNumberCellToRow(-5.4);

$o->addNewRow();
$o->addStringCellToRow("Sports");
$o->addNumberCellToRow(12.5);

$o->addNewRow();
$o->addStringCellToRow("Toys");
$o->addNumberCellToRow(21.2);

$o->addNewRow();
$o->addStringCellToRow("Food");
$o->addNumberCellToRow(24.2);


$v->setConfig($c);
$v->setData($o);
$v->setFormat($f);

?><html>
<head>
<?php
	echo $v->render();
?>
</head>
<body>
	<div id="chart"></div>
</body>
</html>
