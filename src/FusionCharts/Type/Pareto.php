<?php

/**
 * Classe to create chart with Pareto3D.swf from fusioncharts.com
 * @package FusionCharts
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
class FusionCharts_Type_Pareto extends FusionCharts_Chart_Abstract 
{
	const SWF_PATH = 'Pareto3D.swf';
	
	private $xDesc;
	private $yDesc;
	private $data = array();
	
	/**
	 * @param string $xDesc
	 * @return FusionCharts_Type_Pareto
	 */
	public function setXdescription($xDesc)
	{
		$this->xDesc = $xDesc;
		return $this;
	}
	
	/**
	 * @param string $yDesc
	 * @return FusionCharts_Type_Pareto
	 */
	public function setYdescription($yDesc)
	{
		$this->yDesc = $yDesc;
		return $this;
	}
	
	/**
	 * @param string $description
	 * @param string $value
	 * @param array $attributes
	 * @return FusionCharts_Type_Pareto
	 */
	public function addColumn($description, $value, array $attributes = null)
	{
		$defultAttribs = array(
			'label' => $description,
			'value' => $value
		);
		
		$xmlAttribs = $this->getAsXMLAttributes($defultAttribs) . $this->getAsXMLAttributes($attributes);
		
		$this->data[] = "<set " .$xmlAttribs. " />";
		return $this;
	}
	
	/**
	 * @param booelan $rotate
	 * @return FusionChartColumnLine
	 */
	public function setLabelRotate($rotate = true)
	{
		if ($rotate) $this->attribute[] = "labelDisplay='Rotate' slantLabels='1'";
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
			'xaxisname' => $this->xDesc,
			'pyaxisname' => $this->yDesc,
			'animation' => '1'
		);
		
		$xmlAttribs = $this->getAsXMLAttributes($mainAttribs) .  implode(' ', $this->attribute) ;
		
		$xmlChart  = "<chart " . $xmlAttribs . " > " . implode(' ', $this->data) .  " </chart>";
		
		return $xmlChart;
	}
	
}