<?php

/**
 * class to create a chart Pareto3D.swf from fusioncharts.com
 * @author Lucas de Oliveira
 */

class FusionCharts_Type_Pareto extends FusionCharts_Chart_Abstract 
{
	const SWF_PATH = 'Pareto3D.swf';
	
	private $x_desc;
	
	private $y_desc;
	
	private $data = array();
	
	/**
	 * @param	string $x_desc
	 * @return	FusionChartPareto
	 */
	public function setXdescription($x_desc)
	{
		$this->x_desc = $x_desc;
		return $this;
	}
	
	/**
	 * @param 	string $y_desc
	 * @return	FusionChartPareto
	 */
	public function setYdescription($y_desc)
	{
		$this->y_desc = $y_desc;
		return $this;
	}
	
	/**
	 * @param	booelan $rotate
	 * @return	FusionChartPareto
	 */
	public function setLabelRotate($rotate = true)
	{
		if ($rotate) $this->attribute[] = "labelDisplay='Rotate' slantLabels='1'";
		return $this;
	}
	
	/**
	 * @param 	string $name
	 * @param 	string $value
	 * @return	FusionChartPareto
	 */
	public function addAttribute($name, $value)
	{
		$this->attribute[] = "{$name}='{$value}'";
		return $this;
	}
	
	/**
	 * @param	string 	$desc
	 * @param 	integer $value
	 */
	public function addColumn($desc, $value, $color)
	{
		$this->data[] = "<set value='{$value}' color='{$color}' label='{$desc}' />";
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FusionChartAbstract::getXML()
	 */
	public function getXML()
	{
		$xml_chart  = "<chart caption='{$this->name}' xaxisname='{$this->x_desc}' pyaxisname='{$this->y_desc}' animation='1' ".implode(' ', $this->attribute)." > ";
		$xml_chart .= implode(' ', $this->data)." </chart>";
		
		return $xml_chart;
	}
	
}