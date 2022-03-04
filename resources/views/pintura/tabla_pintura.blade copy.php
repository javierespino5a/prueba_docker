@extends('layouts.app')
@section('content')
<body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Capturas apoyo Pintura</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Apoyo pintura</a></li>
                            <li class="breadcrumb-item active">apoyo pintura</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">    
                            <div class="row" >
                            <div class="col-md-4">
                                            
                            <label for="ejemplo">Municipio</label>
 
 <div class="selector-pais ">
     
      <datalist   id="municipio" name="cbx" >
      </datalist>
      <input autocomplete="off" onchange="filtrou()" id="lista" name="mun" list="municipio" class="form-control"  type="text">    
      </div>
      </div>
      <div class="col-md-4">
                <label for="ejemplo">Localidad</label>
        <div class="selector_localidad">
        <datalist name="cbx_loc"   id="localidad"  >

      </datalist>  
      <input autocomplete="off" id="lista_loc" name="loc" list="localidad" class="form-control"  type="text">  
      </div>    
      </div> 
      <div class="col-md-4" style="padding-top: 30px;">        
      <button  type="submit" onclick="buscar()" class="btn btn-primary button ">Filtrar</button> 
      </div> 
      </div> 
      <div class="row">
            <div class="col-md-5">
            <label for="ejemplo">Folio</label>
            <input type="text" class="form-control" name="folio2" id="folio" placeholder="">

            </div>
            <div class="col-md-5" style="padding-top: 30px;">
            <button  type="submit" onclick="buscar_folio()" class="btn btn-primary button ">Buscar folio</button> 

            </div>
      </div>
      <br>            
    <div id="spin"></div>
        </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Reporte
    


</a>
                            </div>
                           
       
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable_pintura" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>FOLIO</th>
                                            <th>NOMBRES</th>
                                            <th>APELLIDO PATERNO</th>
                                            <th>APELLIDO MATERNO</th>
                                            <TH>ACCION</TH>
                                            <th>MUNICIPIO</th>
                                            <th>LOCALIDAD</th>

                                            <th>CURP</th>
                                            <th>CALLE</th>
                                            <th>NUMERO</th>
                                            <th>CRUZAMIENTO1</th>
                                            <th>CRUZAMIENTO2</th>
                                              <TH>COLONIA</TH>
                                            <th>REFERENCIA_DOMICILIO</th>
                                            <th>SEXO</th>
                                            <th>EDAD</th>
                                            <th>TELEFONO</th>
                                            <th>JEFE DE FAMILIA</th>
                                            <th>HABLA MAYA</th>
                                            <th>NOMBRE_SEGUNDO CONTACTO</th>
                                            <th>NUMERO SEGUNDO CONTACTO</th>
                                            <th>HABLA MAYA SEGUNDA PERSONA</th>                                            
                                            <th>NOMBRE DUEÑO DOMICILIO</th>
                                            <th>USO PREDIO</th>
                                            <th>DISCAPACIDAD</th>
                                            <th>NUM_DISCAPACITADOS</th>
                                            <th>TERCERA EDAD</th>
                                            <th>NUMERO DE ADULTOS TERCERA EDAD</th>
                                            <th>COMENTARIO</th>
                                            <th>DETERIORO PINTURA</th>
                                            <th>NUMERO DE PISOS</th>
                                            <th>MODALIDAD</th>
                                            <th>FECHA</th>
<TH>FECHA CAPTURA</TH>

                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr>
                                            
                                                <td id="id"> <a id="" class='btn btn-warning btn-lg btn-block' href="{{url('/pintura_editar/'.$usuario->ID_REGISTRO)}}" style="BACKGROUND-COLOR: aliceblue; BORDER-COLOR: CORNFLOWERBLUE;">{{$usuario->FOLIO}}</a> 
