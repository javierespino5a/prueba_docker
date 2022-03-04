<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GraficasController extends Controller
{
    //
    public function index(){
        $datos['usuarios']=DB::select('	SELECT ID_UBICACION,UBICACION,SUM(CALIFICACION_GLOBAL) AS puntos,FORMAT( (SUM(CALIFICACION_GLOBAL)*100)/SUM(CALIFICACION_MAX_GLOB),2) AS PORCENTAJE,  sedesol_cat.cat_usuarios.NOMBRE  AS supervisor
        FROM sedesol_proc.actividad_calificacion 
        INNER JOIN sedesol_cat.cat_ubicaciones
        ON sedesol_proc.actividad_calificacion.ID_UBICACION=sedesol_cat.cat_ubicaciones.ID
        INNER JOIN sedesol_cat.cat_usuarios
        ON sedesol_proc.actividad_calificacion.ID_SUPERVISOR=sedesol_cat.cat_usuarios.ID
        GROUP BY ID_UBICACION');
     
            return view ('catalogos.modulos',$datos);

    
    }
    public function modulos()
    {
        $datos['usuarios']=DB::select('	SELECT ID_UBICACION,UBICACION,SUM(CALIFICACION_GLOBAL) AS puntos,FORMAT( (SUM(CALIFICACION_GLOBAL)*100)/SUM(CALIFICACION_MAX_GLOB),2) AS PORCENTAJE,  sedesol_cat.cat_usuarios.NOMBRE  AS supervisor
        FROM sedesol_proc.actividad_calificacion 
        INNER JOIN sedesol_cat.cat_ubicaciones
        ON sedesol_proc.actividad_calificacion.ID_UBICACION=sedesol_cat.cat_ubicaciones.ID
        INNER JOIN sedesol_cat.cat_usuarios
        ON sedesol_proc.actividad_calificacion.ID_SUPERVISOR=sedesol_cat.cat_usuarios.ID
        GROUP BY ID_UBICACION');
     
     echo json_encode($datos['usuarios']);
    }
    public function visitas()
    {
        $datos['usuarios']=DB::select('	SELECT month(fecha) AS mes,COUNT(fecha) AS visitas,ID_PROGRAMA AS programa FROM tbl_registro
        GROUP BY MONTH(fecha), ID_PROGRAMA');
     
     echo json_encode($datos['usuarios']);
    }
}
