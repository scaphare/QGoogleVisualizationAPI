<?php

include_once 'Google.merge.v_1_0.php';


// main
$v = new Google_Visualization("Table_Format");

// config
$c = new Google_Config("Table");
$c->setProperty("allowHtml", true);

// format
$f = Google_Format::factory("Date");
$f->formatType("short"); // medium|long
$f->format("data",1);

$c->setProperty("showRowNumber", true);

// data
$o = Google_Data::getInstance()->getDataObject();

$o->addColumn("0","Employee","string");
$o->addColumn("1","since","date");


$o->addNewRow();
$o->addStringCellToRow("Mike");
$o->addDateCellToRow(2001,10,1);

$o->addNewRow();
$o->addStringCellToRow("Luke");
$o->addDateCellToRow(2002,1,1);

$o->addNewRow();
$o->addStringCellToRow("Carl");
$o->addDateCellToRow(2002,6,1);

$o->addNewRow();
$o->addStringCellToRow("Tom");
$o->addDateCellToRow(2009,6,1);


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
	<div id="selectedValue"></div>
	<div id="chart"></div>
</body>
</html>
