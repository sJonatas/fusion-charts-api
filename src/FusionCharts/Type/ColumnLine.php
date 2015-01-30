<?php
	
/**
 * class to create a chart MSColumn3DLineDY.swf from fusioncharts.com
 * @author Lucas de Oliveira
 */

class FusionCharts_Type_ColumnLine extends FusionCharts_Chart_Abstract 
{
	const SWF_NAME = 'MSColumn3DLineDY.swf';
	
	private $x_desc;
	
	private $y_desc;
	
	private $columns = array();
	
	private $lines = array();
	
	private $categories = array();
	
	private $static_lines = array();
	
	/**
	 * @param	string $x_desc
	 * @return	FusionChartColumnLine
	 */
	public function setXdescription($x_desc)
	{
		$this->x_desc = $x_desc;
		return $this;
	}
	
	/**
	 * @param 	string $y_desc
	 * @return	FusionChartColumnLine
	 */
	public function setYdescription($y_desc)
	{
		$this->y_desc = $y_desc;
		return $this;
	}
	
	/**
	 * @param	booelan $rotate
	 * @return	FusionChartColumnLine
	 */
	public function setLabelRotate($rotate = true)
	{
		if ($rotate) $this->attribute[] = "labelDisplay='Rotate' slantLabels='1'";
		return $this;
	}
	
	/**
	 * @param 	string 	$name
	 * @param 	array 	$values
	 * @param 	string	$color
	 * @return 	FusionChartColumnLine
	 */
	public function addColumns($name, array $values, $color = null)
	{
		$column = "<dataset seriesname='".$name."' color='".$color."'>";
		foreach ($values as $value){
			$column .= "<set value='".$value."' />";
		}
		$column .= "</dataset>";
		
		$this->columns[] = $column;
		return $this;
	}
	
	/**
	 * @param 	string 	$name
	 * @param 	array 	$values
	 * @param 	string	$color
	 * @return 	FusionChartColumnLine
	 */
	public function addLine($name, array $values, $color = null)
	{
		$line = "<dataset seriesname='".$name."' color='".$color."' parentyaxis='S' renderas='Line'>";
		foreach ($values as $value){
			$line .= "<set value='".$value."' />";
		}
		$line .= "</dataset>";
		
		$this->lines[] = $line;
		return $this;
	}
	
	/**
	 * @param 	array $names
	 * @return 	FusionChartColumnLine
	 */
	public function addCategories(array $names)
	{
		$category = "<categories>";
		foreach ($names as $name){
			$category .= "<category label='".$name."' />";
		}
		$category .= "</categories>";
			
		$this->categories = $category;
		return $this;
	}
	
	/**
	 * @param 	string 	$name
	 * @param 	integer $value
	 * @param 	string 	$color
	 * @return 	FusionChartColumnLine
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
		$xml_chart  = "<chart caption='{$this->name}' xaxisname='{$this->x_desc}' pyaxisname='{$this->y_desc}' animation='1' ".implode(' ', $this->attribute)." >";
		$xml_chart .= $this->categories;
		$xml_chart .= implode(' ', $this->columns);
		$xml_chart .= implode(' ', $this->lines);
		$xml_chart .= "<trendlines>".implode(' ', $this->static_lines)."</trendlines>";
		$xml_chart .= "</chart>";
	
		return $xml_chart;
	}
	
}