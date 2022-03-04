@extends('layouts.app')
@section('content')

<body class="sb-nav-fixed"> 
   <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Actividad</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                            <li class="breadcrumb-item active">Gráficas</li>
                        </ol>
                        <div class="card mb-4">
                          No te olvides de cerrar Sesión al salir, GRACIAS
                        </div>
                        
                        <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Efectividad en Capturas
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                                    <div class="card-footer small text-muted"><?php date_default_timezone_set('America/Mexico_City');setlocale(LC_TIME,"es_ES"); echo strftime("Actualizado a hoy %A a la hora %H:%M"); ?></div>
                                </div>
                          
                      </div>
                      
                     
                </main>
               
            
        </div>
      
        
    </body>
</html>

<SCript>

$.ajax({
      type: "POST",
      data: {'1':1},                 
      url:"{{url('/visitas')}}",
      dataType: 'json',
              success: function(data) {
                var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Blue", "Red"],
    datasets: [{
      data: [20, 10,],
      backgroundColor: ['#007bff', '#dc3545'],
    }],
  },
});

              }
          });
</SCript>

@stop