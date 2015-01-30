<?php

/**
 * class to create a chart Pie3D.swf from fusioncharts.com
 * @author Lucas de Oliveira
 */
 
class FusionCharts_Type_Pie extends FusionCharts_Chart_Abstract 
{
	const SWF_NAME = 'Pie3D.swf';
	
	private $slices = array();
	
	/**
	 * @param 	string 	$name
	 * @param 	integer $value
	 */
	public function addSlice($name, $value, $color)
	{
		$this->slices[] = "<set label='".$name."' value='".$value."' color='".$color."' />";
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FusionChartAbstract::getXML()
	 */
	public function getXML()
	{
		$chart_xml  = "<chart caption='".$this->name."' ".implode(' ', $this->attribute)." theme='fint'>";
		$chart_xml .= implode(' ', $this->slices);
		$chart_xml .= "</chart>";
		
		return $chart_xml;
	}
	
}