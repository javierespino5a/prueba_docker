@extends('layouts.app')
@section('content')
<body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detalle Módulos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Módulos</a></li>
                            <li class="breadcrumb-item active">Reporte</li>
                        </ol>
                        <div class="card mb-4">
                                         
                           
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Reporte
                            </div>
                           
       
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>UBICACION</th>
                                            <th>PUNTOS</th>
                                            <th>PORCENTAJE</th>
                                            <TH>SUPERVISOR</TH>
                                            
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr>
                                                <td>{{$usuario->UBICACION}}</td>
                                                <td>{{$usuario->puntos}}</td>
                                                @if($usuario->PORCENTAJE>50)
                                                <td style="display: block;background-color: greenyellow;">{{$usuario->PORCENTAJE}}</td>
                                                @elseif($usuario->PORCENTAJE<=50)
                                                <td style="display: block;background-color: red;">{{$usuario->PORCENTAJE}}</td>
                                                @endif
                                                <td>{{$usuario->supervisor}}</td>
                                            
                                            </tr>
                                            @endforeach
                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>UBICACION</th>
                                            <th>PUNTOS</th>
                                            <th>PORCENTAJE</th>
                                            <TH>SUPERVISOR</TH>   
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
               
            </div>
        
    </body>
@stop
<script>
function año()
{
    var combo = document.getElementById("cbx_rango");
    
    $.ajax({
        type: "POST",
                data: {'rango':combo.options[combo.selectedIndex].value},                 
                url:"{{url('/año')}}" ,
                dataType: 'json',
                success: function(data) {
                    var tr = "";
                
                for(var i = 0; i < data.length; i++){
                 
                    tr += "<tr>" 
                    tr += "td>asd</td>" 
                    tr += "<td>"+data[i].UBICACION+"</td>" 
                    tr += "<td>"+data[i].CALIFICACION+"</td>" 
                    tr += "<td>"+data[i].OBSERVACIONES+"</td>" 
                    tr += "<td>"+data[i].FECHA+"</td>" 
                    tr += "<td>"+data[i].NOMBRE+"</td>" 

                    tr += "</tr> ";
                }  
              $('.dataTable > tbody').html(tr);   

               

                    
                }
            });
}
</script>