</td>                                 <td>{{$usuario->NOMBRES}}</td>
                                                <td>{{$usuario->APELLIDO_PATERNO}}</td>
                                                <td>{{$usuario->APELLIDO_MATERNO}}</td>
                                                <td>{{$usuario->MUNICIPIO}}</td>
                                                <td>{{$usuario->LOCALIDAD}}</td>
                                                <TD>{{$usuario->CURP}}</TD>
                                                <TD>{{$usuario->CALLE}}</TD>
                                                <TD>{{$usuario->NUMERO}}</TD>
                                                <TD>{{$usuario->CRUZAMIENTO1}}</TD>
                                                <TD>{{$usuario->CRUZAMIENTO2}}</TD>
                                                <TD>{{$usuario->COLONIA}}</TD>
                                                <TD>{{$usuario->REFERENCIA_DOMICILIO}}</TD>
                                                
                                                <td>{{$usuario->SEXO}}</td>
                                                <td>{{$usuario->EDAD}}</td>
                                                <td>{{$usuario->TELEFONO}}</td>
                                                <TD>{{$usuario->JEFE_DE_FAMILIA}}</TD>
                                                <TD>{{$usuario->MAYA}}</TD>
                                                <TD>{{$usuario->NOMBRE_SEGUNDO_CONTACTO}}</TD>
                                                <TD>{{$usuario->NUM_SEGUNDO_CONTACTO}}</TD>
                                                <TD>{{$usuario->MAYA_SEGUNDA_PERSONA}}</TD>
                                                 <TD>{{$usuario->NOMBRE_DIR_DOM}}</TD>
                                                <TD>{{$usuario->USO_PREDIO}}</TD>
                                                <TD>{{$usuario->DISCAPACIDAD}}</TD>
                                                <TD>{{$usuario->NUM_DISCAPACITADOS}}</TD>
                                                <TD>{{$usuario->TERCERA_EDAD}}</TD>
                                                <TD>{{$usuario->NUM_TERCERA}}</TD>
                                                <TD>{{$usuario->COMENTARIO}}</TD>
                                                <TD>{{$usuario->DETERIORO_PINTURA}}</TD>
                                                <TD>{{$usuario->NUM_PISOS}}</TD>
                                                <TD>{{$usuario->MODALIDAD_PROGRAMA}}</TD>

                                            
                                                <div class="modal fade" id="exampleModal{{$usuario->ID_REGISTRO}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$usuario->ID_REGISTRO}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el inventario seleccionado?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a type="button" id="{{$usuario->ID_REGISTRO}}" onclick="eliminar(this.id)" class="btn btn-primary">Aceptar</a>
      </div>
    </div>
  </div>
</div>
                                            
                                            </tr>
                                            @endforeach
                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>FOLIO</th>
                                            <th>NOMBRES</th>
                                            <th>APELLIDO PATERNO</th>
                                            <th>APELLIDO MATERNO</th>
                                            <TH>ACCION</TH>
                                            <th>MUNICIPIO</th>
                                            <th>LOCALIDAD</th>

                                            <th>CURP</th>
                                            <th>CALLE</th>
                                            <th>NUMERO</th>
                                            <th>CRUZAMIENTO1</th>
                                            <th>CRUZAMIENTO2</th>
                                              <TH>COLONIA</TH>
                                            <th>REFERENCIA_DOMICILIO</th>
                                            <th>SEXO</th>
                                            <th>EDAD</th>
                                            <th>TELEFONO</th>
                                            <th>JEFE DE FAMILIA</th>
                                            <th>HABLA MAYA</th>
                                            <th>NOMBRE_SEGUNDO CONTACTO</th>
                                            <th>NUMERO SEGUNDO CONTACTO</th>
                                            <th>HABLA MAYA SEGUNDA PERSONA</th>                                            
                                            <th>NOMBRE DUEÑO DOMICILIO</th>
                                            <th>USO PREDIO</th>
                                            <th>DISCAPACIDAD</th>
                                            <th>NUM_DISCAPACITADOS</th>
                                            <th>TERCERA EDAD</th>
                                            <th>NUMERO DE ADULTOS TERCERA EDAD</th>
                                            <th>COMENTARIO</th>
                                            <th>DETERIORO PINTURA</th>
                                            <th>NUMERO DE PISOS</th>
                                            <th>MODALIDAD</th>
<th>FECHA</th>
<TH>FECHA CAPTURA</TH>






                                          
                                  
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
<script>

