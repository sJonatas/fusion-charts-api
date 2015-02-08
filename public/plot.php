<?php
	
$pathJS = 'fusion-charts/FusionCharts.js';
$pathSWF = 'fusion-charts/'.FusionCharts_Type_Plot::SWF_NAME;

$chart = new FusionCharts_Type_Plot($pathSWF, $pathJS);

$values = array(100, 200, 300, 400);
$labels = array('Jan', 'Feb', 'Mar', 'Apr');

$yValues = array(150, 120, 200, 220);

$chart
	->setName('Chart Plot Example')
	->setWidth(800)
	->setHeight(400)
	->setLabelRotate(true)
	->setXdescription('x values')
	->setYdescription('y values')
	->addAttribute('showyaxisvalues', '0');

$chart->addCategories($values, $labels);
$chart->addPlots($values, $yValues, 'values', '000080');

echo $chart->render();