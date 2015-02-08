<?php

/**
 * Classe to create chart with MSLine.swf from fusioncharts.com
 * @package FusionCharts
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
class FusionCharts_Type_Line extends FusionCharts_Chart_Abstract 
{
	const SWF_NAME = 'MSLine.swf';
	
	private $lines = array();
	private $categories = array();
	
	/**
	 * @param array $categories
	 * @return FusionCharts_Type_Line
	 */
	public function addCategories(array $categories)
	{
		$category = array();
		
		$category[] = "<categories>";
		foreach ($categories as $categ) $category[] = "<category label='" . $categ . "' />";
		$category[] = "</categories>";
		
		$this->categories = implode(' ', $category);
		return $this;
	}
	
	/**
	 * @param string $serieName
	 * @param array $values
	 * @param array $attributes
	 * @return FusionCharts_Type_Line
	 */
	public function addLine($serieName, array $values, array $attributes = null)
	{
		$line = array();
		
		$defaultAttribs = array(
			'seriesname' => $serieName
		);
		
		$xmlAttribs = $this->getAsXMLAttributes($defaultAttribs) . $this->getAsXMLAttributes($attributes);
		
		$line[] = "<dataset " . $xmlAttribs . ">";
		foreach ($values as $value) $line[] = "<set value='" . $value . "' />";
		$line[] = "</dataset>";
		
		$this->lines[] = implode(' ', $line);
		return $this;
	}
	
	/**
	 * @param boolean $rotate
	 * @return FusionCharts_Type_Line
	 */
	public function setLabelRotate($rotate = true)
	{
		if ($rotate) $this->attribute[] = "labelDisplay='Rotate' slantLabels='1'";
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FusionCharts_Chart_Abstract::getXML()
	 */
	public function getXML()
	{
		$mainAttribs = array(
			'caption' => $this->name
		);
		
		$xmlAttrbs = $this->getAsXMLAttributes($mainAttribs) . implode(' ', $this->attribute);
		
		$xmlChart = "<chart " . $xmlAttrbs . " >" . $this->categories . implode(' ', $this->lines) . "</chart>";
		
		return $xmlChart;
	}
}