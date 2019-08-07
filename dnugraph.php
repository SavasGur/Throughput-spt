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
$date1 = "25/07/2019 - 11:19:35";
$date2 = "25/07/2019 - 12:19:35";
$date3 = "25/07/2019 - 13:19:35";
$date4 = "25/07/2019 - 14:19:35";
$date5 = "25/07/2019 - 15:19:35";
$date6 = "25/07/2019 - 16:19:35";
$date7 = "25/07/2019 - 17:19:35";
$date8 = "25/07/2019 - 18:19:35";
$date9 = "25/07/2019 - 19:19:35";
$date0 = "25/07/2019 - 20:19:35";
//---
$d1 = 25;
$d2 = 20;
$d3 = 15;
$d4 = 25;
$d5 = 20;
$d6 = 25;
$d7 = 20;
$d8 = 15;
$d9 = 25;
$d0 = 20;

//---
$u1 = 10;
$u2 = 5;
$u3 = 7;
$u4 = 12;
$u5 = 15;
$u6 = 10;
$u7 = 5;
$u8 = 7;
$u9 = 12;
$u0 = 15;

?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">

window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		title:{
			fontFamily: "arial",
			// text: "Download & Upload Speed Chart"
		},
		axisY:{
        valueFormatString:  "###.##\ mb/s", // move comma to change formatting

     },
		data: [
		{
			name: "Download Speed",
			type: "line",
			showInLegend: true,
      legendText: "Download Speed (mb/s)",
			toolTipContent: "<p style='color:green'> {label}</p><hr/>Latency: {y} mb/s",
			color: "purple" ,
			dataPoints: [
				{ label: "<?php echo $date1;?>", y: <?php echo $d1;?> },
				{ label: "<?php echo $date2;?>", y: <?php echo $d2;?> },
				{ label: "<?php echo $date3;?>", y: <?php echo $d3;?> },
				{ label: "<?php echo $date4;?>", y: <?php echo $d4;?> },
				{ label: "<?php echo $date5;?>", y: <?php echo $d5;?> },
				{ label: "<?php echo $date6;?>", y: <?php echo $d6;?> },
				{ label: "<?php echo $date7;?>", y: <?php echo $d7;?> },
				{ label: "<?php echo $date8;?>", y: <?php echo $d8;?> },
				{ label: "<?php echo $date9;?>", y: <?php echo $d9;?> },
				{ label: "<?php echo $date0;?>", y: <?php echo $d0;?> }
			]
		},
		{
			name: "Upload Speed",
			type: "line",
			showInLegend: true,
      legendText: "Upload Speed (mb/s)",
			toolTipContent: "<p style='color:purple'> {label}</p><hr/>Jitter: {y} mb/s",
			color: "green" ,
			dataPoints: [
				{ label: "<?php echo $date1;?>", y: <?php echo $u1;?> },
				{ label: "<?php echo $date2;?>", y: <?php echo $u2;?> },
				{ label: "<?php echo $date3;?>", y: <?php echo $u3;?> },
				{ label: "<?php echo $date4;?>", y: <?php echo $u4;?> },
				{ label: "<?php echo $date5;?>", y: <?php echo $u5;?> },
				{ label: "<?php echo $date6;?>", y: <?php echo $u6;?> },
				{ label: "<?php echo $date7;?>", y: <?php echo $u7;?> },
				{ label: "<?php echo $date8;?>", y: <?php echo $u8;?> },
				{ label: "<?php echo $date9;?>", y: <?php echo $u9;?> },
				{ label: "<?php echo $date0;?>", y: <?php echo $u0;?> },
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

	<h1 style="margin-bottom:10px" class="text-center">Download & Upload Speed Chart</h1>

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
