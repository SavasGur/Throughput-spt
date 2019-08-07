<?php
// DB Bağlantı

//---*---

if (isset($_POST['filter'])) {
	$startd = $_POST['stdate'];
	$endd = $_POST['endate'];
	//query select date between st ve end
}
 ?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script><title>-Monitor KPI-</title>
<?php
//dummy data for graph
$date1 = "25/07/2019 - 16:19:35";
$date2 = "25/07/2019 - 17:19:35";
$date3 = "25/07/2019 - 18:19:35";
$date4 = "25/07/2019 - 19:19:35";
$date5 = "25/07/2019 - 20:19:35";
//---
$lat1 = 25;
$lat2 = 100;
$lat3 = 75;
$lat4 = 150;
$lat5 = 200;
//---
$jit1 = 5;
$jit2 = 13;
$jit3 = 25;
$jit4 = 12;
$jit5 = 7;
 ?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">

window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
		title:{
      fontFamily: "arial",
			//text: "Latency & Jitter Data"
		},
		axisY:{
        valueFormatString:  "###.## ms", // move comma to change formatting

     },
		data: [
		{
			name: "Latency",
			type: "line",
			showInLegend: true,
      legendText: "Latency (ms)",
			toolTipContent: "<p style='color:red'> {label}</p><hr/>Latency: {y} ms",
			color: "blue" ,
			dataPoints: [
				{ label: "<?php echo $date1;?>", y: <?php echo $lat1;?> },
				{ label: "<?php echo $date2;?>", y: <?php echo $lat2;?> },
				{ label: "<?php echo $date3;?>", y: <?php echo $lat3;?> },
				{ label: "<?php echo $date4;?>", y: <?php echo $lat4;?> },
				{ label: "<?php echo $date5;?>", y: <?php echo $lat5;?> }
			]
		},
		{
			name: "Jitter",
			type: "line",
			showInLegend: true,
      legendText: "Jitter (ms)",
			toolTipContent: "<p style='color:blue'> {label}</p><hr/>Jitter: {y} ms",
			color: "red" ,
			dataPoints: [
				{ label: "<?php echo $date1;?>", y: <?php echo $jit1;?> },
				{ label: "<?php echo $date2;?>", y: <?php echo $jit2;?> },
				{ label: "<?php echo $date3;?>", y: <?php echo $jit3;?> },
				{ label: "<?php echo $date4;?>", y: <?php echo $jit4;?> },
				{ label: "<?php echo $date5;?>", y: <?php echo $jit5;?> }
			]
		}
		]

	});
	chart.render();
}
</script>
</head>
<body style="background-color:#2741B6">
<nav style="font-size:21px" class="navbar navbar-expand-sm bg-warning navbar-light">
  <ul class="navbar-nav">
		<li class="nav-item">
      <a class="nav-link disabled"><img style="border-radius:25px" width="50" height="50" src="https://pbs.twimg.com/profile_images/1021322167433211905/v7dr4YaW_400x400.jpg"></a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item">
      <a class="nav-link disabled" href="kpimon.php">KPI</a>
    </li>
		<li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item active">
      <a class="nav-link" href="dnugraph.php">Download & Upload Speed Graph</a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item active">
      <a class="nav-link" href="lnjgraph.php">Latency & Jitter Graph</a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px"class="nav-item">
      <a class="nav-link disabled" href="#">Coming Soon...</a>
    </li>
  </ul>
</nav>
<div style="padding-top:10px;background-color:white;margin-top:25px; margin-left:25px;margin-right:25px;border-radius:25px" class="jumbotron">

  <h1 style="margin-bottom:10px" class="text-center">Latency & Jitter Speed Chart</h1>

  <form method="post">
  	<div class=" row col-sm-12">
  		<input style="margin-left:5px;margin-right:5px" class="text-center form-control border border-info col-sm-2" type="date" name="stdate">-
  		<input style="margin-left:5px;margin-right:5px" class="text-center form-control border border-info col-sm-2" type="date" name="endate">
  		<button style="margin-left:5px;" class=" shadow btn btn-primary border-dark col-sm-1 h-50" name="filter" type="submit">Apply</button>
  		<?php  ?>
  		<button class="shadow btn btn-primary border-dark col-sm-1 ml-auto" type="submit"><i class="material-icons">print</i><br>Print Graph</button>
  	</div>
  </form><br>

  	<div id="chartContainer" style="height: 450px; width: 100%;"></div>


</div>
</body>
</html>
