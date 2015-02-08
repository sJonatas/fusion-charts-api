<?php
	
$pathJS = 'fusion-charts/FusionCharts.js';
$pathSWF = 'fusion-charts/'.FusionCharts_Type_Pie::SWF_NAME;

$chart = new FusionCharts_Type_Pie($pathSWF, $pathJS);

$values = array(
	'Jan' => 100, 
	'Feb' => 200, 
	'Mar' => 150, 
	'Apr' => 210
);

$chart
	->setName('Chart Pie Example')
	->setWidth(800)
	->setHeight(400)
	->addAttribute('showlegend', '1')
	->addAttribute('showlabels', '0');

foreach ($values as $name => $value){
	$attribs = array('issliced' => '1');
	
	$chart->addSlice($name, $value, $attribs);
}

echo $chart->render();