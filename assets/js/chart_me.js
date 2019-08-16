$(document).ready(function(){
	$.ajax({
		url: "http://localhost/saw/index.php/welcome/chart_json",
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
					backgroundColor: 'rgba(200,200,200,0.75)',
					borderColor: 'rgba(200,200,200,0.75)',
					hoverBackgroundColor: 'rgba(200,200,200,1)',
					data: score
				}
			]
			};
			var ctx = $("mycanvas");
			var barGraph = new Chart(ctx,{
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data){
			console.log(data);
		}
	});
});