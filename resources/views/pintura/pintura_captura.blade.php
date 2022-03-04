@extends('layouts.app')
@section('content')
<body onKeyPress="if(event.keyCode == 13) event.returnValue = false;" class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid">
                        <h1 class="mt-4">Formulario de captura (pintura)</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/pintura_tabla">Captura</a></li>
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
                            <form  action="{{ action('PinturaController@agregar') }}" method="post" >
    <div class="">
    <div class="row">
    <DIV class="form-group col-md-2">
      <label for="ejemplo">Folio</label>
        <input onblur="repetidos(this)" type="number" class="form-control" id="repetido_folio" name="folio"  placeholder="folio" required>
      </DIV>
    <div class="form-group col-md-3">
        <label for="ejemplo">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha"  placeholder="" required>
      </div>
      
      <div class="form-group col-md-4">
        <label for="ejemplo">Municipio</label>
 
<div class="selector-pais ">
    
     <datalist   id="municipio" name="cbx" >
     </datalist>
     <input autocomplete="off" onchange="filtrou()" id="lista" name="mun" list="municipio" class="form-control"  type="text">   
</div>      
    </div>
    <div class="form-group col-md-3">
        <label for="ejemplo">Localidad</label>
        <div class="selector_localidad">
        <datalist name="cbx_loc"   id="localidad"  >

      </datalist>  
      <input autocomplete="off" id="lista_loc" name="loc" list="localidad" class="form-control"  type="text">   

      </div>   
    </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4">
        <label for="ejemplo">Nombres</label>
        <input  type="text" class="form-control" name="nombres"  placeholder="">
      </div>
      <div class="form-group col-md-4">
        <label for="ejemplo">Apellido Paterno</label>
        <input type="text" class="form-control" name="apellidop"  placeholder="">
      </div>
      <div class="form-group col-md-4">
        <label for="ejemplo">Apellido Materno</label>
        <input type="text" class="form-control" name="apellidom"  placeholder="">
      </div> 
      </div>
      <div class="row">
      <div class="form-group col-md-3">
        <label for="ejemplo">Sexo</label>
        <select name="sexo" class="form-control"  id="arti" >
        <option value="MUJER" >MUJER</option>
        <option value="HOMBRE" >HOMBRE</option>

      </select>      
      </div> 
      
      <div class="form-group col-md-2">
        <label for="ejemplo">Edad</label>
        <input type="number" class="form-control" name="edad"  placeholder="edad">
      </div> <div class="form-group col-md-3">
        <label for="ejemplo">Número telefónico</label>
        <input type="tel" class="form-control" name="telefono" pattern="[0-9]{10}"  placeholder="10 digitos"  >
      </div> 

      <div class="col-md-3">
      <label for="ejemplo">CURP</label>
        <input type="text" class="form-control" name="curp"  placeholder="">
       
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group col-md-4">
      <label for="ejemplo">¿El solicitante es jefe de familia?</label>
        <select name="jefe" class="form-control"  id="arti" >
        <option >SI</option>
        <option >NO</option>

      </select> 
        
      </div>
      <div class="form-group col-md-3">
      <label for="ejemplo">¿Habla maya?</label>
        <select name="maya" class="form-control"  id="arti" >
        <option >NO</option>
        <option >SI</option>

      </select> 
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
      <label for="ejemplo">Nombre de contacto 2</label>
        <input type="text" class="form-control" name="nombre_contacto2"  placeholder="">
      </div>
      <div class="form-group col-md-2">
      <label for="ejemplo">¿Habla maya?</label>
        <select name="maya2" class="form-control"  id="arti" >
        <option >NO</option>
        <option >SI</option>

      </select> 
        
      </div>
      <div class="col-md-4">
      <label for="ejemplo">Numero de contacto</label>

      <input type="tel" class="form-control" name="telefono_dos" pattern="[0-9]{10}"  placeholder="10 digitos"  >

      </div>
    
    </div>
    <DIV class="row">
      <div class="col-md-12">
      <label for="ejemplo">Nombre comprobante de domicilio</label>
        <input type="text" class="form-control" name="nombre_domicilio"  placeholder="">
      </div>
    </DIV>
    <h2>Domicilio</h2>
    <div class="row">
     <div class="form-group col-md-3">
        <label for="ejemplo">Calle</label>
        <input type="text" class="form-control" name="calle"  placeholder="calle">
      </div>
    <div class="form-group col-md-3">
        <label for="ejemplo">Número</label>
        <input type="text" class="form-control" name="numero"  placeholder="numero">
      </div>
    <div class="form-group col-md-3">
        <label for="ejemplo">Cruzamiento 1</label>
        <input type="text" class="form-control" name="cruzamiento1"  placeholder="cruzamiento1">
      </div>
     <div class="form-group col-md-3">
        <label for="ejemplo">Cruzamiento 2</label>
        <input type="text" class="form-control" name="cruzamiento2"  placeholder="cruzamiento2">
      </div>
      </div>
      <div class="row">
    <div class="form-group col-md-4">
        <label for="ejemplo">Colonia</label>
        <input type="text" class="form-control" name="colonia"  placeholder="colonia">
      </div>
       <div class="form-group col-md-4">
        <label for="ejemplo">Uso de predio</label>
        <select onchange="predioo(this)"   name="predio" class="form-control"  >
            <option value="Casa habitación" >Casa habitación</option>
            <option value="Comercio" >Comercio</option>
            <option value="Otro" >Otro</option>
       

      </select>
      </div>
      <div class="form-group col-md-4">
        <label for="ejemplo">¿Cuál?</label>
        <input type="text" class="form-control" id="cuantosp" name="predion"  placeholder="">
      </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <label for="ejemplo">Referencias domicilio</label>
        <input type="text" class="form-control" name="domicilio"  placeholder="">
        
      </div>
      </div>
      <div class="form-group row">
              <div class="col-md-8">
            <label  for="ejemplo">¿En el predio donde solicita el apoyo, habita alguna persona con discapacidad?</label>
            <div >
            <select onchange="discapacidadd(this)"   name="discapacidad" class="form-control"  >
            <option value="NO" >NO</option>
            <option value="SI" >SI</option>
       

      </select>
      </div>
        </div>
        <div class="col-md-3">
            <label for="ejemplo">¿Cuántas?</label>
            <input type="number" class="form-control" id="cuantos_disc" name="cuantosdiscapacidad"  placeholder="">
        </div>
      
      </div>
      <div class="form-group row">
              <div class="col-md-6">
            <label for="ejemplo">¿Habitan adultos mayores de 65 años?</label>
            <select onchange="adultoss(this)" name="adultos" class="form-control" aria-label=".form-select-sm example">
            <option value="NO">NO</option>
              <option value="SI">SI</option>
