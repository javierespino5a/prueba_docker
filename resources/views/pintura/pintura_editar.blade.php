@extends('layouts.app')
@section('content')
<body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid">
                        <h1 class="mt-4">Formulario de Edicion (pintura)</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Captura</a></li>
                            <li class="breadcrumb-item active">Agregar</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">                       
        Favor de llenar de manera correcta los siguientes campos.
                            </div>
                        </div>
                <div class="card mb-4" style="background-color: white;">
                <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Datos generales
                                <br>
                            </div>
                            <div class="card-body">
    <form action="{{action('PinturaController@editar')}}" method="post">
    <div class="">
    <div class="row">
    <input type="hidden" name="id" value="{{$usuarios[0]->ID_REGISTRO}}">
    <div class="form-group col-md-2">
        <label for="ejemplo">Folio</label>
        <input type="number" class="form-control" value="{{$usuarios[0]->FOLIO}}" name="folio"  placeholder="" required>
      </div>
    <div class="form-group col-md-3">
        <label for="ejemplo">Fecha</label>
        <input type="date" value="{{$usuarios[0]->FECHA}}" class="form-control" id="fecha" name="fecha"  placeholder="" required>
      </div>
      <div class="form-group col-md-4">
        <label for="ejemplo">Municipio</label>
 
<div class="selector-pais ">
    
<datalist   id="municipio" name="cbx" >
     </datalist>
     <input autocomplete="off" value="{{$usuarios[0]->MUNICIPIO}}" onchange="filtrou()" id="lista" name="mun" list="municipio" class="form-control"  type="text">   
</div>      
    </div>
    <div class="form-group col-md-3">
        <label for="ejemplo">Localidad</label>
        <div class="selector_localidad">
        <datalist name="cbx_loc"   id="localidad"  >

</datalist>  
<input autocomplete="off" value="{{$usuarios[0]->LOCALIDAD}}"  id="lista_loc" name="loc" list="localidad" class="form-control"  type="text">    
      </div>   
    </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4">
        <label for="ejemplo">Nombres</label>
        <input type="text" class="form-control" name="nombres" value="{{$usuarios[0]->NOMBRES}}" placeholder="">
      </div>
      <div class="form-group col-md-4">
        <label for="ejemplo">Apellido Paterno</label>
        <input type="text" class="form-control" name="apellidop" value="{{$usuarios[0]->APELLIDO_PATERNO}}"  placeholder="">
      </div>
      <div class="form-group col-md-4">
        <label for="ejemplo">Apellido Materno</label>
        <input type="text" class="form-control" name="apellidom" value="{{$usuarios[0]->APELLIDO_MATERNO}}" placeholder="">
      </div> 
      </div>
      <div class="row">
      <div class="form-group col-md-3">
        <label for="ejemplo">Sexo</label>
        <select value="{{$usuarios[0]->SEXO}}" name="sexo" class="form-control"  id="arti" >
        @if ($usuarios[0]->SEXO==="MUJER")
        <option value="MUJER" >MUJER</option>
        <option value="HOMBRE" >HOMBRE</option>
        @elseif ($usuarios[0]->SEXO==="HOMBRE")
        <option value="HOMBRE" >HOMBRE</option>
        <option value="MUJER" >MUJER</option>

        @endif
       

      </select>      
      </div> 
      
      <div class="form-group col-md-2">
        <label for="ejemplo">Edad</label>
        <input type="number" value="{{$usuarios[0]->EDAD}}" class="form-control" name="edad"  placeholder="18">
      </div> <div class="form-group col-md-3">
        <label for="ejemplo">Número telefónico</label>
        <input type="tel" class="form-control" value="{{$usuarios[0]->TELEFONO}}" name="telefono" pattern="[0-9]{10}"  placeholder="10 digitos"  >
      </div> 
    
      <div class="col-md-3">
      <label for="ejemplo">CURP</label>
        <input type="text" value="{{$usuarios[0]->CURP}}" class="form-control" name="curp"  placeholder="">
       
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group col-md-4">
      <label for="ejemplo">¿El solicitante es jefe de familia?</label>
        <select name="jefe" value="{{$usuarios[0]->NOMBRES}}" class="form-control"  id="arti" >
        @if ($usuarios[0]->JEFE_DE_FAMILIA==="SI")
        <option >SI</option>
        <option >NO</option>
        @elseif ($usuarios[0]->JEFE_DE_FAMILIA==="NO")
        <option >NO</option>
        <option >SI</option>
        @endif
        

      </select> 
        
      </div>
    <div class="form-group col-md-3">
    <label for="ejemplo">¿Habla maya?</label>
