<?php
	
$path_js 	= '/fusion-charts/'.FusionCharts_Type_Pareto::JS_NAME;
$path_swf	= '/fusion-charts/'.FusionCharts_Type_Pareto::SWF_PATH;

$chartPareto = new FusionCharts_Type_Pareto($path_swf, $path_js);

$values = array(
	'jan' => 100,
	'feb' => 200,
	'mar' => 150,
	'apr' => 210
);

$chartPareto->setName('Chart ColumnsLine Example')
	->setWidth(800)
	->setHeight(400)
	->setXdescription('x values')
	->setYdescription('y values')
	->addAttribute('showyaxisvalues', '0');

foreach ($values as $key => $value){
	$chartPareto->addColumn($key, $value, null);
}

echo $chartPareto->render();
	
?>