<?php 
$conn = mysql_connect("localhost", "root", "");
		mysql_select_db("test_temp");
header('Access-Control-Allow-Origin: *'); 

/* Timce Function */
date_default_timezone_set("Asia/Kuala_Lumpur");
$tableTitle = 'Received Parcel Today';
$today = date("Y-m-d H:i:s");
$timestamp = $today;
$splitTimeStamp = explode(" ",$timestamp);
//$date= '2016'; //for testing purpose, to view all data to pages.
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];
/* Timce Function End Here */

$query =  mysql_query("SELECT  * FROM `temp_log` where timestamp like '%".$date."%' LIMIT 50") or die (mysql_query());
		//$query =  mysql_query("SELECT  * FROM `temp_log` where timestamp like '%2016-12-02%' ") or die (mysql_query());
		while($row = mysql_fetch_array($query))//loop process
		{
			echo "[new Date('".$row['timestamp']."').getTime(),".$row['cpu']."],";
		}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highstock with dynamic data</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
		$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Average Temperature'
        },
        subtitle: {
            text: 'Source: rpi web server'
        },
        xAxis: {
            //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            categories: [
			<?php
		//$query =  mysql_query("SELECT  * FROM `temp_log` where timestamp like '%".$date."%' LIMIT 50") or die (mysql_query());
		$query =  mysql_query("SELECT  * FROM `temp_log` where timestamp like '%2016-12-02%' ") or die (mysql_query());
		while($row = mysql_fetch_array($query))//loop process
		{
			//echo "'".$row['timestamp']."',";
			echo "'".$time."',";
		}
		?>
			]
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: false
                },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Temperature',
            data: [<?php
		//$query =  mysql_query("SELECT  * FROM `temp_log` where timestamp like '%".$date."%' LIMIT 50") or die (mysql_query());
		$query =  mysql_query("SELECT  * FROM `temp_log` where timestamp like '%2016-12-02%' limit 50") or die (mysql_query());
		while($row = mysql_fetch_array($query))//loop process
		{
			echo "".$row['cpu'].",";
		}
		?>]
            /*data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]*/
        }]
    });
});

		
		</script>
	    <script src="http://code.highcharts.com/stock/highstock.js"></script>
		<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>


	</head>
	<body>
		<div id="container" style="height: 500px; min-width: 500px"></div>
	</body>
</html>