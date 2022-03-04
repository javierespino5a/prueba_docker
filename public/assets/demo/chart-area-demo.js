// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example

    $.ajax({
      type: "POST",
      data: {'1':1},                 
      url:"visitas" ,
      dataType: 'json',
              success: function(data) {
              var ene=0;
              var feb=0;
              var mar=0;
              var abr=0;
              var may=0;
              var jun=0;
              var jul=0;
              var ago=0;
              var oct=0;
              var nov=0;
              var dec=0;
              var ene2=0;
              var feb2=0;
              var mar2=0;
              var abr2=0;
              var may2=0;
              var jun2=0;
              var jul2=0;
              var ago2=0;
              var oct2=0;
              var nov2=0;
              var dec2=0;
              for(var i = 0; i < data.length; i++){
               if(data[i].mes==1 && data[i].programa==1)
               {
                ene=data[i].visitas;
              }
                 if(data[i].mes==2 && data[i].programa==1)
               {
                feb=data[i].visitas;

               }
               if(data[i].mes==3 && data[i].programa==1)
               {
                mar=data[i].visitas;

               }
               if(data[i].mes==4 && data[i].programa==1)
               {
                abr=data[i].visitas;
 
               }
               if(data[i].mes==5 && data[i].programa==1)
               {
                may=data[i].visitas;
 
               }
               if(data[i].mes==6 && data[i].programa==1)
               {
                jun=data[i].visitas;

               }
               if(data[i].mes==7 && data[i].programa==1)
               {
                 jul=data[i].visitas;
               }
               if(data[i].mes==8 && data[i].programa==1)
               {
                ago=data[i].visitas;

               }
               if(data[i].mes==9 && data[i].programa==1)
               {
                sep=data[i].visitas;

               }
               if(data[i].mes==10 && data[i].programa==1)
               {
                oct=data[i].visitas;
 
               }
               if(data[i].mes==11 && data[i].programa==1)
               {
                nov=data[i].visitas;

               }
               if(data[i].mes==12 && data[i].programa==1)
               {
                dec=data[i].visitas;

               }
               if(data[i].mes==1 && data[i].programa==2)
               {
                ene2=data[i].visitas;
              }
                 if(data[i].mes==2 && data[i].programa==2)
               {
                feb2=data[i].visitas;

               }
               if(data[i].mes==3 && data[i].programa==2)
               {
                mar2=data[i].visitas;

               }
               if(data[i].mes==4 && data[i].programa==2)
               {
                abr2=data[i].visitas;
 
               }
               if(data[i].mes==5 && data[i].programa==2)
               {
                may2=data[i].visitas;
 
               }
               if(data[i].mes==6 && data[i].programa==2)
               {
                jun2=data[i].visitas;

               }
               if(data[i].mes==7 && data[i].programa==2)
               {
                 jul2=data[i].visitas;
               }
               if(data[i].mes==8 && data[i].programa==2)
               {
                ago2=data[i].visitas;

               }
               if(data[i].mes==9 && data[i].programa==2)
               {
                sep2=data[i].visitas;

               }
               if(data[i].mes==10 && data[i].programa==2)
               {
                oct2=data[i].visitas;
 
               }
               if(data[i].mes==11 && data[i].programa==2)
               {
                nov2=data[i].visitas;

               }
               if(data[i].mes==12 && data[i].programa==2)
               {
                dec2=data[i].visitas;

               }
              }  
              var ctxxx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctxxx,  {
  type: 'line',
  data: {
    datasets: [{
      label: "Registros alimentario",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [ene, feb, mar, abr, may, jun, jul, ago, oct, nov, dec],
    },
    {
      label: 'Registros pintura',
      lineTension: 0.3,
      backgroundColor: "rgba(226, 34, 34, 0.48)",
      borderColor: "rgba(227, 43, 43, 1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(226, 34, 34, 1)",
      pointBorderColor: "rgba(226, 34, 34, 0.34)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(227, 43, 43, 1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [ene2, feb2, mar2, abr2, may2, jun2, jul2, jun2, ago2, oct2, nov2, dec2],
  }
    
    
  ],
  labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],

  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 50,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: true
    }
  }
});

              }
          });