<select class="form-control" value="{{$usuarios[0]->MAYA}}" name="maya" id="">
@if ($usuarios[0]->MAYA==="SI")
        <option >SI</option>
        <option >NO</option>
        @elseif ($usuarios[0]->MAYA==="NO")
        <option >NO</option>
        <option >SI</option>
        @endif

</select>  
</div>  
    </div>
    <div class="row">
      <div class="col-md-6">
      <label for="ejemplo">Nombre de contacto 2</label>
        <input value="{{$usuarios[0]->NOMBRE_SEGUNDO_CONTACTO}}" type="text" class="form-control" name="nombre_contacto2"  placeholder="">
      </div>
      <div class="form-group col-md-2">
      <label for="ejemplo">¿Habla maya?</label>
        <select name="maya2" class="form-control"  id="arti" >
        @if ($usuarios[0]->MAYA_SEGUNDA_PERSONA==="SI")
        <option >SI</option>
        <option >NO</option>
        @elseif ($usuarios[0]->MAYA_SEGUNDA_PERSONA==="NO")
        <option >NO</option>
        <option >SI</option>
        @endif
       

      </select> 
        
      </div>
      <div class="col-md-4">
      <label for="ejemplo">Numero de contacto</label>

      <input value="{{$usuarios[0]->NUM_SEGUNDO_CONTACTO}}"  type="tel" class="form-control" name="telefono2" pattern="[0-9]{10}"  placeholder="10 digitos"  >

      </div>
    
    </div>
    <DIV class="row">
      <div class="col-md-12">
      <label for="ejemplo">Nombre comprobante de domicilio</label>
        <input value="{{$usuarios[0]->NOMBRE_DIR_DOM}}" type="text" class="form-control" name="nombre_domicilio"  placeholder="">
      </div>
    </DIV>
    <h2>Domicilio</h2>
    <div class="row">
     <div class="form-group col-md-3">
        <label for="ejemplo">Calle</label>
        <input value="{{$usuarios[0]->CALLE}}" type="text" class="form-control" name="calle"  placeholder="5k">
      </div>
    <div class="form-group col-md-3">
        <label for="ejemplo">Numero</label>
        <input type="text" value="{{$usuarios[0]->NUMERO}}" class="form-control" name="numero"  placeholder="450">
      </div>
    <div class="form-group col-md-3">
        <label for="ejemplo">Cruzamiento 1</label>
        <input type="text" value="{{$usuarios[0]->CRUZAMIENTO1}}" class="form-control" name="cruzamiento1"  placeholder="40">
      </div>
     <div class="form-group col-md-3">
        <label for="ejemplo">Cruzamiento 2</label>
        <input type="text" value="{{$usuarios[0]->CRUZAMIENTO2}}" class="form-control" name="cruzamiento2"  placeholder="42">
      </div>
      </div>
      <div class="row">
    <div class="form-group col-md-4">
        <label for="ejemplo">Colonia</label>
        <input type="text" value="{{$usuarios[0]->COLONIA}}" class="form-control" name="colonia"  placeholder="colonia">
      </div>
       <div class="form-group col-md-4">
        <label for="ejemplo">Uso de predio</label>
        <select value="{{$usuarios[0]->USO_PREDIO}}" onchange="predioo(this)" id="idpredio"  name="predio" class="form-control"  >
        @if ($usuarios[0]->USO_PREDIO==="Casa habitación")
        <option value="Casa habitación" >Casa habitación</option>
            <option value="Comercio" >Comercio</option>
            <option value="Otro" >Otro</option>
        @elseif ($usuarios[0]->USO_PREDIO==="Comercio")
        <option value="Comercio" >Comercio</option>
        <option value="Casa habitación" >Casa habitación</option>
            
            <option value="Otro" >Otro</option>
            @else
            <option value="Otro" >Otro</option>
            <option value="Comercio" >Comercio</option>
        <option value="Casa habitación" >Casa habitación</option>
        @endif
            
       

      </select>
      </div>
      <div class="form-group col-md-4">
        <label  for="ejemplo">¿Cuál?</label>
        <input value="{{$usuarios[0]->USO_PREDIO}}" type="text" class="form-control" id="cuantosp" name="predion"  placeholder="">
      </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <label for="ejemplo">Referencias domicilio</label>
        <input type="text" value="{{$usuarios[0]->REFERENCIA_DOMICILIO}}" class="form-control" name="domicilio"  placeholder="">
        
      </div>
      </div>

      <div class="form-group row">
              <div class="col-md-8">
            <label  for="ejemplo">¿En el predio donde solicita el apoyo, habita alguna persona con discapacidad?</label>
            <div >
            <select onchange="discapacidadd(this)" value="{{$usuarios[0]->DISCAPACIDAD}}"   name="discapacidad" class="form-control"  >
            @if ($usuarios[0]->DISCAPACIDAD==="SI")
        <option >SI</option>
        <option >NO</option>
        @elseif ($usuarios[0]->DISCAPACIDAD==="NO")
        <option >NO</option>
        <option >SI</option>
        @endif

       

      </select>
      </div>
        </div>
        <div class="col-md-3">
            <label for="ejemplo">¿Cuántas?</label>
            <input value="{{$usuarios[0]->NUM_DISCAPACITADOS}}" type="number" class="form-control" id="cuantos_disc" name="cuantosdiscapacidad"  placeholder="">
        </div>
      
      </div>
     
      <div class="form-group row">
              <div class="col-md-6">
            <label for="ejemplo">¿Habitan adultos mayores de 65 años?</label>
            <select value="{{$usuarios[0]->TERCERA_EDAD}}" onchange="adultoss(this)" name="adultos" class="form-control" aria-label=".form-select-sm example">
            <@if ($usuarios[0]->TERCERA_EDAD==="SI")
        <option >SI</option>
        <option >NO</option>
        @elseif ($usuarios[0]->TERCERA_EDAD==="NO")
        <option >NO</option>
        <option >SI</option>
        @endif
