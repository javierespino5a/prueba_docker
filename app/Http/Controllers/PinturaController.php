<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\FpdfApoyo\FpdfApoyo as prueba;
use Codedge\Fpdf\Fpdf\Fpdf as pdf;
class PinturaController extends Controller
{
   //carga la tabla de alimentos
    public function index()
    {
        $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=2 ORDER BY ID_REGISTRO DESC limit 100');
           
        return view('pintura.tabla_pintura',$datos);   
     }
     public function reporte()
    {
        $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=2');
           
        return view('pintura.reporte_pintura',$datos);   
     }
     public function reporteimprimir(pdf $fpdf)
     {
      date_default_timezone_set('UTC');
        
      $pdf = new prueba('P','cm','Letter');
      $pdf->type_file = "nutre1";//.($solo_datos ? "2" : "1");
      $pdf->salto_pagina = 0.5;
      $pdf->celda_medio = 0.5;
      $pdf->salto_pie_pagina =1.5;
      $pdf->celda_alto = 0.5;
      $pdf->celda_ancho_max = 19.5;
  
      #Variables 
      $pdf->celda_num = 0.9; 
      $pdf->celda_nombre = 9;
      $pdf->celda_firma = 4;
      $pdf->celda_observaciones = 5.5;
  
      $pdf->SetMargins(1,0.5,0.5);
      $pdf->SetAutoPageBreak(true, $pdf->salto_pie_pagina);
      $pdf->AliasNbPages();
  
      $pdf->celda_alto_medio = $pdf->celda_alto / 2;
      $pdf->cols_3 = $pdf->celda_ancho_max / 3;
  
      
          $pdf->celda_nombre_generico = $pdf->celda_ancho_max - $pdf->celda_num - $pdf->celda_clave - $pdf->celda_presentacion - $pdf->celda_cantidad;//2*$pdf->celda_cantidad;
          //  $pdf->celda_nombre_generico = $pdf->celda_ancho_max - $pdf->celda_num - $pdf->celda_clave - $pdf->celda_presentacion - $pdf->celda_cantidad;//2*$pdf->celda_cantidad;
  
          $pdf->titulo = "ANEXO 3 FORMATO DE CONTROL DE ENTREGAS";
          $pdf->titulo2 = "PROGRAMA NUTRE YUCATÁN";
          $pdf->subtitulo = "(1 CARTON DE HUEVO Y 1 POLLO BENEFICIADO)";
          $pdf->dia = date("d");
          $pdf->mes = date("n");
          $pdf->anio = "2021";
          $pdf->municipio = $_GET["mun"];
          $pdf->localidad = $_GET["loc"];
         
      #Datos obtenidos        
      $datos['beneficiarios']=DB::select("SELECT NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO from tbl_registro where ID_PROGRAMA=2 and LOCALIDAD='".$_GET['loc']."'");
  
      $data = $datos['beneficiarios'];
  
      if(count($data) > 0){
      // if(false){
          $pdf->AddPage();
          $pdf->SetY(5.2);
       
          if(!empty($data) && count($data) > 0){
  
              $contador = 1;
              $Numero = 1;
              foreach($data as $dato){
                  $dato = (Array) $dato;
                  // dd($dato);
                  $firma = utf8_decode($dato["NOMBRES"]);
                  $observaciones = utf8_decode($dato["NOMBRES"]);
  
                  #Líneas total
                  $lineas_firma  = $pdf->NbLines($pdf->celda_firma,$firma);
                  // $lineas_contenido  = $pdf->NbLines($pdf->celda_observaciones,$observaciones);
                  $lineas_contenido  = $pdf->NbLines($pdf->celda_nombre,$observaciones);
                  $lineas = $lineas_firma > $lineas_contenido ? $lineas_firma : $lineas_contenido;
  
                  #Líneas del medicamento, líneas del detalle, Líneas de indicaciones, Líneas de la firma
                  $prueba = $pdf->celda_alto+0.5;
                  // $salto = $lineas * $pdf->celda_alto;
                  $salto = $lineas * $prueba;
  
                  $pdf->MultiCell("",$salto,"");
                  $x_ini = $pdf->GetX();
                  $y_ini = $pdf->GetY() - $salto;  
                  $y_ini_medio = $pdf->celda_alto/2;              
                  $pdf->SetXY($x_ini,$y_ini);
  
                  #Pintar celdas
                  $pdf->SetDrawColor(13,60,98);
                  $pdf->SetTextColor(13,60,98);
                  $pdf->Cell($pdf->celda_num,$salto,$Numero,1,0,"C");
                  $pdf->Cell($pdf->celda_nombre,$salto,strtoupper(utf8_decode($dato["NOMBRES"]." ".$dato["APELLIDO_PATERNO"]." ".$dato["APELLIDO_MATERNO"])),1);
                  $pdf->Cell($pdf->celda_firma,$salto,"",1);
                  $pdf->Cell($pdf->celda_observaciones,$salto,"",1);                
  
                  $pdf->Ln($salto);
                  $contador++;
                  $Numero++;
  
                  
                  if( $contador >= 19 ){
                      $pdf->AddPage();
                      $pdf->SetY(5.2);
                      $contador = 0;
                  }
              }            
          }
          
      }else{
          $pdf->AddPage();
          $pdf->Ln(2*$pdf->celda_alto);
          $pdf->SetFont("Arial","B",12);
          $pdf->SetY(6);
          $pdf->Cell("",$pdf->celda_alto,utf8_decode("NO SE OBTUVO INFORMACIÓN DE LOS BENEFICIARIOS."),0,0,"C");
      }
      $filename = "Aprobados_".date("dmY_His").".pdf";
  
      // $pdf->Output($filename,"I"); exit();
      $pdf->Output($filename,"D"); exit();
     }
     //carga la vista del formulario
     public function index_agregar()
    {
      return view ('pintura.pintura_captura');
     }
     //eliminar 
     public function eliminar()
     {
        $id=$_POST["id"];
        DB::table('cat_inventarios')->where('id', $id)->update(['ACTIVO' => 0]);
        echo json_encode($id);

     }
   //carga la vista de salida
     public function indexsalida()
     {
        $datos['proveedores']=DB::select('select * from cat_proveedor_inv');
        $datos['articulos']=DB::select('select * from cat_articulos_inv');
        $datos['almacenes']=DB::select('select * from cat_almacen_inv');
        $ubi['ubicaciones']=DB::connection('mysql')->select('select* from cat_ubicaciones ORDER BY UBICACION');
        return view('inventarios.salidainv',$datos);   
     }
     //carga vista del editar captura 
     public function indexeditar($id)
   {
      
      $ubi['usuarios']=DB::select('SELECT * FROM tbl_registro 
     WHERE ID_REGISTRO='.$id);
        
        return view('pintura.pintura_editar',$ubi);   
   }
   //metodo para agregar captura
public function agregar()
{
   $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=2 and FOLIO='.$_POST['folio']);
   if(empty($datos['usuarios']))
   {
   $adultos="";
   $ninios="";
   $disc="";
   $predio="";
if($_POST['predio']=="otro"){
$predio=$_POST['predion'];
} 
else{
$predio=$_POST['predio'];
}
if($_POST['adultos']=="SI"){$adultos=$_POST['numadultos'];}
date_default_timezone_set("America/Mexico_City");
echo "<script> $('#boton').prop('disabled', true); </script>";

$dia=date("d");
$mes=date("m");
$año=date("Y");
$hora=date("H").":".date("i").":".date("s");

$fecha_cap=$año."-".$mes."-".$dia." ".$hora;
   if($_POST['discapacidad']=="SI"){$disc=$_POST['cuantosdiscapacidad'];}
   DB::select("INSERT INTO tbl_registro (FECHA, MUNICIPIO, LOCALIDAD, NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO , SEXO, EDAD, TELEFONO, JEFE_DE_FAMILIA,
   CALLE,NUMERO, CRUZAMIENTO1, CRUZAMIENTO2, COLONIA, REFERENCIA_DOMICILIO, DISCAPACIDAD, NUM_DISCAPACITADOS,
    USO_PREDIO, TERCERA_EDAD, NUM_TERCERA, COMENTARIO, CURP, NOMBRE_SEGUNDO_CONTACTO, NUM_SEGUNDO_CONTACTO, DETERIORO_PINTURA, NUM_PISOS, MODALIDAD_PROGRAMA,
    ID_PROGRAMA, FOLIO, MAYA, MAYA_SEGUNDA_PERSONA, NOMBRE_DIR_DOM, FECHA_CAPTURA)
   VALUES ('".$_POST['fecha']."', '".$_POST['mun']."', '".$_POST['loc']."','".$_POST['nombres']."','".$_POST['apellidop']."','".$_POST['apellidom']."','".$_POST['sexo']."'
   ,'".$_POST['edad']."','".$_POST['telefono']."','".$_POST['jefe']."','".$_POST['calle']."','".$_POST['numero']."','".$_POST['cruzamiento1']."','".$_POST['cruzamiento2']."'
   ,'".$_POST['colonia']."','".$_POST['domicilio']."','".$_POST['discapacidad']."','".$disc."'
   ,'".$predio."','".$_POST['adultos']."','".$adultos."','".$_POST['comentarios']."'
   ,'".$_POST['curp']."','".$_POST['nombre_contacto2']."','".$_POST['telefono_dos']."','".$_POST['deterioro']."','".$_POST['pisos']."'
   ,'".$_POST['modalidad2']."','2','".$_POST['folio']."','".$_POST['maya']."','".$_POST['maya2']."','".$_POST['nombre_domicilio']."','".$fecha_cap."'
   )");
echo'<script type="text/javascript">
alert("Tarea Guardada");
window.location.href="/captura/public/captura_pintura";
</script>';
}
else{
   echo'<script type="text/javascript">
   alert("¡¡¡¡¡¡¡¡¡¡¡¡Folio existente!!!!!!!!!! \n No se guardaran los datos.");
   window.location.href="/captura/public/captura_alimento";
   </script>';
}
}
//metodo para agregar
public function editar()
{
   $adultos="";
   $disc="";
   $predio="";
if($_POST['predio']=="Otro"){
$predio=$_POST['predion'];
} 
else{
$predio=$_POST['predio'];
}
   
   if($_POST['adultos']=="SI"){$adultos=$_POST['numadultos'];}
   if($_POST['discapacidad']=="SI"){$disc=$_POST['cuantosdiscapacidad'];}
   DB::table('tbl_registro')->where('ID_REGISTRO', $_POST['id'])->update(['FOLIO' => $_POST['folio'] ,'FECHA'=>$_POST['fecha'],'MUNICIPIO'=>$_POST['mun'],
   'LOCALIDAD'=>$_POST['loc'], 'NOMBRES'=>$_POST['nombres'],'APELLIDO_PATERNO'=>$_POST['apellidop'],'APELLIDO_MATERNO'=>$_POST['apellidom'],
   'SEXO'=>$_POST['sexo'],'EDAD'=>$_POST['edad'],'TELEFONO'=>$_POST['telefono'],'CURP'=>$_POST['curp'],'JEFE_DE_FAMILIA'=>$_POST['jefe'],'CALLE'=>$_POST['calle'],
   'NUMERO'=>$_POST['numero'],'CRUZAMIENTO1'=>$_POST['cruzamiento1'],'CRUZAMIENTO2'=>$_POST['cruzamiento2'],'COLONIA'=>$_POST['colonia'], 'USO_PREDIO'=>$predio,
   'REFERENCIA_DOMICILIO'=>$_POST['domicilio'],
   'DISCAPACIDAD'=>$_POST['discapacidad'],'NUM_DISCAPACITADOS'=>$disc,'TERCERA_EDAD'=>$_POST['adultos'],
   'NUM_TERCERA'=>$adultos,'COMENTARIO'=>$_POST['comentarios'],'MAYA'=>$_POST['maya'], 'NOMBRE_SEGUNDO_CONTACTO'=>$_POST['nombre_contacto2'],
   'MAYA_SEGUNDA_PERSONA'=>$_POST['maya2'],'NUM_SEGUNDO_CONTACTO'=>$_POST['telefono2'],'DETERIORO_PINTURA'=>$_POST['deterioro'],
   'NUM_PISOS'=>$_POST['pisos'],'MODALIDAD_PROGRAMA'=>$_POST['modalidad2'],'NOMBRE_DIR_DOM'=>$_POST['nombre_domicilio']
   
   ]);
   $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=2');

   return view('pintura.tabla_pintura',$datos);   

}
public function exportar()
{
   $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=2');
           
   return view('pintura.exportar_excel',$datos); 
}
public function exportar_excel()
{
   $mun ="'%".$_POST["mun"]."%'";
   $loc = "'%".$_POST["loc"]."%'";
   $lib=DB::select('SELECT ID_REGISTRO,FOLIO,FECHA,FECHA_CAPTURA, NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO,MUNICIPIO,LOCALIDAD,CURP, CALLE, NUMERO, CRUZAMIENTO1, CRUZAMIENTO2, COLONIA, REFERENCIA_DOMICILIO,SEXO,EDAD,TELEFONO,JEFE_DE_FAMILIA,MAYA,NOMBRE_SEGUNDO_CONTACTO,NUM_SEGUNDO_CONTACTO,MAYA_SEGUNDA_PERSONA,NOMBRE_DIR_DOM,USO_PREDIO, DISCAPACIDAD, NUM_DISCAPACITADOS,TERCERA_EDAD,NUM_TERCERA,COMENTARIO,DETERIORO_PINTURA,NUM_PISOS,MODALIDAD_PROGRAMA  from tbl_registro where ID_PROGRAMA=2 AND MUNICIPIO LIKE '.$mun.' AND LOCALIDAD LIKE '.$loc.' ORDER BY ID_REGISTRO');
   $libros=array();

   $libros = json_decode(json_encode($lib), true);
  
   if(!empty($libros)) {
      $filename = "pintura.xls";
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=".$filename);
     
      $mostrar_columnas = false;
     
      foreach($libros as $libro) {
      if(!$mostrar_columnas) {
      echo implode("\t", array_keys($libro)) . "\n";
      $mostrar_columnas = true;
      }
      echo utf8_decode(implode("\t", array_values($libro)) . "\n");
      }
     
      }else{
      echo 'No hay datos a exportar';
      }
      exit;
}
    public function buscar()
    {
      $mun ="'%".$_POST["mun"]."%'";
      $loc = "'%".$_POST["loc"]."%'";
      $prog = "'".$_POST["prog"]."'";
      $nom = "'%".$_POST["nombre"]."%'";

      $datos['usuarios']=DB::connection('mysql')->select('SELECT * from tbl_registro where ID_PROGRAMA='.$prog.' and MUNICIPIO like '.$mun.' and LOCALIDAD LIKE '.$loc.' and CONCAT_WS(" ",NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO) LIKE '.$nom.'  ORDER BY ID_REGISTRO DESC limit 100');

      echo json_encode($datos['usuarios']);
    }
    public function buscar_folio()
    {
      $mun ="'".$_POST["mun"]."'";
      $loc = "'".$_POST["loc"]."'";
      $prog = "'".$_POST["prog"]."'";
$folio=$_POST["folio"];
      $datos['usuarios']=DB::connection('mysql')->select('SELECT * from tbl_registro where ID_PROGRAMA='.$prog.' and FOLIO='.$folio.' ');

      echo json_encode($datos['usuarios']);
    }
}
