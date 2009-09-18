<?php

include_once 'Google.merge.v_1_0.php';


// main
$v = new Google_Visualization("Table_Format");

// config
$c = new Google_Config("Table");
$c->setProperty("allowHtml", true);

// format
$f = Google_Format::factory("Bar");
$f->min = -10000;
$f->max = 10000;
$f->drawZeroLine = true;
$f->colorNegative = 'red';
$f->showValue = false;
$f->width = 250;
$f->format("data",1);

$c->setProperty("showRowNumber", true);

// data
$o = new Google_Data_Base;

$o->addColumn("0","Country","string");
$o->addColumn("1","Sales","number");
$o->addColumn("2","Expenses","number");

$o->addNewRow();
$o->addStringCellToRow("US");
$o->addNumberCellToRow(10000);
$o->addNumberCellToRow(8000);

$o->addNewRow();
$o->addStringCellToRow("CA");
$o->addNumberCellToRow(-7000);
$o->addNumberCellToRow(5000);

$o->addNewRow();
$o->addStringCellToRow("CN");
$o->addNumberCellToRow(8000);
$o->addNumberCellToRow(12000);

$o->addNewRow();
$o->addStringCellToRow("UK");
$o->addNumberCellToRow(7000);
$o->addNumberCellToRow(15000);


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
