var ctx = document.getElementById("myBarChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Drone', 'Tractor'],
        datasets: [{
        //    label: 'Sensor Total Active Time',
	//    xAxisID: 'Sensors',
	    yAxisID: 'y-axis-1',
            data: [2, 1],
            backgroundColor: [
                '#36b9cc',
                '#f6c23e',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                //'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                '#36b9cc',
                '#f6c23e',
                //'rgba(255, 206, 86, 1)',
                //'rgba(75, 192, 192, 1)',
                //'rgba(153, 102, 255, 1)',
                //'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
          display: false
        },
	responsive: true,
        title:{
          display:true,
          text:"Total AG Machines by Type"
        },
        tooltips: {
          mode: 'index',
          intersect: true
        },
        scales: {
          yAxes: [{
	    gridLines: {
                display:false
            },
            display: true,
            position: "left",
            id: "y-axis-1",
            ticks: {
	      beginAtZero: true,
	      stepSize: 1
            }
         }],
	 xAxes: [{
	    gridLines: {
                display:false
            }
         }]
       }
    }

});
