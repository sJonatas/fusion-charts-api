<?php

/**
 * abstract class to chart classes
 * @author	Lucas de Oliveira
 */

abstract class FusionCharts_Chart_Abstract 
{
	const JS_NAME = 'FusionCharts.js';
	
	protected $name;
	
	protected $width;
	
	protected $height;
	
	protected $path_swf;
	
	protected $path_js;
	
	protected $attribute = array();
	
	/**
	 * @param 	string full path to .swf $path_swf
	 * @param 	string full path to FusionCharts.js $path_js
	 */
	function __construct($path_swf, $path_js)
	{
		$this->path_swf = $path_swf;
		$this->path_js 	= $path_js;
		
		if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $this->path_swf)) {
			die("File .swf not found: {$this->path_swf}");
		}
		
		if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $this->path_js)) {
			die("File .js not found: {$this->path_js}");
		}
	}
	
	/**
	 * chart name
	 * @param 	string $name
	 * @return  FusionChartAbstract
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * @param 	integer $width
	 * @return 	FusionChartAbstract
	 */
	public function setWidth($width)
	{
		$this->width = $width;
		return $this;
	}
	
	/**
	 * @param 	integer $height
	 * @return 	FusionChartAbstract
	 */
	public function setHeight($height)
	{
		$this->height = $height;
		return $this;
	}
	
	/**
	 * @param 	string $name
	 * @param 	string $value
	 * @return 	FusionChartAbstract
	 */
	public function addAttribute($name, $value)
	{
		$this->attribute[] = "{$name}='{$value}'";
		return $this;
	}
	
	/**
	 * @return 	string xml
	 */
	abstract public function getXML();
	
	/**
	 * @return 	string javascript
	 */
	public function render()
	{
		$script_js  = "<div id='".md5($this->name)."'></div>";
		$script_js .= "<script type='text/javascript' src='".$this->path_js."'></script>";
		$script_js .= "<script type='text/javascript'>";
		$script_js .= "var xml = \"".$this->getXML()."\";";
		$script_js .= "var chart = new FusionCharts('".$this->path_swf."', 'id', '".$this->width."', '".$this->height."', '0', '1');";
		$script_js .= "chart.setXMLData(xml);";
		$script_js .= "chart.render('".md5($this->name)."');";
		$script_js .= "</script>";
			
		return $script_js;
	}
	
}
	