</select>       
            </div>
        <div class="col-md-6">
            <label for="ejemplo">¿Cuántos?</label>
            <input value="{{$usuarios[0]->NUM_TERCERA}}" id="cuantosa" type="number" class="form-control" name="numadultos"  placeholder="">
        </div>
      </div>
      
      <h2>Datos del apoyo a solicitar</h2>

      <div class="form-group">
        <label for="ejemplo">¿La fachada de la vivienda donde se solicita el apoyo, presenta deterioro en la pintura?</label>
        <select name="deterioro" class="form-control" aria-label=".form-select-sm example">
@if ($usuarios[0]->DETERIORO_PINTURA==="SI")
        <option >SI</option>
        <option >NO</option>
        @elseif ($usuarios[0]->DETERIORO_PINTURA==="NO")
        <option >NO</option>
        <option >SI</option>
        @endif
 
</select>
      </div>
      <div class="form-group">
        <label value="{{$usuarios[0]->NUM_PISOS}}" for="ejemplo">La vivienda donde se solicita el apoyo es de:</label>
        <select name="pisos" class="form-control" aria-label=".form-select-sm example">
        @if ($usuarios[0]->NUM_PISOS==="1 planta")
        <option value="1 planta">1 planta</option>
  <option value="2 plantas">2 plantas</option>
        @elseif ($usuarios[0]->NUM_PISOS==="2 plantas")
        <option value="2 plantas">2 plantas</option>
        <option value="1 planta">1 planta</option>
        @endif
       
