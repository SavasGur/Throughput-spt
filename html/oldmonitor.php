<!DOCTYPE html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;
background:#151515;}

th {
    text-align: center;
    font-family:Verdana;
    font-size:20px;
    padding-top:20px;  
    color:white;
}
td {
    text-align: center;
    font-size:19px;
    border-bottom:2px solid #585858;
    padding-top:20px;  
}

/* Track */
::-webkit-scrollbar-track {
    background: #848484; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #000000; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; 
}

h3{
 font-size:40px;
 font-family:Veranda;
 color:white;
}
table{
color:#8e8e8e;
border:0; 
 width:100%;
 height=150%;
table-layout:fixed;
overflow:hidden;
}
/* Style the tab */
.tab {
    float: left;
    border-right:10px solid #0c090a;
    background-color: #0c090a;
    width: 30%;
    height: 400px;
}

/* Style the buttons inside the tab */
.tab button {
    display: block;
    background-color: inherit;
    color: white;
    padding: 22px 16px;
    width: 100%;
    border:none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 20px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #070b19;
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: #2b3856;
}

/* Style the tab content */
.tabcontent {
    float: left;
    padding: 0px 12px;
    border:10px solid #0c090a;
    width:70%;   
    border-left: none;
    height: 400px;    
   overflow:auto;
   background-color:#1a1a1a;
}
</style>
</head>
<body>

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
$smoke=mysqli_query($con,"SELECT * FROM smoke ORDER BY DATA_ID DESC");
?>
<h3>Base Station Monitor of KKTCELL</h3>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'temp')" id="defaultOpen">Temperature & Humidity</button>
  <button class="tablinks" onclick="openCity(event, 'fuel')">Fuel Level</button>
  <button class="tablinks" onclick="openCity(event, 'flood')">Flood Level</button>
 <button class="tablinks" onclick="openCity(event, 'smoke')">Smoke Level</button>
</div>

<div id="temp" class="tabcontent">
  <table id="table1">
<tr>
<th>Time</th>
<th>Temperature (*C)</th>
<th>Humidity (%)</th>
</tr>
<tbody>
<?php while ($bans = mysqli_fetch_array($temp)): ?>
        <tr>
            <td><?php echo $bans['Time'] ?></td>
            <td><?php echo $bans['Temperature'] ?></td>
            <td><?php echo $bans['Humidity'] ?></td>
        </tr>
<?php endwhile ?>
    </tbody>
</table>
</div>

<div id="fuel" class="tabcontent">
<table id="table2">
<tr>
<th>Time</th>
<th>Amount (Litre)</th>
</tr>
<tbody>
<?php while ($bans = mysqli_fetch_array($fuel)): ?>
        <tr>
            <td><?php echo $bans['Time'] ?></td>
            <td><?php echo $bans['Amount'] ?></td>
        </tr>
<?php endwhile ?>
    </tbody>
</table>
</div>

<div id="flood" class="tabcontent">
 <table id="table3">
<tr>
<th>Time</th>
<th>Level (%)</th>
</tr>
<tbody>
<?php while ($bans = mysqli_fetch_array($flood)): ?>
        <tr>
            <td><?php echo $bans['Time'] ?></td>
            <td><?php echo $bans['Level'] ?></td>
        </tr>
<?php endwhile ?>
    </tbody>
</table>
</div>
<div id="smoke" class="tabcontent">
 <table id="table4">
<tr>
<th>Time</th>
<th>CO Level (ppm)</th>
<th>LPG Level (ppm)</th>
<th>Smoke Level (ppm)</th>
</tr>
<tbody>
<?php while ($bans = mysqli_fetch_array($smoke)): ?>
        <tr>
            <td><?php echo $bans['Time'] ?></td>
            <td><?php echo $bans['CO'] ?></td>
            <td><?php echo $bans['LPG'] ?></td>
            <td><?php echo $bans['Smoke'] ?></td>
        </tr>
<?php endwhile ?>
    </tbody>
</table>
</div>
<script  type="text/javascript">
$(function() {
  $("#table1 tbody td").each(function() {
    if ($(this).text() >= 35) {
      $(this).parent().css('color', 'red');
    }
  });
 $("#table2 tbody td").each(function() {
    if ($(this).text() <= 0.1) {
      $(this).parent().css('color', 'red');
    }
  });
 $("#table3 tbody td").each(function() {
    if ($(this).text() >= 40) {
      $(this).parent().css('color', 'red');
    }
  });
 $("#table4 tbody td").each(function() {
    if ($(this).text() >= 0.029) {
      $(this).parent().css('color', 'red');
    }
  });
});

</script>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
     
</body>
</html> 
