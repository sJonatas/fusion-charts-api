<?php
	
$pathJS = 'fusion-charts/FusionCharts.js';
$pathSWF = 'fusion-charts/'.FusionCharts_Type_ColumnLine::SWF_NAME;

$chart = new FusionCharts_Type_ColumnLine($pathSWF, $pathJS);

$categories = array('Jan', 'Feb', 'Mar', 'Apr');

$values = array(100, 200, 150, 210);
$lines = array(50, 120, 90, 160);

$chart
	->setName('Chart ColumnsLine Example')
	->setWidth(800)
	->setHeight(400)
	->setLabelRotate(true)
	->setXdescription('x values')
	->setYdescription('y values')
	->addAttribute('showyaxisvalues', '0')
	->addCategories($categories)
	->addColumns('Values', $values)
	->addLine('Line values', $lines);

echo $chart->render();