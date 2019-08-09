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
$con=mysqli_connect("localhost","root","denizq","SENSOR");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$kpilatf=mysqli_query($con,"SELECT * FROM kpidata ORDER BY DATA_ID ASC");
$kpijitf=mysqli_query($con,"SELECT * FROM kpidata ORDER BY DATA_ID ASC");
?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		title:{
			fontFamily: "arial",
			// text: "Latency & Jitter Chart"
		},
		axisY:{
        valueFormatString:  "###.##\ ms", // move comma to change formatting
     },
		data: [
		{
			name: "Download Speed",
			type: "line",
			showInLegend: true,
                        legendText: "Latency (ms)",
			toolTipContent: "<p style='color:blue'> {label}</p><hr/>Latency: {y} ms",
			color: "red" ,
			dataPoints: [
                                <?php while ($bans = mysqli_fetch_array($kpilatf)): ?>
				{ label: "<?php echo $bans['Time'];?>", y: <?php echo $bans['Latency']; ?> },
                          	<?php endwhile ?>
	
			]
		},
		{
			name: "Jitter",
			type: "line",
			showInLegend: true,
                        legendText: "Jitter (ms)",
			toolTipContent: "<p style='color:red'> {label}</p><hr/>Jitter: {y} ms",
			color: "blue" ,
			dataPoints: [
				<?php while ($bans = mysqli_fetch_array($kpijitf)): ?>
				{ label: "<?php echo $bans['Time'];?>", y: <?php echo $bans['Jitter']; ?> },
                          	<?php endwhile ?>
				
			]
		}
		]
	});
	chart.render();

	document.getElementById("printChart").addEventListener("click",function(){
    	chart.print();
    });  
}
</script>
<?php
// DB Bağlantı
//---*---

if (isset($_POST['filter'])) {
	$startd = $_POST['stdate'];
	$endd = $_POST['endate'];
	$nstartd = date("d-m-Y",strtotime($startd));
	$nstartd = str_replace('-','/',$nstartd);
	
        
        $kpilat=mysqli_query($con,"SELECT * FROM kpidata WHERE Time LIKE '%$nstartd%' ORDER BY DATA_ID ASC");
        $kpijit=mysqli_query($con,"SELECT * FROM kpidata WHERE Time LIKE '%$nstartd%' ORDER BY DATA_ID ASC");
?>

<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		title:{
			fontFamily: "arial",
			// text: "Latency & Jitter Chart"
		},
		axisY:{
        valueFormatString:  "###.##\ ms", // move comma to change formatting
     },
		data: [
		{
			name: "Download Speed",
			type: "line",
			showInLegend: true,
                        legendText: "Latency (ms)",
			toolTipContent: "<p style='color:blue'> {label}</p><hr/>Latency: {y} ms",
			color: "red" ,
			dataPoints: [
                                <?php while ($bans = mysqli_fetch_array($kpilat)): ?>
				{ label: "<?php echo $bans['Time'];?>", y: <?php echo $bans['Latency']; ?> },
                          	<?php endwhile ?>
	
			]
		},
		{
			name: "Jitter",
			type: "line",
			showInLegend: true,
                        legendText: "Jitter (ms)",
			toolTipContent: "<p style='color:red'> {label}</p><hr/>Jitter: {y} ms",
			color: "blue" ,
			dataPoints: [
				<?php while ($bans = mysqli_fetch_array($kpijit)): ?>
				{ label: "<?php echo $bans['Time'];?>", y: <?php echo $bans['Jitter']; ?> },
                          	<?php endwhile ?>
				
			]
		}
		]
	});
	chart.render();

	document.getElementById("printChart").addEventListener("click",function(){
    	chart.print();
    });  
}
</script>
<?php
}
 ?>
</head>
<body style="background-color:#2741B6">
<nav style="font-size:21px" class="navbar navbar-expand-sm bg-warning navbar-light">
  <ul class="navbar-nav">
		<li class="nav-item">
      <a class="nav-link disabled"><img style="border-radius:25px" width="50" height="50" src="https://pbs.twimg.com/profile_images/1021322167433211905/v7dr4YaW_400x400.jpg"></a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item">
      <a class="nav-link" href="kpimon.php">KPI</a>
    </li>
		<li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item">
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

	<h1 style="margin-bottom:10px" class="text-center">Latency & Jitter Chart</h1>

 	<button class="shadow btn btn-primary border-dark float-right" id="printChart"><i class="material-icons">print</i><br>Print Graph</button>

<form method="post">
	<div class=" row col-sm-12">
		<input style="margin-left:5px;margin-right:5px" class="text-center form-control border border-info col-sm-2" type="date" name="stdate">
		
		<button style="margin-left:5px;" class=" shadow btn btn-primary border-dark col-sm-1 h-50" name="filter" type="submit">Apply</button>
		<?php  ?>

	</div>
</form><br>
        <?php echo "<h3>".$nstartd." tarihli ölçümler.<h3>";?><br><br>
	<div id="chartContainer" style="height: 450px; width: 100%;"></div>



</div>
</body>
</html>