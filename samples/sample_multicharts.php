<?php

include_once 'Google.merge.v_1_0.php';

?><html>
<head>
<title>Data Source Requests > Using The Query Language</title>
<?php
$chartTypes = array("AreaChart", "BarChart", "ColumnChart", "LineChart", "PieChart", "Table");
if($_POST and array_key_exists("chartType", $_POST) and in_array($_POST["chartType"], $chartTypes)){
  $chartType = $_POST["chartType"];
  if(array_key_exists("qry", $_POST) and $_POST["useQuery"]=="on"){
    $query = $_POST["qry"];
  } else {
    $query = 'SELECT A,D WHERE D > 100 ORDER BY D';
  }
} else {
  $chartType = 'AreaChart';
  $query = 'SELECT A,D WHERE D > 100 ORDER BY D';
}

$id = 'viz';
$url = 'http://spreadsheets.google.com/tq?key=pCQbetd-CptGXxxQIG7VFIQ&pub=1';

# new visualization using template default
$v = new Google_Visualization("Default");

# register package
$p = new Google_Package(array("packages"=>array($chartType), "language"=>"de_DE"));
$v->setPackage($p); // set package object to visualization

# setup chart
$chart = new Google_Chart($chartType, Google_Base::getElementById($id));
$options = new Google_Config($chartType);
$options->setProperty("width", 550);
$chart->draw("data", $options);

# init functions
$f1 = new Google_Function('drawVisualization');
$f2 = new Google_Function('handleQueryResponse', array('response'));

# setup query
$q = new Google_Data_Query($url);
$q->setQuery($query);
$q->send($f2->getName());

$f1->add($q);
$f1->setCallBack();

$v->setFunction($f1);


# setup response
$qr = new Google_Data_QueryResponse();
$qr->asVar( $chart->getDataTable() )->getDataTable();

$f2->add($qr->render(true));

$chart->setDataTable("visualization");
$f2->add($chart->render());

$v->addFunction($f2);

echo $v->render();

?>
</head>
<body style="font-family: Arial;border: 0 none;">
	<h1>Data Source Requests > Using The Query Language</h1>
    <div>
    <form method="post">
    <select name="chartType">
    <?php foreach($chartTypes as $name):?>
      <?php if($chartType==$name):?>
      <option value="<?php echo $name?>" selected="selected"><?php echo $name;?></option>
      <?php else:?>
      <option value="<?php echo $name?>"><?php echo $name;?></option>
      <?php endif;?>
    <?php endforeach;?>
      <textarea name="qry"><?php echo $query?></textarea>
      <input type="checkbox" name="useQuery" <?php echo ($_POST["useQuery"]=="on"?'checked="checked"':"")?>/>
    </select>
    <input type="submit" value="ask" />
    </form>
    </div>
	<div id="<?php echo $id;?>" style="border:2px solid #ccc; margin:0 30px 30px 0;height: 400px; width: 600px;float:left;overflow:auto"></div>

</html>