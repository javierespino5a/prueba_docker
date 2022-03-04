@extends('layouts.app')
@section('content')
<body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Generar reporte</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Apoyo pintura</a></li>
                            <li class="breadcrumb-item active">apoyo pintura</li>
                        </ol>
                        <form action="{{ action('PinturaController@reporteimprimir') }}" method="get">

                        <div class="card mb-4">
                            <div class="card-body">    
        <label for="ejemplo">Municipio</label>
 
<div class="selector-pais ">
    
<datalist   id="municipio" name="cbx" >
     </datalist>
     <input autocomplete="off"  value="" onchange="filtrou()" id="lista" name="mun" list="municipio" class="form-control"  type="text">   
</div>      
  
    
        <label for="ejemplo">Localidad</label>
        <div class="selector_localidad">
        <datalist name="cbx_loc"   id="localidad"  >

</datalist>  
<input autocomplete="off"  value=""  id="lista_loc" name="loc" list="localidad" class="form-control"  type="text">   <br>
<button type="submit" onclick="imprimir()" class="btn btn-primary">Generar</button>

      </div>   
    </div>
    </div>
                           
              </form>              
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
                  $("#cuantos_disc").prop('disabled', true);
                  $("#cuantosa").prop('disabled', true);
    $("#parentesco").prop('disabled', true);
    $("#cuantosn").prop('disabled', true);
    $("#cuantosp").prop('disabled', true);

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
function imprimir()
{ 
  $.ajax({
        type: "GET",
                url:"imprimir_pintura" ,
                                 

                success: function(data) {
                       }
            });

}
</script>
@stop
