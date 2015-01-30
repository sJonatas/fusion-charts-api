<?php
	
$path_js 	= '/fusion-charts/'.FusionCharts_Type_Pie::JS_NAME;
$path_swf	= '/fusion-charts/'.FusionCharts_Type_Pie::SWF_NAME;

$chartPie = new FusionCharts_Type_Pie($path_swf, $path_js);

$values = array(
	'Jan' => 100,
	'Feb' => 200,
	'Mar' => 150,
	'Apr' => 210
);

$chartPie->setName('Chart Pie Example')
	->setWidth(800)
	->setHeight(400)
	->addAttribute('showlegend', '1')
	->addAttribute('showlabels', '0');

foreach ($values as $key => $value){
	$chartPie->addSlice($key, $value, null);
}

echo $chartPie->render();
	
?>