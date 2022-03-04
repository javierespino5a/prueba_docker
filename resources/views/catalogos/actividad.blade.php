@extends('layouts.app')
@section('content')
<body id="body" class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div id="tabla" class="container-fluid">
                        <h1 class="mt-4">Detalle Actividades</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Actividades</a></li>
                            <li id="id" class="breadcrumb-item active">Reporte</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body row">      
                            <div class="col-md-5">     
                            <a href="">UBICACION</a><br>           
                            <select  id="cbx_ubi" onchange="">
                            <option value="0">Seleccione una ubicación</option>  
                            @foreach($ubicaciones as $ubis)
                                <option name="asd" value="{{$ubis->ID}}">{{$ubis->UBICACION}}</option>
                                @endforeach
                            </select>   
                            </div> 
                            <div class="col-md-2">
                            <a href="">FECHA INICIAL</a><br>
                            <input type="date" id="ini" name="ini">
                            </div> 
                            <div class="col-md-2">
                            <a href="">FECHA FINAL</a><br>
                            <input type="date" id="fin" name="fin">
                            </div>
                             <div class="col-md-2">
                             <br>
                            <button onclick="buscar()">Buscar</button>   
                            </div>               
                            </div>
                        </div>
                            
                
                        <div   class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Reporte
                            </div>
                           
       
                            <div   class="card-body">
                                <div class="table-responsive">
                                    <table  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>Actividad</th>
                                            <th>OBSERVACIONES</th>
                                            <th>FECHA</th>
                                            <TH>SUPERVISOR</TH>
                                            <TH>CALIFICACIÒN</TH>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr>
                                            
                                                <td>{{$usuario->actividad}}</td>
                                              
                                                <td>{{$usuario->observaciones}}</td>
                                                <td>{{$usuario->FECHA}}</td>
                                                <td>{{$usuario->supervisor}}</td>
                                                <td>{{$usuario->suma}}</td>


                                            
                                            </tr>
                                            @endforeach
                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Actividad</th>
                                            <th>OBSERVACIONES</th>
                                            <th>FECHA</th>
                                            <TH>SUPERVISOR</TH>
                                            <TH>CALIFICACIÒN</TH>
                                                    
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script>


function buscar()
{
    var combo = document.getElementById("cbx_ubi");
    var date = new Date($('#ini').val()); 
    var date2 = new Date($('#fin').val());
    month = date.getMonth()+1; 
month2=date2.getMonth()+1;
    var fechai=date.getFullYear()+"-"+month+"-"+date.getDate();
    var fechaf=date2.getFullYear()+"-"+month2+"-"+date2.getDate();
    

    alert(combo.options[combo.selectedIndex].text);
    $.ajax({
        type: "POST",
                data: {'ubid':combo.options[combo.selectedIndex].value,'fechai':fechai,'fechaf':fechaf },                 
                url:"{{url('/actividades')}}" ,
                dataType: 'json',
                success: function(data) {
                    var tr = "";
                    $('#dataTable').dataTable().fnClearTable();

                      for(var i = 0; i < data.length; i++){
                        $('#dataTable').dataTable().fnAddData( [
                        data[i].actividad,
                        data[i].observaciones,
                        data[i].fecha,
                        data[i].supervisor,
                        data[i].suma] );
                      
                      }  

                    
                }
            });
}
</script>