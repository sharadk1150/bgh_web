$(document).ready(function(){
    $.ajax({
      url: "data_misc_party_wise.php",
      method: "GET",
      success: function(data) {
          console.log(data);
          var party_name = [];
          var total = [];
  
          for(var i in data) {
              party_name.push("" + data[i].PARTY_NAME);
              total.push(data[i].TOTAL);
          }
  
          var chartdata = {
              labels: party_name,
              datasets : [
                  {
                      barPercentage: 0.5,
                      barThickness: 6,
                      maxBarThickness: 8,
                      minBarLength: 2,
                      label: 'Party Name',
                      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
//                      backgroundColor: 'rgba(100, 200, 200, 0.75)',
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