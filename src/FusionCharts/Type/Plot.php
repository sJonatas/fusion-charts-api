<?php

/**
 * Classe to create chart with Scatter.swf from fusioncharts.com
 * @package FusionCharts
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */

class FusionCharts_Type_Plot extends FusionCharts_Chart_Abstract 
{
	const SWF_NAME = 'Scatter.swf';
	
	private $xDesc;
	private $yDesc;
	private $labels;
	private $categories	= array();
	private $plots = array();
	private $trendlines = array();
	private $staticLines = array();
	
	/**
	 * @param string $xDesc
	 * @return FusionCharts_Type_Plot
	 */
	public function setXdescription($xDesc)
	{
		$this->xDesc = $xDesc;
		return $this;
	}
	
	/**
	 * @param string $yDesc
	 * @return FusionChartPlot
	 */
	public function setYdescription($yDesc)
	{
		$this->yDesc = $yDesc;
		return $this;
	}
	
	/**
	 * @param array $values
	 * @param array $labels
	 * @param array $attributes
	 * @return FusionCharts_Type_Plot
	 */
	public function addCategories(array $values, array $labels, array $attributes = null)
	{
		$this->labels = $labels;
		$this->categories = array();
		
		foreach ($values as $index => $value){
			$defaultAttribs = array(
				'label' => $labels[$index],
				'x' => $value,
				'showVerticalLine' => '1'
			);
			
			$xmlAttribs = $this->getAsXMLAttributes($defaultAttribs) . $this->getAsXMLAttributes($attributes);
			
			$this->categories[] = "<category " . $xmlAttribs . " />";
		}
		
		return $this;
	}
	
   /**
    * @param array $xValues
    * @param array $yValues
    * @param string $serieName
    * @param string $color
    * @param array $attributes
    * @return FusionCharts_Type_Plot
    */
	public function addPlots(array $xValues, array $yValues, $serieName, $color, array $attributes = null)
	{
		$defaultAttribs = array(
			'seriesname' => $serieName,
			'color' => $color,
			'anchorbordercolor' => $color,
			'anchorradius' => '4',
			'anchorsides' => '4',
			'anchorbgcolor' => $color
		);
		
		$xmlAttribs = $this->getAsXMLAttributes($defaultAttribs) . $this->getAsXMLAttributes($attributes);
		
		$this->plots[] = "<dataset " . $xmlAttribs . " >";
		
		foreach ($xValues as $index => $xValue) {
			$tagAttribs = array(
				'y' => $yValues[$index],
				'x' => $xValue,
				'hoverText' => $this->labels[$index] . ', ' . $yValues[$index]
			);
			
			$this->plots[] = "<set " . $this->getAsXMLAttributes($tagAttribs) . " />";
		}
		
		$this->plots[] = "</dataset>";
		
		return $this;
	}
	
	/**
	 * @param string $serieName
	 * @param string $endValue
	 * @param string $color
	 * @param array $attributes
	 * @return FusionCharts_Type_Plot
	 */
	public function addTrendLine($serieName, $endValue, $color, array $attributes = null)
	{
		$defaultAttribs = array(
			'startvalue' => $serieName,
			'endvalue' => $endValue,
			'istrendzone' => '1',
			'color' => $color,
			'alpha' => '10'
		);
		
		$xmlAttribs = $this->getAsXMLAttributes($defaultAttribs) . $this->getAsXMLAttributes($attributes);
		
		$this->trendlines[] = "<line " . $xmlAttribs . " />";
		return $this;
	}
	
	/**
	 * @param string $name
	 * @param string $value
	 * @param string $color
	 * @param array $attributes
	 * @return FusionCharts_Type_Plot
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
	 * @return FusionChartPlot
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
			'palette' => '2',
			'caption' => $this->name,
			'yaxisname' => $this->yDesc,
			'xaxisname' => $this->xDesc,
			'animation' => '1',
			'bgcolor' => 'FFFFFF',
			'showborder' => '0'
		);
		
		$xmlAttribs = $this->getAsXMLAttributes($mainAttribs) . implode(' ', $this->attribute);
		
		$xmlChart  = "<chart " . $xmlAttribs . "> <categories verticallinecolor='666666'>" . implode(' ', $this->categories) . "</categories>" . implode(' ', $this->plots);
		$xmlChart .= "<trendlines>" . implode(' ', $this->staticLines) . "</trendlines><vtrendlines>" . implode(' ', $this->trendlines) . "</vtrendlines>";
		$xmlChart .= "</chart>"; 
		
		return $xmlChart;
	}
}