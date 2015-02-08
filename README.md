# FusionCharts - API #
__http://www.fusioncharts.com/__

## Description ##
This package can generate graphical charts using the FusionCharts API.

It provides a base class that can generate HTML and JavaScript for rendering several types of charts supported by the FusionCharts API taking XML code that defines the parameters of the charts.

The package comes also with specialized classes that can generate the necessary XML code with the parameters for several types of charts.

Currently it comes with classes for rendering charts of types column, line, plot, pie, pareto and line.

The chart classes provide a fluent interface to define any of the supported parameters like the chart data values, chart size, colors, labels, fonts, and other chart specific parameters.

## Install ##
```
git clone https://github.com/lucasoliveira94/fusion-charts-api
```

## Execute ##

- Start PHP server
```
cd fusion-charts-api
php -S localhost:8888 -t public
```

## Requirement ##

- PHP 5.3 >
