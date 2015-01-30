<?php

/**
 * class to create a chart Scatter.swf from fusioncharts.com
 * @author Lucas de Oliveira
 */

class FusionCharts_Type_Plot extends FusionCharts_Chart_Abstract 
{
	const SWF_NAME = 'Scatter.swf';
	
	private $x_desc;
	
	private $y_desc;
	
	private $labels;
	
	private $categories	= array();
	
	private $plots = array();
	
	private $trendlines = array();
	
	private $static_lines = array();
	
	/**
	 * @param	string $x_desc
	 * @return	FusionChartPlot
	 */
	public function setXdescription($x_desc)
	{
		$this->x_desc = $x_desc;
		return $this;
	}
	
	/**
	 * @param 	string $y_desc
	 * @return 	FusionChartPlot
	 */
	public function setYdescription($y_desc)
	{
		$this->y_desc = $y_desc;
		return $this;
	}
	
	/**
	 * @param	booelan $rotate
	 * @return	FusionChartPlot
	 */
	public function setLabelRotate($rotate = true)
	{
		if ($rotate) $this->attribute[] = "labelDisplay='Rotate' slantLabels='1'";
		return $this;
	}
	
	/**
	 * @param 	array $values
	 * @param 	array $labels
	 * @return 	FusionChartPlot
	 */
	public function addCategories(array $values, array $labels)
	{
		$this->labels = $labels;
		$this->categories = array();
		foreach ($values as $index => $value){
			$this->categories[] = "<category label='".$labels[$index]."' x='".$value."' showVerticalLine='1' />";
		}
		return $this;
	}
	
	/**
	 * @param 	array  $x_values
	 * @param 	array  $y_values
	 * @param 	string $serie_name
	 * @param 	string $bgcolor
	 * @return 	FusionChartPlot
	 */
	public function addPlots(array $x_values, array $y_values, $serie_name, $bgcolor)
	{
		$this->plots[] = "<dataset seriesname='".$serie_name."' color='".$bgcolor."' anchorsides='4' anchorbordercolor='".$bgcolor."' anchorradius='4' anchorbgcolor='".$bgcolor."'>";
		foreach ($x_values as $index => $x_value){
			$this->plots[] = "<set y='".$y_values[$index]."' x='".$x_value."' hoverText='".$this->labels[$index].", ".$y_values[$index]."' />";
		}
		$this->plots[] = "</dataset>";
		return $this;
	}
	
	/**
	 * @param 	interger $start_value
	 * @param 	integer	 $end_value
	 * @param 	string	 $color
	 * @return 	FusionChartPlot
	 */
	public function addTrendLine($start_value, $end_value, $color)
	{
		$this->trendlines[] = "<line startvalue='".$start_value."' endvalue='".$end_value."' istrendzone='1' color='".$color."' alpha='10' />";
		return $this;
	}
	
	/**
	 * @param 	string 	$name
	 * @param 	integer $value
	 * @param 	string 	$color
	 * @return 	FusionChartPlot
	 */
	public function addStaticLine($name, $value, $color)
	{
		$this->static_lines[] = "<line startvalue='".$value."' displayvalue='".$name."' color='".$color."' valueonright='1' displayvalue='High' showontop='1' thickness='2' />";
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FusionChartAbstract::getXML()
	 */
	public function getXML()
	{
		$xml_chart 	= "<chart palette='2' caption='".$this->name."' yaxisname='".$this->y_desc."' xaxisname='".$this->x_desc."' animation='1' bgcolor='FFFFFF' showborder='0' ".implode(' ', $this->attribute).">";
		$xml_chart .= "<categories verticallinecolor='666666'>".implode(' ', $this->categories)."</categories>";
		$xml_chart .= implode(' ', $this->plots);
		$xml_chart .= "<trendlines>".implode(' ', $this->static_lines)."</trendlines><vtrendlines>".implode(' ', $this->trendlines)."</vtrendlines>";
		$xml_chart .= "</chart>"; 
		
		return $xml_chart;
	}
}