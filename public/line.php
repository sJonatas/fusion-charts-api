<?php
	
$pathJS  = 'fusion-charts/FusionCharts.js';
$pathSWF = 'fusion-charts/'.FusionCharts_Type_Line::SWF_NAME;

$chart = new FusionCharts_Type_Line($pathSWF, $pathJS);

$categories = array('Jan', 'Feb', 'Mar', 'Apr');

$line1 = array(100, 200, 150, 210);
$line2 = array(50, 300, 90, 400);

$chart
	->setName('Line Chart Example')
	->setWidth(800)
	->setHeight(400)
	->addAttribute('showvalues', '0')
	->addCategories($categories)
	->setLabelRotate(true)
	->addLine('Line1', $line1)
	->addLine('Line2', $line2);

echo $chart->render();