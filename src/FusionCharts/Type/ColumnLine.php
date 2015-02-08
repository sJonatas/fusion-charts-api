<?php
	
/**
 * Classe to create chart with MSColumn3DLineDY.swf from fusioncharts.com
 * @package FusionCharts
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
class FusionCharts_Type_ColumnLine extends FusionCharts_Chart_Abstract 
{
	const SWF_NAME = 'MSColumn3DLineDY.swf';
	
	private $xDesc;
	private $yDesc;
	private $columns = array();
	private $lines = array();
	private $categories = array();
	private $staticLines = array();
	
	/**
	 * @param	string $xDesc
	 * @return	FusionChartColumnLine
	 */
	public function setXdescription($xDesc)
	{
		$this->xDesc = $xDesc;
		return $this;
	}
	
	/**
	 * @param 	string $yDesc
	 * @return	FusionChartColumnLine
	 */
	public function setYdescription($yDesc)
	{
		$this->yDesc = $yDesc;
		return $this;
	}
	
	/**
	 * @param string $name
	 * @param array $values
	 * @param array $attributes
	 * @return FusionCharts_Type_ColumnLine
	 */
	public function addColumns($name, array $values, array $attributes = null)
	{
		$defaultAttibs = array('seriesname' => $name);
		$xmlAtribs = $this->getAsXMLAttributes($defaultAttibs) . $this->getAsXMLAttributes($attributes);
		
		$column = array();
		
		$column[] = '<dataset ' . $xmlAtribs . '>';
		foreach ($values as $value)	$column[] = "<set value='" . $value . "' />";
		$column[] = "</dataset>";
		
		$this->columns[] = implode(' ', $column);
		return $this;
	}
	
	/**
	 * @param string $name
	 * @param array $values
	 * @param string $color
	 * @return FusionCharts_Type_ColumnLine
	 */
	public function addLine($name, array $values, array $attributes = null)
	{
		$defaultAttibs = array(
			'seriesname' => $name,
			'parentyaxis' => 'S',
			'renderas' => 'Line'
		);
		$xmlAtribs = $this->getAsXMLAttributes($defaultAttibs) . $this->getAsXMLAttributes($attributes);
		
		$line = array();
		
		$line[] = "<dataset " . $xmlAtribs . ">";
		foreach ($values as $value)	$line[] = "<set value='".$value."' />";
		$line[] = "</dataset>";
		
		$this->lines[] = implode(' ', $line);
		return $this;
	}
	
	/**
	 * @param array $names
	 * @return FusionChartColumnLine
	 */
	public function addCategories(array $names, array $attributes = null)
	{
		$xmlAtribs = $this->getAsXMLAttributes($attributes);
		
		$category = array();
		
		$category[] = "<categories " . $xmlAtribs . ">";
		foreach ($names as $name) $category[] = "<category label='" . $name . "' />";
		$category[] = "</categories>";
			
		$this->categories = implode(' ', $category);
		return $this;
	}
	
	/**
	 * @param 	string 	$name
	 * @param 	integer $value
	 * @param 	string 	$color
	 * @return 	FusionChartColumnLine
	 */
	public function addStaticLine($name, $value, $color, array $attributes = null)
	{
		$defaultAttribs = array(
			'startvalue' => $value,
			'displayvalue' => $name,
			'color' => $color,
			'valueonright' => '1',
			'displayvalue' => 'High',
			'showontop' => '1',
			'thickness' => '2'
		);
		
		$xmlAttribs = $this->getAsXMLAttributes($defaultAttribs) . $this->getAsXMLAttributes($attributes);
		
		$this->staticLines[] = "<line " . $xmlAttribs . " />";
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
		
		$xmlAttribs = $this->getAsXMLAttributes($mainAttribs) . implode(' ', $this->attribute);
		
		$xmlChart  = "<chart " . $xmlAttribs . " >" .  $this->categories . implode(' ', $this->columns) . implode(' ', $this->lines);
		$xmlChart .= "<trendlines>".implode(' ', $this->staticLines)."</trendlines>";
		$xmlChart .= "</chart>";
	
		return $xmlChart;
	}	
}