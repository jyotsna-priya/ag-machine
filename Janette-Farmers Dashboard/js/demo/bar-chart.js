$(document).ready(function(){
  $.ajax({
    url: "http://13.52.80.181/machinetypedata.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var types = [];
      var count = [];

      for(var i in data) {
        types.push(data[i].machine_type);
        count.push(data[i].type_num);
      }


      var myChart = {
        labels: types,
        datasets: [{
          yAxisID: 'y-axis-1',
          data: count,
          backgroundColor: [
              '#36b9cc',
              '#f6c23e'
          ],
          borderColor: [
              '#36b9cc',
              '#f6c23e'
          ],
          borderWidth: 1
        }]
      };


      var ctx = $("#myBarChart");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: myChart,
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
  	 // responsive: true,
          title:{
            display:false,
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
    },
    error: function(data) {
      console.log(data);
    }
  });
});