</select>
      </div>
      <div class="form-group">
        <label for="ejemplo">¿Cuál es la modalidad del programa a la que le gustaria acceder?</label>
        <select value="{{$usuarios[0]->MODALIDAD_PROGRAMA}}" name="modalidad2" class="form-control" aria-label=".form-select-sm example">
        @if ($usuarios[0]->MODALIDAD_PROGRAMA==="Brocha y pintura")
        <option value="Brocha y pintura">Brocha y pintura</option>
  <option value="Suministro y aplicacion de pintura">Suministro y aplicacion de pintura</option>
        @elseif ($usuarios[0]->MODALIDAD_PROGRAMA==="Suministro y aplicacion de pintura")
        <option value="Suministro y aplicacion de pintura">Suministro y aplicacion de pintura</option>
        <option value="Brocha y pintura">Brocha y pintura</option>
        @endif
 
</select>
      </div>
      <div class="form-group">
        <label for="ejemplo">Comentarios</label>
        <input value="{{$usuarios[0]->COMENTARIO}}" id="" type="text" class="form-control" name="comentarios"  placeholder="">

      </div>
      <div style="text-align: center;">   
       <button  type="submit" class="btn btn-primary">GUARDAR</button>
      </div>

  </form>
  </div>
</div>
                </main>
               
            </div>
        
    </body>
    <script type="text/javascript">
                   function discapacidadd(sel)
{
  if(sel.value=="NO"){
    $("#cuantos_disc").prop('readonly', true);
    $("#parentesco").prop('readonly', true);
  }
  if(sel.value=="SI"){
    $("#cuantos_disc").prop('readonly', false);
    $("#parentesco").prop('readonly', false);

  }
  
}
function ninioss(sel)
{
  if(sel.value=="NO"){
    $("#cuantosn").prop('readonly', true);
  }
  if(sel.value=="SI"){
    $("#cuantosn").prop('readonly', false);

  }
}
function adultoss(sel)
{
  if(sel.value=="NO"){
    $("#cuantosa").prop('readonly', true);
  }
  if(sel.value=="SI"){
    $("#cuantosa").prop('readonly', false);

  }
}
function predioo(sel)
{
  if(sel.value=="Casa habitación"){
    $("#cuantosp").prop('readonly', true);
  }
  if(sel.value=="Comercio"){
    $("#cuantosp").prop('readonly', true);

  }
  if(sel.value=="Otro"){
    $("#cuantosp").prop('readonly', false);

  }
}
                $(document).ready(function() {      
                        $("#lista").on('input', function () {
   var val=$('#lista').val();
   var ejemplo = $('#municipio').find('option[value="'+val+'"]').data('foo');
   $.ajax({
        type: "POST",
                url:"/captura/public/combo.php" ,
                data: {'id':ejemplo},                 

                success: function(data) {
                  var numero = document.getElementById("lista_loc");
                  numero.value="";

                    $('.selector_localidad datalist').html(data)                
                       }
            });
});
                  $("#cuantos_disc").prop('readonly', true);
                  $("#cuantosa").prop('readonly', true);
    $("#parentesco").prop('readonly', true);
    $("#cuantosn").prop('readonly', true);
    $("#cuantosp").prop('readonly', true);

                    $.ajax({
                            type: "POST",
                            url: "/captura/public/formulario.php",
                            success: function(response)
                            {
                                $('.selector-pais datalist').html(response)
                            }
                    });

                });
              
 function filtrou()
{
  var combo = document.getElementById("cbx");
  var selected = combo.options[combo.selectedIndex];
var extra = selected.getAttribute('data-foo');
    $.ajax({
        type: "POST",
                url:"combo.php" ,
                data: {'id':extra},                 

                success: function(data) {
                    $('.selector_localidad select').html(data).fadeIn();                  
                       }
            });
}

            </script>
@stop
