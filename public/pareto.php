<?php
	
$pathJS = 'fusion-charts/FusionCharts.js';
$pathSWF = 'fusion-charts/'.FusionCharts_Type_Pareto::SWF_PATH;

$chart = new FusionCharts_Type_Pareto($pathSWF, $pathJS);

$values = array(
	'jan' => 100,
	'feb' => 200,
	'mar' => 150,
	'apr' => 210
);

$chart
	->setName('Chart Pareto Example')
	->setWidth(800)
	->setHeight(400)
	->setLabelRotate(true)
	->setXdescription('x values')
	->setYdescription('y values')
	->addAttribute('showyaxisvalues', '0');

foreach ($values as $description => $value) {
	$chart->addColumn($description, $value);
}

echo $chart->render();