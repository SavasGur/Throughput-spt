<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script><title>-Monitor KPI-</title>
<script>
window.onload = function () {
	
var chart = new CanvasJS.Chart("chartContainer", {
	//theme: "light2", // "light1", "light2", "dark1", "dark2"
	animationEnabled: true,
	title:{
		text: "Internet users"  
	},
	subtitles: [{
		text: "Try Clicking and Hovering over Legends!"
	}],
	axisX: {
		lineColor: "black",
		labelFontColor: "black"
	},
	axisY2: {
      	gridThickness: 0,
		title: "% of Population",
		suffix: "%",
		titleFontColor: "black",
		labelFontColor: "black"
	},
	legend: {
		cursor: "pointer",
		itemmouseover: function(e) {
			e.dataSeries.lineThickness = e.chart.data[e.dataSeriesIndex].lineThickness * 2;
			e.dataSeries.markerSize = e.chart.data[e.dataSeriesIndex].markerSize + 2;
			e.chart.render();
		},
		itemmouseout: function(e) {
			e.dataSeries.lineThickness = e.chart.data[e.dataSeriesIndex].lineThickness / 2;
			e.dataSeries.markerSize = e.chart.data[e.dataSeriesIndex].markerSize - 2;
			e.chart.render();
		},
		itemclick: function (e) {
			if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
			e.chart.render();
		}
	},
	toolTip: {
		shared: true
	},
	data: [{
		type: "spline",
		name: "Sweden",
		markerSize: 5,
      	axisYType: "secondary",
		xValueFormatString: "YYYY",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2000, 00), y: 47.5 },
			{ x: new Date(2005, 00), y: 84.8 },
			{ x: new Date(2009, 00), y: 91 },
			{ x: new Date(2010, 00), y: 90 },
			{ x: new Date(2011, 00), y: 92.8 },
			{ x: new Date(2012, 00), y: 93.2 },
			{ x: new Date(2013, 00), y: 94.8 },
			{ x: new Date(2014, 00), y: 92.5 }
		]
	},
	{
		type: "spline",
		name: "UK",
		markerSize: 5,
		axisYType: "secondary",
		xValueFormatString: "YYYY",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2000, 00), y: 26.8 },
			{ x: new Date(2005, 00), y: 70 },
			{ x: new Date(2009, 00), y: 83.6 },
			{ x: new Date(2010, 00), y: 85 },
			{ x: new Date(2011, 00), y: 85.4 },
			{ x: new Date(2012, 00), y: 87.5 },
			{ x: new Date(2013, 00), y: 89.8 },
			{ x: new Date(2014, 00), y: 91.6 }
		]
	},
	{
		type: "spline",
		name: "UAE",
		markerSize: 5,
		axisYType: "secondary",
		xValueFormatString: "YYYY",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2000, 00), y: 23.6 },
			{ x: new Date(2005, 00), y: 40 },
			{ x: new Date(2009, 00), y: 64 },
			{ x: new Date(2010, 00), y: 68 },
			{ x: new Date(2011, 00), y: 78 },
			{ x: new Date(2012, 00), y: 85 },
			{ x: new Date(2013, 00), y: 86 },
			{ x: new Date(2014, 00), y: 90.4 }
		]
	},
	{
		type: "spline",
		showInLegend: true,
		name: "USA",
		markerSize: 5,
		axisYType: "secondary",
		yValueFormatString: "#,##0.0\"%\"",
		xValueFormatString: "YYYY",
		dataPoints: [
			{ x: new Date(2000, 00), y: 43.1 },
			{ x: new Date(2005, 00), y: 68 },
			{ x: new Date(2009, 00), y: 71 },
			{ x: new Date(2010, 00), y: 71.7 },
			{ x: new Date(2011, 00), y: 69.7 },
			{ x: new Date(2012, 00), y: 79.3 },
			{ x: new Date(2013, 00), y: 84.2 },
			{ x: new Date(2014, 00), y: 87 }
		]
	},
	{
		type: "spline",
		name: "Switzerland",
		markerSize: 5,
		axisYType: "secondary",
		xValueFormatString: "YYYY",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2000, 00), y: 47.1 },
			{ x: new Date(2005, 00), y: 70.1 },
			{ x: new Date(2009, 00), y: 81.3 },
			{ x: new Date(2010, 00), y: 83.9 },
			{ x: new Date(2011, 00), y: 85.2 },
			{ x: new Date(2012, 00), y: 85.2 },
			{ x: new Date(2013, 00), y: 86.7 },
			{ x: new Date(2014, 00), y: 87 }
		]
	},
	{
		type: "spline",
		name: "Honk Kong",
		markerSize: 5,
		axisYType: "secondary",
		xValueFormatString: "YYYY",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2000, 00), y: 27.8 },
			{ x: new Date(2005, 00), y: 56.9 },
			{ x: new Date(2009, 00), y: 69.4 },
			{ x: new Date(2010, 00), y: 72 },
			{ x: new Date(2011, 00), y: 72.2 },
			{ x: new Date(2012, 00), y: 72.9 },
			{ x: new Date(2013, 00), y: 74.2 },
			{ x: new Date(2014, 00), y: 74.6 }
		]
	},
	{
		type: "spline",
		name: "Russia",
		markerSize: 5,
		axisYType: "secondary",
		xValueFormatString: "YYYY",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2000, 00), y: 2 },
			{ x: new Date(2005, 00), y: 15.2 },
			{ x: new Date(2009, 00), y: 29 },
			{ x: new Date(2010, 00), y: 43 },
			{ x: new Date(2011, 00), y: 49 },
			{ x: new Date(2012, 00), y: 63.8 },
			{ x: new Date(2013, 00), y: 61.4 },
			{ x: new Date(2014, 00), y: 70.5 }
		]
	},
	{
		type: "spline",
		name: "Ukraine",
		markerSize: 5,
		axisYType: "secondary",
		xValueFormatString: "YYYY",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2000, 00), y: .7 },
			{ x: new Date(2005, 00), y: 3.7 },
			{ x: new Date(2009, 00), y: 17.9 },
			{ x: new Date(2010, 00), y: 23.3 },
			{ x: new Date(2011, 00), y: 28.7 },
			{ x: new Date(2012, 00), y: 35.3 },
			{ x: new Date(2013, 00), y: 41.8 },
			{ x: new Date(2014, 00), y: 43.4 }
		]
	},
	{
		type: "spline",
		name: "India",
		markerSize: 5,
		axisYType: "secondary",
		xValueFormatString: "YYYY",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2000, 00), y: .5 },
			{ x: new Date(2005, 00), y: 2.4 },
			{ x: new Date(2009, 00), y: 5.1 },
			{ x: new Date(2010, 00), y: 7.5 },
			{ x: new Date(2011, 00), y: 10.1 },
			{ x: new Date(2012, 00), y: 12.6 },
			{ x: new Date(2013, 00), y: 15.1 },
			{ x: new Date(2014, 00), y: 18 }
		]
	}]
});
chart.render();

}
</script>
</head>
<body style="background-color:#2741B6">
<?php
$con=mysqli_connect("localhost","root","denizq","SENSOR");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$temp = mysqli_query($con,"SELECT * FROM tempdata ORDER BY DATA_ID DESC");
$fuel=mysqli_query($con,"SELECT * FROM fuel ORDER BY DATA_ID DESC");
$flood=mysqli_query($con,"SELECT * FROM flood ORDER BY DATA_ID DESC");
$smoke=mysqli_query($con,"SELECT * FROM smok ORDER BY DATA_ID DESC");
$kpi=mysqli_query($con,"SELECT * FROM kpidata ORDER BY DATA_ID DESC");
?>
<nav style="font-size:21px" class="navbar navbar-expand-sm bg-warning navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link disabled"><img style="border-radius:25px" width="50" height="50" src="https://pbs.twimg.com/profile_images/1021322167433211905/v7dr4YaW_400x400.jpg"></a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item">
      <a class="nav-link" href="kpimon.php">KPI</a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item active">
      <a class="nav-link" href="kpigraph.php">KPI Graph</a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px"class="nav-item">
      <a class="nav-link disabled" href="#">Coming Soon...</a>
    </li>
  </ul>
</nav>	
<div style="margin-top:25px; margin-left:25px;margin-right:25px;border-radius:25px" class="jumbotron">

	<h1 style="margin-top:-25px" class="text-center">!Beta!</h1>
	<p class="text-center"></p>
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</div>
</body>
</html>