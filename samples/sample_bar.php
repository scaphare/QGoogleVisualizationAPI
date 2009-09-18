<?php

include_once 'Google.merge.v_1_0.php';


$c = new Google_Config("AreaChart", "My Title");
$c->setProperty("width", 300);
$c->setProperty("height", 200);


$v = new Google_Visualization();
$c = new Google_Config("AreaChart");

// data
$o = Google_Data::getInstance()->getDataObject();

$o->addColumn("0","Country","string");
$o->addColumn("1","Sales","number");
$o->addColumn("1","Expenses","number");

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
	<div id="chart"></div>
</body>
</html>
