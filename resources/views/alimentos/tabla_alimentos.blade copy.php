@extends('layouts.app')
@section('content')
<body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Capturas apoyo alimentario</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Apoyo alimentario</a></li>
                            <li class="breadcrumb-item active">apoyo alimentario</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">                       
        Esta tabla contiene los datos del programa apoyo alimentario con sus respectivas estadisticas.
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
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>FOLIO</th>
                                            <th>NOMBRES</th>
                                            <th>APELLIDO PATERNO</th>
                                            <th>APELLIDO MATERNO</th>
                                            <th>MUNICIPIO</th>
                                            <th>LOCALIDAD</th>
                                            <TH>CURP</TH>
                                            <th>CALLE</th>
                                            <th>NUMERO</th>
                                            <th>CRUZAMIENTO1</th>
                                            <th>CRUZAMIENTO2</th>
                                            <th>COLONIA</th>
                                            <th>REFERENCIA DOMICILIO</th>
                                            <th>SEXO</th>
                                            <th>EDAD</th>
                                            <th>TELEFONO</th>
                                            <th>JEFE DE FAMILIA</th>
                                            <TH>HABLA MAYA</TH>
                                          
                                           
                                            <TH>USO PREDIO</TH>
                                            <th>DISCAPACIDAD</th>
                                            <th>NUM DISCAPACITADOS</th>
                                            <th>MAYORES DE 65</th>
                                            <th>NUM PERSONAS MAYORES</th>
                                            <th>HABITAN NINIOS</th>
                                            <TH>NUM NIÑOS</TH>
                                            <TH>MUJERES LACTANCIA O GESTACION</TH>
                                            <th>COMENTARIO</th>
                                            
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr>
                                            
                                                <td id="id"> <a id="" class='btn btn-warning btn-lg btn-block' href="{{url('/editar_r/'.$usuario->ID_REGISTRO)}}" style="BACKGROUND-COLOR: aliceblue; BORDER-COLOR: CORNFLOWERBLUE;">{{$usuario->FOLIO}}</a> 
</td>              
<td>{{$usuario->NOMBRES}}</td>                   
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
                                                
                                                
                                                <TD>{{$usuario->USO_PREDIO}}</TD>
                                                <TD>{{$usuario->DISCAPACIDAD}}</TD>
                                                <TD>{{$usuario->NUM_DISCAPACITADOS}}</TD>
                                                <TD>{{$usuario->TERCERA_EDAD}}</TD>
                                                <TD>{{$usuario->NUM_TERCERA}}</TD>
                                                <TD>{{$usuario->HABITAN_NINIOS}}</TD>
                                                <TD>{{$usuario->NUM_NINIOS}}</TD>
                                                <TD>{{$usuario->MUJERES_PERIODO}}</TD>


                                                <TD>{{$usuario->COMENTARIO}}</TD>

                                            
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
                                            <th>MUNICIPIO</th>
                                            <th>LOCALIDAD</th>
                                            <TH>CURP</TH>
                                            <th>CALLE</th>
                                            <th>NUMERO</th>
                                            <th>CRUZAMIENTO1</th>
                                            <th>CRUZAMIENTO2</th>
                                            <th>COLONIA</th>
                                            <th>REFERENCIA DOMICILIO</th>
                                            <th>SEXO</th>
                                            <th>EDAD</th>
                                            <th>TELEFONO</th>
                                            <th>JEFE DE FAMILIA</th>
                                            <TH>HABLA MAYA</TH>
                                          
                                           
                                            <TH>USO PREDIO</TH>
                                            <th>DISCAPACIDAD</th>
                                            <th>NUM DISCAPACITADOS</th>
                                            <th>MAYORES DE 65</th>
                                            <th>NUM PERSONAS MAYORES</th>
                                            <th>HABITAN NINIOS</th>
                                            <TH>NUM NIÑOS</TH>
                                            <TH>MUJERES LACTANCIA O GESTACION</TH>
                                            <th>COMENTARIO</th>
                                            


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

function eliminar(id){
    $.ajax({   headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        type: "POST",
                data: {'id':id},                 
                url:"{{url('/eliminarinv')}}" ,
                dataType: 'html',
                success: function(data) {
                    window.location.reload();
                  alert("se borro");

                }
            });
}
</script>
@stop
