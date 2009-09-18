<?php

include_once 'Google.merge.v_1_0.php';

$o = new Google_Data_Base;

$o->addColumn("0","year","string");
$o->addColumn("1","Sales","number");
$o->addColumn("2","Expenses","string");

$o->addNewRow();
$o->addStringCellToRow("2004");
$o->addNumberCellToRow(1000);
$o->addNumberCellToRow(400);

$o->addNewRow();
$o->addStringCellToRow("2005");
$o->addNumberCellToRow(1150);
$o->addNumberCellToRow(450);

$o->addNewRow();
$o->addStringCellToRow("2006");
$o->addNumberCellToRow(660);
$o->addNumberCellToRow(1122);

$o->addNewRow();
$o->addStringCellToRow("2007");
$o->addNumberCellToRow(855);
$o->addNumberCellToRow(900);

$o->addNewRow();
$o->addStringCellToRow("2008");
$o->addNumberCellToRow(545);
$o->addNumberCellToRow(827);


$c = new Google_Config("AreaChart", "My Title");
$c->setProperty("width", 300)->setProperty("height", 200);
//$c->setIsStacked(true);
$c->setPointSize(8);
$c->setColors(array("red", "blue"));
$c->setBorderColor("navy");
$c->setLineSize(3);
$c->setAxisBackgroundColor("#f5f5f5");

$v = new Google_Visualization();
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
