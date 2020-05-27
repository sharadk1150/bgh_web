$(document).ready(function(){
  $.ajax({
    url: "data.php",
    method: "GET",
    success: function(data) {
        console.log(data);
        var opd_name = [];
        var total = [];

        for(var i in data) {
            opd_name.push("" + data[i].OPD_NAME);
            total.push(data[i].TOTAL);
        }

        var chartdata = {
            labels: opd_name,
            datasets : [
                {
                    barPercentage: 0.5,
                    barThickness: 6,
                    maxBarThickness: 8,
                    minBarLength: 2,
                    label: 'Patients Seen',
                    backgroundColor: 'rgba(100, 200, 200, 0.75)',
                    borderColor: 'rgba(200, 100, 200, 0.75)',
                    hoverBackgroundColor: 'rgba(200, 200, 200, 6)',
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: total
                }
            ]
        };

        






        var ctx = $("#mycanvas");

        var barGraph = new Chart(ctx, {
            type: 'bar',
            data: chartdata
        });
      },
      error: function(data) {
        console.log(data);
      }
    });
 })