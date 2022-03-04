@extends('layouts.app')
@section('content')
<body id="body" class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div id="tabla" class="container-fluid">
                        <h1 class="mt-4">Detalle Tareas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Tareas</a></li>
                            <li id="id" class="breadcrumb-item active">Reporte</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">                       
                            <select  id="cbx_ubi" onchange="filtrou()">
                            <option value="0">Seleccione una ubicación</option>  
                            @foreach($ubicaciones as $ubis)
                                <option name="asd" value="{{$ubis->ID}}">{{$ubis->UBICACION}}</option>
                                @endforeach
                            </select>    
                            <select  id="cbx_fech" onchange="filtrouf()">
                            <option value="0">Seleccione una fecha</option>  
                        
                            </select>    
                            <select  id="cbx_act" onchange="">
                            <option value="0">Seleccione una actividad</option>  
                            @foreach($actividades as $ubis)
                                <option name="asd" value="{{$ubis->ID}}">{{$ubis->ACTIVIDAD}}</option>
                                @endforeach
                            </select>      
                            <button onclick="buscar()">Buscar</button>                  
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
                                            <th>descripcion</th>
                                            <th>existe</th>
                                            <th>cantidad</th>
                                            <TH>instalado</TH>
                                            <TH>estado</TH>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr>
                                            
                                                <td>{{$usuario->descripcion}}</td>
                                                @if($usuario->existe=1)
                                                <td>Si</td>
                                                @else
                                                <td>No</td>
                                                @endif
                                                <td>{{$usuario->cantidad}}</td>
                                                @if($usuario->instalado==null)
                                                <td>N/A</td>
                                                @else
                                                <td>Si</td>
                                                @endif
                                                <td>{{$usuario->estado}}</td>
                                            
                                            </tr>
                                            @endforeach
                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                             <th>descripcion</th>
                                            <th>existe</th>
                                            <th>cantidad</th>
                                            <TH>instalado</TH>
                                            <TH>estado</TH>
                                                    
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
function filtrou()
{
    var combo = document.getElementById("cbx_ubi");
    var actividades=document.getElementById("cbx_act");
    var fecha=document.getElementById("cbx_fech");

    $.ajax({
        type: "POST",
                data: {'ubid':combo.options[combo.selectedIndex].value, 'ubin':combo.options[combo.selectedIndex].text, 'actid':actividades.options[actividades.selectedIndex].value,'actn':actividades.options[actividades.selectedIndex].text, 'fech':fecha.options[fecha.selectedIndex].text},                 
                url:"{{url('/tareasp')}}" ,
                dataType: 'json',
                success: function(data) {
                    var tr = "";
                    tr += "<select  id='cbx_fech' onchange='filtrouf()'>";
                          tr += " <option value=''> Seleccione una fecha</option>" 
                      for(var i = 0; i < data.length; i++){
                          
                          tr += "<option name='asd' value=''>"+data[i].FECHA+"</option>" 
                         
                          
                      }  
                      tr += "</select>" 

                      if($.isEmptyObject(data))
                      {
                        tr += "<select  id='cbx_fech' onchange='filtrou()'>";
                          tr += " <option value=''> Seleccione una fecha</option>" 
                          tr += "</select>" 
                      }
                 
                    $('#cbx_fech').html(tr);   

                    
                }
            });
}
function filtrouf()
{
    var combo = document.getElementById("cbx_ubi");
    var actividades=document.getElementById("cbx_act");
    var fecha=document.getElementById("cbx_fech");

    $.ajax({
        type: "POST",
                data: {'ubid':combo.options[combo.selectedIndex].value, 'ubin':combo.options[combo.selectedIndex].text, 'actid':actividades.options[actividades.selectedIndex].value,'actn':actividades.options[actividades.selectedIndex].text, 'fech':fecha.options[fecha.selectedIndex].text},                 
                url:"{{url('/filtrouf')}}" ,
                dataType: 'json',
                success: function(data) {
                    var tr = "";
                    tr += "<select  id='cbx_act' onchange='filtrouf()'>";
                          tr += " <option value=''> Seleccione una actividad</option>" 
                      for(var i = 0; i < data.length; i++){
                       
                          tr += "<option name='asd' value=''>"+data[i].actividad+"</option>" 
                           
                         
                         
                      }  
                      tr += "</select>"
                    $('#cbx_act').html(tr);   

                    
                }
            });
}
function buscar()
{
    var combo = document.getElementById("cbx_ubi");
    var actividades=document.getElementById("cbx_act");
    var fecha=document.getElementById("cbx_fech");
    alert(combo.options[combo.selectedIndex].text);
    $.ajax({
        type: "POST",
                data: {'ubid':combo.options[combo.selectedIndex].value, 'ubin':combo.options[combo.selectedIndex].text, 'actid':actividades.options[actividades.selectedIndex].value,'actn':actividades.options[actividades.selectedIndex].text, 'fech':fecha.options[fecha.selectedIndex].text},                 
                url:"{{url('/buscar')}}" ,
                dataType: 'json',
                success: function(data) {
                    var tr = "";
                    $('#dataTable').dataTable().fnClearTable();
                      for(var i = 0; i < data.length; i++){
                       if(data[i].existe==1){ data[i].existe="SI" }
                       else if(data[i].existe==0){data[i].existe="NO"}
                       if(data[i].estado=="1"){data[i].estado="Muy mal estado"}
                       else if(data[i].estado=="2"){data[i].estado="Mal estado"}
                       else if(data[i].estado=="3"){data[i].estado="Buen estado"}
                       else if(data[i].estado=="4"){data[i].estado="Excelente"}
                       if(data[i].instalado==null){data[i].instalado="N/A"}
                       else if(data[i].instalado=="1"){data[i].instalado="SI"}
                       $('#dataTable').dataTable().fnAddData( [
                        data[i].descripcion,
                        data[i].existe,
                        data[i].cantidad,
                        data[i].instalado,
                        data[i].estado] );
                      }  
                     
                  
                    
                }
            });
}
</script>