function buscar()
{
    var mun=$('#lista').val();   
var loc= $('#lista_loc').val();   
$('#spin').html('<div class="loading"><img src="assets/img/loader.gif"/><br/>Un momento, por favor...</div>');

    
    $.ajax({
        type: "POST",
                data: {'mun':mun, 'loc':loc, 'prog':'2'},                 
                url:"{{url('/buscar_munloc')}}" ,
                dataType: 'json',
                success: function(data) {
                    var tr = "";
                    $('#dataTable_pintura').dataTable().fnClearTable();
                      for(var i = 0; i < data.length; i++){
                        tr+= "<a id='"+data[i].ID_REGISTRO+"' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal"+data[i].ID_REGISTRO+"'> <i class='far fa-trash-alt'> </i> </a>" ;
                       tr+=  "<div class='modal fade' id='exampleModal"+data[i].ID_REGISTRO+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                       tr+= "<div class='modal-dialog' role='document'>";
                       tr+= "<div class='modal-content'>";
                       tr+= "<div class='modal-header'>";
                       tr+=  "<h5 class='modal-title' id='exampleModalLabel'>"+data[i].ID_REGISTRO+"</h5>";
                       tr+= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                       tr+=  "<span aria-hidden='true'>&times;</span>";
                       tr+= "</button>";
                       tr+=  "</div>";
                       tr+= "<div class='modal-body'>";
                       tr+=  "¿Desea eliminar el Registro seleccionado?";
                       tr+=  "</div>";
                       tr+= "<div class='modal-footer'>";
                       tr+=  "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
                       tr+= "<a type='button' id='"+data[i].ID_REGISTRO+"' onclick='eliminar(this.id)' class='btn btn-primary'>Aceptar</a>";
                       tr+= "</div>";
                       tr+= "</div>";
                       tr+= "</div>";
                       tr+= "</div>";

                       $('#dataTable_pintura').dataTable().fnAddData( [

        
                        "<a id='' class='btn btn-warning btn-lg btn-block' href='/captura/public/pintura_editar/"+data[i].ID_REGISTRO+"' style='BACKGROUND-COLOR: aliceblue; BORDER-COLOR: CORNFLOWERBLUE;'>"+data[i].FOLIO+"</a>",
                        data[i].NOMBRES,
                        data[i].APELLIDO_PATERNO,
                        data[i].APELLIDO_MATERNO,
                        tr,
                        data[i].MUNICIPIO,
                        data[i].LOCALIDAD,
                        data[i].CURP,                  
                        data[i].CALLE,
                        data[i].NUMERO,
                        data[i].CRUZAMIENTO1,
                        data[i].CRUZAMIENTO2,
                        data[i].COLONIA,
                        data[i].REFERENCIA_DOMICILIO,
                        data[i].SEXO,
                        data[i].EDAD,
                        data[i].TELEFONO,
                        data[i].JEFE_DE_FAMILIA,
                        data[i].MAYA,
                        data[i].NOMBRE_SEGUNDO_CONTACTO,
                        data[i].NUM_SEGUNDO_CONTACTO,
                        data[i].MAYA_SEGUNDA_PERSONA,
                        data[i].NOMBRE_DIR_DOM,
                        data[i].USO_PREDIO,
                        data[i].DISCAPACIDAD,
                        data[i].NUM_DISCAPACITADOS,
                        data[i].TERCERA_EDAD,
                        data[i].NUM_TERCERA,
                        data[i].COMENTARIO,
                        data[i].DETERIORO_PINTURA,
                        data[i].NUM_PISOS,
                        data[i].MODALIDAD_PROGRAMA,
                        data[i].FECHA,
                        data[i].FECHA_CAPTURA,

                        ] );
                        tr="";
                      }  
                      $('#spin').html('<div class="spin"></div>');

                  
                    
                }
            });
}
$(document).ready(function() {      
                        $("#lista").on('input', function () {
   var val=$('#lista').val();
   var ejemplo = $('#municipio').find('option[value="'+val+'"]').data('foo');
   $.ajax({
        type: "POST",
                url:"combo.php" ,
                data: {'id':ejemplo},                 

                success: function(data) {
                  var numero = document.getElementById("lista_loc");
                  numero.value="";

                    $('.selector_localidad datalist').html(data)                
                       }
            });
});
                 

                    $.ajax({
                            type: "POST",
                            url: "formulario.php",
                            success: function(response)
                            {
                                $('.selector-pais datalist').html(response)
                            }
                    });

                });
                function eliminar(id){
    $.ajax({   headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        type: "POST",
                data: {'id':id},                 
                url:"{{url('/eliminar_al')}}" ,
                dataType: 'html',
                success: function(data) {
                    window.location.reload();
                  alert("se eliminó el registro");

                }
            });
}
function buscar_folio()
{
    var mun=$('#lista').val();   
var loc= $('#lista_loc').val();   
var folio=$('#folio').val();
$('#spin').html('<div class="loading"><img src="assets/img/loader.gif"/><br/>Un momento, por favor...</div>');

    $.ajax({
        type: "POST",
                data: {'mun':mun, 'loc':loc, 'prog':'2','folio':folio},                 
                url:"{{url('/buscar_folio')}}" ,
                dataType: 'json',
                success: function(data) {
                    var tr = "";
                    $('#dataTable_pintura').dataTable().fnClearTable();
                      for(var i = 0; i < data.length; i++){
                       tr+= "<a id='"+data[i].ID_REGISTRO+"' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal"+data[i].ID_REGISTRO+"'> <i class='far fa-trash-alt'> </i> </a>" ;
                       tr+=  "<div class='modal fade' id='exampleModal"+data[i].ID_REGISTRO+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                       tr+= "<div class='modal-dialog' role='document'>";
                       tr+= "<div class='modal-content'>";
                       tr+= "<div class='modal-header'>";
                       tr+=  "<h5 class='modal-title' id='exampleModalLabel'>"+data[i].ID_REGISTRO+"</h5>";
                       tr+= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                       tr+=  "<span aria-hidden='true'>&times;</span>";
                       tr+= "</button>";
                       tr+=  "</div>";
                       tr+= "<div class='modal-body'>";
                       tr+=  "¿Desea eliminar el Registro seleccionado?";
                       tr+=  "</div>";
                       tr+= "<div class='modal-footer'>";
                       tr+=  "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
                       tr+= "<a type='button' id='"+data[i].ID_REGISTRO+"' onclick='eliminar(this.id)' class='btn btn-primary'>Aceptar</a>";
                       tr+= "</div>";
                       tr+= "</div>";
                       tr+= "</div>";
                       tr+= "</div>";
                       $('#dataTable_pintura').dataTable().fnAddData( [
                        "<a id='' class='btn btn-warning btn-lg btn-block' href='/captura/public/editar_r/"+data[i].ID_REGISTRO+"' style='BACKGROUND-COLOR: aliceblue; BORDER-COLOR: CORNFLOWERBLUE;'>"+data[i].FOLIO+"</a>",
                    

                        data[i].NOMBRES,
                        data[i].APELLIDO_PATERNO,
                        data[i].APELLIDO_MATERNO,
                        tr,
                        data[i].MUNICIPIO,
                        data[i].LOCALIDAD,
                        data[i].CURP,                  
                        data[i].CALLE,
                        data[i].NUMERO,
                        data[i].CRUZAMIENTO1,
                        data[i].CRUZAMIENTO2,
                        data[i].COLONIA,
                        data[i].REFERENCIA_DOMICILIO,
                        data[i].SEXO,
                        data[i].EDAD,
                        data[i].TELEFONO,
                        data[i].JEFE_DE_FAMILIA,
                        data[i].MAYA,
                        data[i].NOMBRE_SEGUNDO_CONTACTO,
                        data[i].NUM_SEGUNDO_CONTACTO,
                        data[i].MAYA_SEGUNDA_PERSONA,
                        data[i].NOMBRE_DIR_DOM,
                        data[i].USO_PREDIO,
                        data[i].DISCAPACIDAD,
                        data[i].NUM_DISCAPACITADOS,
                        data[i].TERCERA_EDAD,
                        data[i].NUM_TERCERA,
                        data[i].COMENTARIO,
                        data[i].DETERIORO_PINTURA,
                        data[i].NUM_PISOS,
                        data[i].MODALIDAD_PROGRAMA,
                        data[i].FECHA,
                        data[i].FECHA_CAPTURA,
                        
                        ] );
                        tr="";
                      }  
                     
                      $('#spin').html('<div class="spin"></div>');

                    
                }
            });
}

</script>
@stop
