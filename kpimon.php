<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script><title>-Monitor KPI-</title>

</head>
<body style="background-color:#2741B6">
<?php
$con=mysqli_connect("localhost","root","denizq","SENSOR");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$kpi=mysqli_query($con,"SELECT * FROM kpidata ORDER BY DATA_ID DESC");
?>
<nav style="font-size:21px" class="navbar navbar-expand-sm bg-warning navbar-light">
  <ul class="navbar-nav">
		<li class="nav-item">
      <a class="nav-link disabled"><img style="border-radius:25px" width="50" height="50" src="https://pbs.twimg.com/profile_images/1021322167433211905/v7dr4YaW_400x400.jpg"></a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item active">
      <a class="nav-link" href="kpimon.php">KPI</a>
    </li>
		<li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item">
      <a class="nav-link" href="dnugraph.php">Download & Upload Speed Graph</a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px" class="nav-item">
      <a class="nav-link" href="lnjgraph.php">Latency & Jitter Graph</a>
    </li>
    <li style="padding-top:10px; padding-left:10px; padding-right:10px"class="nav-item">
      <a class="nav-link disabled" href="#">Coming Soon...</a>
    </li>
  </ul>
</nav>
<div style="margin-top:25px;background-color:white;margin-left:25px;margin-right:25px;border-radius:25px" class="jumbotron">
	
	  <h1 style="margin-top:-25px" class="text-center">KPI Data</h1><br>
	  <table class="table table-hover table-bordered" style=" width:100%; height:100%;"> 
	    <thead class="thead-dark">
	      <tr>
	        <th>Time</th>
		<th>Download (Mps)</th>
		<th>Upload (Mps)</th>
		<th>Latency (ms)</th>
		<th>Jitter (ms)</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <?php while ($bans = mysqli_fetch_array($kpi)): ?>
	        <tr>
	            <td><?php echo $bans['Time'] ?></td>
	            <td><?php echo $bans['Download'] ?></td>
	            <td><?php echo $bans['Upload'] ?></td>
	            <td><?php echo $bans['Latency'] ?></td>
	            <td><?php echo $bans['Jitter'] ?></td>
	        </tr>
		<?php endwhile ?>
	    </tbody>
	  </table>
	
</div>
</body>
</html>