</select>       
            </div>
        <div class="col-md-6">
            <label for="ejemplo">¿Cuántos?</label>
            <input id="cuantosa" type="number" class="form-control" name="numadultos"  placeholder="">
        </div>
      </div>
     
<h2>Datos del apoyo a solicitar</h2>

      <div class="form-group">
        <label for="ejemplo">¿La fachada de la vivienda donde se solicita el apoyo, presenta deterioro en la pintura?</label>
        <select name="deterioro" class="form-control" aria-label=".form-select-sm example">

        <option value="NO">NO</option>
  <option value="SI">SI</option>
 
</select>
      </div>
      <div class="form-group">
        <label for="ejemplo">La vivienda donde se solicita el apoyo es de:</label>
        <select name="pisos" class="form-control" aria-label=".form-select-sm example">

        <option value="1 planta">1 planta</option>
  <option value="2 plantas">2 plantas</option>
 
</select>
      </div>
      <div class="form-group">
        <label for="ejemplo">¿Cuál es la modalidad del programa a la que le gustaria acceder?</label>
        <select name="modalidad2" class="form-control" aria-label=".form-select-sm example">

        <option value="Brocha y pintura">Brocha y pintura(autoaplicacion)</option>
  <option value="Suministro y aplicacion de pintura">Suministro y aplicacion de pintura</option>
 
</select>
      </div>
      <div class="form-group">
        <label for="ejemplo">Comentarios</label>
        <input id="" type="text" class="form-control" name="comentarios"  placeholder="">

      </div>
      <div style="text-align: center;">   
       <button id="boton" type="submit" class="btn btn-primary btn-lg btn-block">GUARDAR</button>
      </div>

  </form>
  </div>
</div>
                </main>
               
            </div>
        
    </body>
    <script type="text/javascript">
    
   
      function repetidos(elemento)
    {
      var val=$('#repetido_folio').val();
      $.ajax({
        type: "POST",
                url:"repetidos_alimentos" ,
                data: {'folio':val, 'prog':2},                 
                dataType: 'json',
                success: function(data) {
                  alert("Folio existente \n No se guardaran los datos.")
                  $(elemento).css("border-color", "red");
                       },

    error: function (error) {
    $(elemento).css("border-color", "Green");
}
            });
    }
                   function discapacidadd(sel)
{
  if(sel.value=="NO"){
    $("#cuantos_disc").prop('disabled', true);
    $("#parentesco").prop('disabled', true);
  }
  if(sel.value=="SI"){
    $("#cuantos_disc").prop('disabled', false);
    $("#parentesco").prop('disabled', false);

  }
  
}
function ninioss(sel)
{
  if(sel.value=="NO"){
    $("#cuantosn").prop('disabled', true);
  }
  if(sel.value=="SI"){
    $("#cuantosn").prop('disabled', false);

  }
}
function adultoss(sel)
{
  if(sel.value=="NO"){
    $("#cuantosa").prop('disabled', true);
  }
  if(sel.value=="SI"){
    $("#cuantosa").prop('disabled', false);

  }
}
function predioo(sel)
{
  if(sel.value=="Casa habitación"){
    $("#cuantosp").prop('disabled', true);
  }
  if(sel.value=="Comercio"){
    $("#cuantosp").prop('disabled', true);

  }
  if(sel.value=="Otro"){
    $("#cuantosp").prop('disabled', false);

  }
}
                $(document).ready(function() {      
                  $("boton").click(function(){
        $("boton").prop("disabled", false);
    });
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
                  $("#cuantos_disc").prop('disabled', true);
                  $("#cuantosa").prop('disabled', true);
    $("#parentesco").prop('disabled', true);
    $("#cuantosn").prop('disabled', true);
    $("#cuantosp").prop('disabled', true);

                    $.ajax({
                            type: "POST",
                            url: "formulario.php",
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
