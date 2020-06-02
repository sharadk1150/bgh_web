$(document).ready(function(){
    $.ajax({
      url: "data_opd_cash_coll.php",
      method: "GET",
      success: function(data) {
          console.log(data);
          var visit_date = [];
          var total = [];
  
          for(var i in data) {
              visit_date.push("" + data[i].VISIT_DATE);
              total.push(data[i].TOTAL);
          }
  
          var chartdata = {
              labels: visit_date,
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