<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\FpdfApoyo\FpdfApoyo as prueba;
use Codedge\Fpdf\Fpdf\Fpdf as pdf;
use App\Helpers\SSP\SSP as SSP;
class AlimentosController extends Controller
{
   //carga la tabla de alimentos
    public function index()
    {
        $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=1 ORDER BY ID_REGISTRO DESC limit 100');
           
        return view('alimentos.tabla_alimentos',$datos);   
     }
     public function reporte()
     {
         $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=1');
            
         return view('alimentos.reporte_alimentos',$datos);   
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
       $pdf->celda_nombre = 10;
       $pdf->celda_firma = 4;
       $pdf->celda_observaciones = 5;
   
       $pdf->SetMargins(1,0.5,0.5);
       $pdf->SetAutoPageBreak(true, $pdf->salto_pie_pagina);
       $pdf->AliasNbPages();
   
       $pdf->celda_alto_medio = $pdf->celda_alto / 2;
       $pdf->cols_3 = $pdf->celda_ancho_max / 3;
   
       
           $pdf->celda_nombre_generico = $pdf->celda_ancho_max - $pdf->celda_num - $pdf->celda_clave - $pdf->celda_presentacion - $pdf->celda_cantidad;//2*$pdf->celda_cantidad;
           //  $pdf->celda_nombre_generico = $pdf->celda_ancho_max - $pdf->celda_num - $pdf->celda_clave - $pdf->celda_presentacion - $pdf->celda_cantidad;//2*$pdf->celda_cantidad;
   
           $pdf->titulo = "ANEXO 3 FORMATO DE CONTROL DE ENTREGAS";
           $pdf->titulo2 = "PROGRAMA DE SEGURIDAD ALIMENTARIA EN COMISARIAS Y ";
           $pdf->titulo3 = "ZONAS VULNERABLES";

           $pdf->subtitulo = "(1 CARTON DE HUEVO Y 1 POLLO BENEFICIADO)";
           $pdf->dia = date("d");
           $pdf->mes = date("n");
           $pdf->anio = "2021";
           $pdf->municipio = $_GET["mun"];
           $pdf->localidad = $_GET["loc"];
          
       #Datos obtenidos        
       $datos['beneficiarios']=DB::select("SELECT NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO from tbl_registro where ID_PROGRAMA=1 and LOCALIDAD='".$_GET['loc']."'");
   
       $data = $datos['beneficiarios'];
   
       if(count($data) > 0){
       // if(false){
          $pdf->AddFont('Panton-Regular','','Panton-Regular.php');
          $pdf->AddFont('Panton-Bold','','Panton-Bold.php');
          $pdf->AddFont('Panton-Black','','Panton-Black.php');

           $pdf->AddPage();
           $pdf->SetFont("Panton-Regular","",12);
           $pdf->SetY(5.7);
        
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
                   //$lineas = $lineas_firma > $lineas_contenido ? $lineas_firma : $lineas_contenido;
                  $lineas=$lineas_contenido;
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
   
                   
                   if( $contador >= 15 ){
                       $pdf->AddPage();
                       $pdf->SetY(5.7);
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
      return view ('alimentos.alimentos_captura');
     }
     //eliminar 
     public function eliminar()
     {
        $id=$_POST["id"];
        DB::table('tbl_registro')->where('ID_REGISTRO', '=', $id)->delete();

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
        
        return view('alimentos.alimentos_editar',$ubi);   
   }
   //metodo para agregar captura
public function agregar()
{
   $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=1 and FOLIO='.$_POST['folio']);
   if(empty($datos['usuarios']))
   {
      echo'<script type="text/javascript">
alert("Folio nuevo");
window.location.href="captura_alimento";
</script>';
date_default_timezone_set("America/Mexico_City");
$dia=date("d");
$mes=date("m");
$año=date("Y");
$hora=date("H").":".date("i").":".date("s");

$fecha_cap=$año."-".$mes."-".$dia." ".$hora;
   echo "<script> $('#boton').prop('disabled', true); </script>";
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
   if($_POST['ninios']=="SI")
   {
$ninios=$_POST['niniosn'];
   }
   if($_POST['adultos']=="SI"){$adultos=$_POST['numadultos'];}
   if($_POST['discapacidad']=="SI"){$disc=$_POST['cuantosdiscapacidad'];}
   $texto="algo";
   DB::select("INSERT INTO tbl_registro (FECHA, MUNICIPIO, LOCALIDAD, NOMBRES,APELLIDO_PATERNO ,APELLIDO_MATERNO , SEXO, EDAD, TELEFONO, JEFE_DE_FAMILIA,
   CALLE,NUMERO, CRUZAMIENTO1, CRUZAMIENTO2, COLONIA, REFERENCIA_DOMICILIO, DISCAPACIDAD, NUM_DISCAPACITADOS,
   MUJERES_PERIODO, HABITAN_NINIOS, NUM_NINIOS,USO_PREDIO, TERCERA_EDAD, NUM_TERCERA, COMENTARIO, CURP, FOLIO, ID_PROGRAMA, MAYA, FECHA_CAPTURA, ACEPTADO, MOTIVO_RECHAZO)
   VALUES ('".$_POST['fecha']."', '".$_POST['mun']."', '".$_POST['loc']."','".$_POST['nombres']."','".$_POST['apellidop']."','".$_POST['apellidom']."','".$_POST['sexo']."'
   ,'".$_POST['edad']."','".$_POST['telefono']."','".$_POST['jefe']."','".$_POST['calle']."','".$_POST['numero']."','".$_POST['cruzamiento1']."','".$_POST['cruzamiento2']."'
   ,'".$_POST['colonia']."','".$_POST['domicilio']."','".$_POST['discapacidad']."','".$disc."'
   ,'".$_POST['periodo']."','".$_POST['ninios']."','".$ninios."','".$predio."','".$_POST['adultos']."','".$adultos."','".$_POST['comentarios']."'
   ,'".$_POST['curp']."','".$_POST['folio']."','1','".$_POST['maya']."','".$fecha_cap."','".$_POST['aceptado']."'
   ,'".$_POST['motivo_rechazo']."'
   )");

echo'<script type="text/javascript">
alert("Tarea Guardada");
window.location.href="captura_alimento";
</script>';
   }
   else{
      echo'<script type="text/javascript">
      alert("¡¡¡¡¡¡¡¡¡¡¡¡Folio existente!!!!!!!!!! \n No se guardaran los datos.");
      window.location.href="captura_alimento";
      </script>';
   }
  /**/
   
}
//metodo para agregar
public function editar()
{
   $adultos="";
   $ninios="";
   $disc="";
   $predio="";
   $rechazo="";
   if($_POST['aceptado']=="NO")
   {
$rechazo=$_POST['motivo_rechazo'];
   }
if($_POST['predio']=="Otro"){
$predio=$_POST['predion'];
} 
else{
$predio=$_POST['predio'];
}
   if($_POST['ninios']=="SI")
   {
$ninios=$_POST['niniosn'];
   }
   if($_POST['adultos']=="SI"){$adultos=$_POST['numadultos'];}
   if($_POST['discapacidad']=="SI"){$disc=$_POST['cuantosdiscapacidad'];}
   DB::table('tbl_registro')->where('ID_REGISTRO', $_POST['id'])->update(['FOLIO' => $_POST['folio'] ,'FECHA'=>$_POST['fecha'],'MUNICIPIO'=>$_POST['mun'],
   'LOCALIDAD'=>$_POST['loc'], 'NOMBRES'=>$_POST['nombres'],'APELLIDO_PATERNO'=>$_POST['apellidop'],'APELLIDO_MATERNO'=>$_POST['apellidom'],
   'SEXO'=>$_POST['sexo'],'EDAD'=>$_POST['edad'],'TELEFONO'=>$_POST['telefono'],'CURP'=>$_POST['curp'],'JEFE_DE_FAMILIA'=>$_POST['jefe'],'CALLE'=>$_POST['calle'],
   'NUMERO'=>$_POST['numero'],'CRUZAMIENTO1'=>$_POST['cruzamiento1'],'CRUZAMIENTO2'=>$_POST['cruzamiento2'],'COLONIA'=>$_POST['colonia'], 'USO_PREDIO'=>$predio,
   'REFERENCIA_DOMICILIO'=>$_POST['domicilio'],'HABITAN_NINIOS'=>$_POST['ninios'],'NUM_NINIOS'=>$ninios,
   'DISCAPACIDAD'=>$_POST['discapacidad'],'NUM_DISCAPACITADOS'=>$disc,'MUJERES_PERIODO'=>$_POST['periodo'],'TERCERA_EDAD'=>$_POST['adultos'],
   'NUM_TERCERA'=>$adultos,'COMENTARIO'=>$_POST['comentarios'],'MAYA'=>$_POST['maya']
   ,'ACEPTADO'=>$_POST['aceptado'],'MOTIVO_RECHAZO'=>$rechazo
   
   ]);
   $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=1 ORDER BY ID_REGISTRO DESC limit 100');
           
   return view('alimentos.tabla_alimentos',$datos);   

}
public function exportar()
{
   $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA=2');
           
   return view('alimentos.exportar_excel',$datos); 
}
public function exportar_excel()
{
   $mun ="'%".$_POST["mun"]."%'";
      $loc = "'%".$_POST["loc"]."%'";
   $lib=DB::select('SELECT FECHA, FOLIO, ACEPTADO, MOTIVO_RECHAZO, MUNICIPIO, LOCALIDAD, NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO, SEXO, EDAD, TELEFONO, JEFE_DE_FAMILIA, MAYA, CURP, CALLE, NUMERO, CRUZAMIENTO1, CRUZAMIENTO2, COLONIA, REFERENCIA_DOMICILIO, USO_PREDIO, HABITAN_NINIOS, NUM_NINIOS, DISCAPACIDAD, NUM_DISCAPACITADOS, MUJERES_PERIODO, TERCERA_EDAD, NUM_TERCERA, COMENTARIO, FECHA_CAPTURA   from tbl_registro where ID_PROGRAMA=1 AND MUNICIPIO LIKE '.$mun.' AND LOCALIDAD LIKE '.$loc.' ORDER BY ID_REGISTRO');
   $libros=array();
   
   $libros = json_decode(json_encode($lib), true);
   if(!empty($libros)) {
      $filename = "Apoyo_Alimentario.xls";
      header('Content-type: application/vnd.ms-excel;');
      header('Content-Disposition: attachment; filename='.$filename);
     // header('Cache-Control: max-age=0');
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
   public function pag()
   {
      $mun ="'%".$_POST["mun"]."%'";
      $loc = "'%".$_POST["loc"]."%'";
      $prog = "'".$_POST["prog"]."'";
      $nom = "'%".$_POST["nombre"]."%'";

$primero=$_POST["primero"];
$ultimo=$_POST["ultimo"];
if($_POST["accion"]=="despues"){
   if($_POST["mun"]!="" && $_POST["loc"]!=""){
      $datos['usuarios']=DB::connection('mysql')->select('SELECT * from tbl_registro where ID_PROGRAMA='.$prog.' and ID_REGISTRO<'.$ultimo.' and MUNICIPIO like '.$mun.' and LOCALIDAD LIKE '.$loc.' ORDER BY ID_REGISTRO DESC limit 100');

   }
   $datos['usuarios']=DB::connection('mysql')->select('SELECT * from tbl_registro where ID_PROGRAMA='.$prog.' and ID_REGISTRO<'.$ultimo.' and CONCAT_WS(" ",NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO) LIKE '.$nom.' ORDER BY ID_REGISTRO DESC limit 100');

}
if($_POST["accion"]=="antes"){
   if($_POST["mun"]!="" && $_POST["loc"]!=""){
      $datos['usuarios']=DB::connection('mysql')->select('SELECT * from tbl_registro where ID_PROGRAMA='.$prog.' and ID_REGISTRO>'.$primero.' and MUNICIPIO like '.$mun.' and LOCALIDAD LIKE '.$loc.' ORDER BY ID_REGISTRO DESC limit 100');

   }
   $datos['usuarios']=DB::connection('mysql')->select('SELECT * from tbl_registro where ID_PROGRAMA='.$prog.' and ID_REGISTRO>'.$primero.' and CONCAT_WS(" ",NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO) LIKE '.$nom.' ORDER BY ID_REGISTRO DESC limit 100');

}
      //$datos['usuarios']=DB::connection('mysql')->select('SELECT * from tbl_registro where ID_PROGRAMA='.$prog.' and MUNICIPIO='.$mun.' and LOCALIDAD LIKE '.$loc.' ');

      echo json_encode($datos['usuarios']);
   } 
   public function repetidos()
   {
      $datos['usuarios']=DB::select('SELECT * from tbl_registro where ID_PROGRAMA='.$_POST['prog'].' and FOLIO='.$_POST['folio']);

      if(empty($datos['usuarios']))
      {  
         echo "bien";
      }
      else
      {
         echo json_encode($datos['usuarios']);

      }
   }
}
