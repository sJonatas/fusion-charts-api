<?php
	
$path_js 	= 'fusion-charts/'.FusionCharts_Type_ColumnLine::JS_NAME;
$path_swf	= 'fusion-charts/'.FusionCharts_Type_ColumnLine::SWF_NAME;

$chartColumns = new FusionCharts_Type_ColumnLine($path_swf, $path_js);

$categories = array('Jan', 'Feb', 'Mar', 'Apr');
$values 	= array(100, 200, 150, 210);
$lines 		= array(50, 120, 90, 160);

$chartColumns->setName('Chart ColumnsLine Example')
	->setWidth(800)
	->setHeight(400)
	->setXdescription('x values')
	->setYdescription('y values')
	->addAttribute('showyaxisvalues', '0')
	->addCategories($categories)
	->addColumns('Values', $values)
	->addLine('Line values', $lines);

echo $chartColumns->render();

?>