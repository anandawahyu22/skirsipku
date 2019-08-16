<!DOCTYPE html>
<html>
<head>
	<title>Graph</title>
	<style type="text/css">
	#chart-container{
		width: 1000px;
		height: auto;
	}
</style>
</head>
<body>
	<div id="chart-container">
		<canvas id="mycanvas"> </canvas>
	</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script >
	$(document).ready(function(){
	$.ajax({
		url: "http://localhost:80/saw/index.php/welcome/chart_json",
		method: "GET",
		success: function(data){
			console.log(data);
			var nama = [];
			var score = [];
			for (var i in data){
				nama.push("Nama " + data[i].karyawan);
				score.push(data[i].nilai);
			}
			var chartdata = {
				labels: nama,
				datasets : [
				{
					label : 'Player score',
					data: score	
				}
			]
			};
			var ctx = document.getElementById("mycanvas").getContext('2d');
			var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: chartdata,
    
});
		},
		error: function(data){
			console.log(data);
		}
	});
});
</script>
</body>
</html>