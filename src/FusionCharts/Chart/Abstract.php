<?php

/**
 * Abstract class to create fusionchart classes
 * @package FusionCharts
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
abstract class FusionCharts_Chart_Abstract 
{
	const JS_NAME = 'FusionCharts.js';
	
	protected $name;
	protected $width;
	protected $height;
	protected $pathSWF;
	protected $pathJS;
	protected $attribute = array();
	
	/**
	 * @param string $pathSWF full swf file
	 * @param string $pathJS full js file
	 * @throws InvalidArgumentException file not found
	 */
	function __construct($pathSWF, $pathJS)
	{
		$this->pathSWF = $pathSWF;
		$this->pathJS = $pathJS;

		if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $this->validatePath($this->pathSWF))) {
			throw new InvalidArgumentException("swf file not found: " . $this->pathSWF);
		}
		if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $this->validatePath($this->pathJS))) {
			throw new InvalidArgumentException("js file not found: " . $this->pathJS);
		}
	}
	
	/**
	 * @param string $name
	 * @return FusionChartAbstract
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * @param integer $width
	 * @return FusionChartAbstract
	 */
	public function setWidth($width)
	{
		$this->width = $width;
		return $this;
	}
	
	/**
	 * @param integer $height
	 * @return FusionChartAbstract
	 */
	public function setHeight($height)
	{
		$this->height = $height;
		return $this;
	}
	
	/**
	 * @param string $name
	 * @param string $value
	 * @return FusionChartAbstract
	 */
	public function addAttribute($name, $value)
	{
		$this->attribute[] = $name . "='" . $value . "'";
		return $this;
	}
	
	/**
	 * @return string xml
	 */
	abstract public function getXML();
	
	/**
	 * @return string javascript
	 */
	public function render()
	{
		$scriptJS  = "<div id='" . md5($this->name) . "'></div>";
		$scriptJS .= "<script type='text/javascript' src='" . $this->pathJS . "'></script>";
		$scriptJS .= "<script type='text/javascript'>";
		$scriptJS .= "var xml = \"" . $this->getXML() . "\";";
		$scriptJS .= "var chart = new FusionCharts('" . $this->pathSWF . "', 'id', '" . $this->width . "', '" . $this->height . "', '0', '1');";
		$scriptJS .= "chart.setXMLData(xml);";
		$scriptJS .= "chart.render('" . md5($this->name) . "');";
		$scriptJS .= "</script>";
		
		return $scriptJS;
	}
	
	/**
	 * @param array $attributes associative array
	 * @return strign XML
	 */
	protected function getAsXMLAttributes(array $attributes = null)
	{
		if (!$attributes) return '';
	
		foreach ($attributes as $key => $value) $xmlAttrbs[] = $key."='" . $value ."'";
		
		return implode(' ', $xmlAttrbs);
	}
	
	/**
	 * @param string $path
	 * @return string
	 */
	protected function validatePath($path)
	{
		$path = str_replace('/', DIRECTORY_SEPARATOR, $path);
		$path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
		$path = ltrim($path, DIRECTORY_SEPARATOR);
		$path = DIRECTORY_SEPARATOR . $path;
		
		return $path;
	}
}
	