<?php
	
$path_js 	= '/fusion-charts/'.FusionCharts_Type_Plot::JS_NAME;
$path_swf	= '/fusion-charts/'.FusionCharts_Type_Plot::SWF_NAME;

$chartPlot = new FusionCharts_Type_Plot($path_swf, $path_js);

$categories['values'] = array(1, 2, 3, 4);
$categories['labels'] = array('Jan', 'Feb', 'Mar', 'Apr');

$y_values = array(150, 120, 200, 220);

$chartPlot->setName('Chart Plot Example')
	->setWidth(800)
	->setHeight(400)
	->setXdescription('x values')
	->setYdescription('y values')
	->addAttribute('showyaxisvalues', '0');

$chartPlot->addCategories($categories['values'], $categories['labels']);
$chartPlot->addPlots($categories['values'], $y_values, 'values', '000080');

echo $chartPlot->render();
	
?>