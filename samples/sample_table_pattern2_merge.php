<?php

include_once 'Google.merge.v_1_0.php';

// main
$v = new Google_Visualization("Table_Format");

// config
$c = new Google_Config("Table");
$c->setAllowHtml(true); // using dynamic setter
$c->setShowRowNumber(true);

// format
$f = new Google_Format_Pattern;
$f->pattern('<a href="mailto:{1}">{0}</a>');
$f->format("data",array(0,1));

// data view

$d = new Google_Data_View;
$d->setColumns(array(0));

// data
$o = Google_Data::getInstance()->getDataObject();

$o->addColumn("0","Name","string");
$o->addColumn("1","Email","string");

$o->addNewRow();
$o->addStringCellToRow("Tom");
$o->addStringCellToRow("scaphare@gmail.com");

$o->addNewRow();
$o->addStringCellToRow("Mike");
$o->addStringCellToRow("mike@gmail.com");

$v->setConfig($c);
$v->setData($o);
$v->setFormat($f);
$v->setDataView($d);

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
