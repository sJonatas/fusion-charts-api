<?php

/**
 * Classe to create chart with Pie3D.swf from fusioncharts.com
 * @package FusionCharts
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
class FusionCharts_Type_Pie extends FusionCharts_Chart_Abstract 
{
	const SWF_NAME = 'Pie3D.swf';
	
	private $slices = array();
	
	/**
	 * @param string $name
	 * @param string $value
	 * @param array $attributes
	 * @return FusionCharts_Type_Pie
	 */
	public function addSlice($name, $value, array $attributes = null)
	{
		$defaultAttribs = array(
			'label' => $name,
			'value' => $value
		);
		
		$attribs = $this->getAsXMLAttributes($defaultAttribs) . $this->getAsXMLAttributes($attributes);
		
		$this->slices[] = "<set " . $attribs . " />";
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FusionChartAbstract::getXML()
	 */
	public function getXML()
	{
		$mainAttribs = array(
			'caption' => $this->name,
			'theme' => 'fint'
		);
		
		$xmlAttribs = $this->getAsXMLAttributes($mainAttribs) . implode(' ', $this->attribute);
		
		$xmlChart = "<chart " . $xmlAttribs . " >" . implode(' ', $this->slices) . "</chart>";
		
		return $xmlChart;
	}
}