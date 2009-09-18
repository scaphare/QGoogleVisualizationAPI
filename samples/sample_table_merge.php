<?php

include_once 'Google.merge.v_1_0.php';

$v = new Google_Visualization("Table");
$c = new Google_Config("Table");
$c->setProperty("showRowNumber", true);

// data
$o = new Google_Data_Base();

$o->addColumn("0","Country","string");
$o->addColumn("1","Sales","number");
$o->addColumn("2","Expenses","number");

$o->addNewRow();
$o->addStringCellToRow("US");
$o->addNumberCellToRow(10000, "400.0");
$o->addNumberCellToRow(8000, "400.0");

$o->addNewRow();
$o->addStringCellToRow("CA");
$o->addNumberCellToRow(7000, "400.0");
$o->addNumberCellToRow(5000, "400.0");

$o->addNewRow();
$o->addStringCellToRow("CN");
$o->addNumberCellToRow(8000, "400.0");
$o->addNumberCellToRow(12000, "400.0");

$o->addNewRow();
$o->addStringCellToRow("UK");
$o->addNumberCellToRow(7000, "400.0");
$o->addNumberCellToRow(15000, "400.0");


$v->setConfig($c);
$v->setData($o);

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
