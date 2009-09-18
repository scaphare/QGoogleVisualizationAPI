<?php

include_once 'Google.merge.v_1_0.php';

?><html>
<head>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load('visualization', '1', {packages: ['table']});
</script>
<script>
<?php

$o = new Google_Data_Base();

$o->addColumn("0","Name","string");
$o->addColumn("1","Age","string");
$o->addColumn("2","Instrument","string");
$o->addColumn("3","Color","string");

$o->addNewRow();
$o->addStringCellToRow("John");
$o->addStringCellToRow(24);
$o->addStringCellToRow("Guitar");
$o->addStringCellToRow("Blue");

$o->addNewRow();
$o->addStringCellToRow("Paul");
$o->addStringCellToRow(25);
$o->addStringCellToRow("Guitar");
$o->addStringCellToRow("Red");

$o->addNewRow();
$o->addStringCellToRow("George");
$o->addStringCellToRow(22);
$o->addStringCellToRow("Bass");
$o->addStringCellToRow("Yellow");

$o->addNewRow();
$o->addStringCellToRow("Ringo");
$o->addStringCellToRow(25);
$o->addStringCellToRow("Drums");
$o->addStringCellToRow("Black");


$dt = new Google_Data_Table;
$dt->setDataTable("dataTable");
$dt->assignData($o);

echo $dt;

?>

function drawVisualization() {
<?php

$dataVar = "table1";
$dataVar2 = "table2";
$dataVar3 = "table3";
$dataTable = "dataTable";
$options = null;

$chart = new Google_Chart("Table", $dataVar);
$chart->draw($dataTable, $options);

echo Google_Base::getVarById($dataVar)."\n";
echo Google_Base::getVarById($dataVar2)."\n";
echo Google_Base::getVarById($dataVar3)."\n";

echo $chart;

$dataView = new Google_Data_View();
$dataView->setViewTable("dataView1");
$dataView->setDataTable($dataTable);
$dataView->setColumns(array(0,2));

echo $dataView;

$chart2 = new Google_Chart("Table", $dataVar2);
$chart2->draw($dataView, $options);

echo $chart2;

$dataView2 = new Google_Data_View();
$dataView2->setViewTable("dataView2");
$dataView2->setDataTable($dataTable);
$dataView2->setColumns(array(0,1,3));

echo $dataView2;

$chart3 = new Google_Chart("Table", $dataVar3);
$chart3->draw($dataView2, $options);

echo $chart3;
?>
}
 google.setOnLoadCallback(drawVisualization);
</script>
</head>
<body style="font-family: Arial;border: 0 none;">
    <div>Original Data Table</div>
    <div id="table1"></div>
    <br />
    <div>A Data View</div>
    <div id="table2"></div>
    <br />
    <div>Another Data View</div>
    <div id="table3"></div>
  </body>
</html>