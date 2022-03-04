<?php
namespace App\Helpers\FpdfApoyo;

use Codedge\Fpdf\Fpdf\Fpdf;
use PHPUnit\Framework\Exception;

class FpdfApoyo extends Fpdf {
    public $APP_PATH = '';
    public $type_file = 'mad';
    public $B = 0;
    public $I = 0;
    public $U = 0;
    public $HREF = '';
    public $angle_;
    public $cellspacing = 0;
    public $roundRadio = 0.06;
    public $ALIGN =  "left";

    # VARIABLES
        public $celda_ancho_max = 26.44;
        public $celda_alto = 0.7;
        public $celda_alto_doble;
        public $celda_medio = 0.5;
        public $tamanio_fuente = 8;
        public $salto_pie_pagina = 3.5;
        public $celda_alto_medio = 0;
        public $data_suscribe;
        public $celda_expediente = 4;
        public $celda_activo_pasivo = 2;
        public $data_folio = '';
        public $celda_folio;
        public $celda_alto_folio = 0.7;
        public $celda_pestaña = 8.1;
        public $celda_alto_pestaña = 2.3;

        public $celda_alto_4;
        public $celda_vertical = 0.7;
        public $celda_vertical_doble;
        public $celda_vertical_medio;
        public $celda_vertical_ajuste =  0.22;
        public $celda_vertical_ajuste_doble = 0.4;
        public $cols_3;

        public $titulo = "";
        public $titulo2 = "";
        public $subtitulo = "";
        public $data_ajuste;
        public $data_recepcion;
        public $data_salida;

        #CELDAS TABLAS
            public $celda_num = 0.5;
            public $celda_idexp = 3.4;
            public $celda_nombre = 2.4;
            public $celda_edad = 1.3;
            public $celda_dom_calle = 1.3;
            public $celda_dom_num = 1.2;
            public $celda_dom_colonia = 2.7;
            public $celda_prox_visita = 3.5;

        #Variables para medicamentos
        public $celda_clave = 2.1;
            public $celda_cantidad = 1.3;
            public $celda_presentacion = 7;
            public $celda_nombre_generico;

        #Variables Consultas
            public $anio_productividad;
            public $anio_consultas;
            public $meses = array("","ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
            public $meses_nom = array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
            public $celda_total = 1.6;
            public $celda_clues;
            public $celda_usuario;

            public $celda_dia = 0.78;
            public $celda_dias_total;
            public $celda_titulo;
            public $celda_descripcion;

            public $tamanio_fuente_detalle = 4;
            public $tipo_informacion;
            public $lineas_fila;
            public $tipo_header = "MES_DIAS";

            /**
             * Cabecera incidencias
             */
            public $celda_jur = 4.2;
            public $celda_fecha = 1.35;
            public $celda_incidencia = 5;

    #CODE 128
        protected $T128;                                         // Tableau des codes 128
        protected $ABCset = "";                                  // jeu des caractères éligibles au C128
        protected $Aset = "";                                    // Set A du jeu des caractères éligibles
        protected $Bset = "";                                    // Set B du jeu des caractères éligibles
        protected $Cset = "";                                    // Set C du jeu des caractères éligibles
        protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
        protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
        protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caractères de sélection de jeu au début du C128
        protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caractères de changement de jeu

    public function __constructor($orientation='P', $unit='mm', $size='Letter') {
        $this->APP_PATH = app_path();
        $this->B = 0;
        $this->I = 0;
        $this->U = 0;
        $this->HREF = '';
        parent::Fpdf($orientation, $unit, $size);

        #CODE 128
            $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caractères
            $this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
            $this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
            $this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
            $this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
            $this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
            $this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
            $this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
            $this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
            $this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
            $this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
            $this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
            $this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
            $this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
            $this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
            $this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
            $this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
            $this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
            $this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
            $this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
            $this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
            $this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
            $this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
            $this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
            $this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
            $this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
            $this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
            $this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
            $this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
            $this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
            $this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
            $this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
            $this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
            $this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
            $this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
            $this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
            $this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
            $this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
            $this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
            $this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
            $this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
            $this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
            $this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
            $this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
            $this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
            $this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
            $this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
            $this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
            $this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
            $this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
            $this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
            $this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
            $this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
            $this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
            $this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
            $this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
            $this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
            $this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
            $this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
            $this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
            $this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
            $this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
            $this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
            $this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
            $this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
            $this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
            $this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
            $this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
            $this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
            $this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
            $this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
            $this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
            $this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
            $this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
            $this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
            $this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
            $this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
            $this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
            $this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
            $this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
            $this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
            $this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
            $this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
            $this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
            $this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
            $this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
            $this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
            $this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
            $this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
            $this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
            $this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
            $this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
            $this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
            $this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
            $this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
            $this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
            $this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
            $this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
            $this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
            $this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
            $this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]
            $this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
            $this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
            $this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
            $this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
            $this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
            $this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
            $this->T128[] = array(2, 1);                       //107 : [END BAR]

            for ($i = 32; $i <= 95; $i++) {                                            // jeux de caractères
                $this->ABCset .= chr($i);
            }
            $this->Aset = $this->ABCset;
            $this->Bset = $this->ABCset;

            for ($i = 0; $i <= 31; $i++) {
                $this->ABCset .= chr($i);
                $this->Aset .= chr($i);
            }
            for ($i = 96; $i <= 127; $i++) {
                $this->ABCset .= chr($i);
                $this->Bset .= chr($i);
            }
            for ($i = 200; $i <= 210; $i++) {                                           // controle 128
                $this->ABCset .= chr($i);
                $this->Aset .= chr($i);
                $this->Bset .= chr($i);
            }
            $this->Cset="0123456789".chr(206);

            for ($i=0; $i<96; $i++) {                                                   // convertisseurs des jeux A & B
                @$this->SetFrom["A"] .= chr($i);
                @$this->SetFrom["B"] .= chr($i + 32);
                @$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
                @$this->SetTo["B"] .= chr($i);
            }
            for ($i=96; $i<107; $i++) {                                                 // contrôle des jeux A & B
                @$this->SetFrom["A"] .= chr($i + 104);
                @$this->SetFrom["B"] .= chr($i + 104);
                @$this->SetTo["A"] .= chr($i);
                @$this->SetTo["B"] .= chr($i);
            }
    }

    function Header() {
        if ($this->type_file){
            $y_header = $this->GetY();
            $dir = public_path()."/";

            $y = 1.5;
            switch($this->type_file){
                case "formato1": //Listado HOJA DIARIA
                    #LOGOS Y TITULO
                        $y = $this->GetY();
                        $x_ini = $this->GetX();
                        $this->Image($dir."images/logos/logo_mas_y_mejor_salud.jpg",0.8,0.3,9);
                        $x = $this->GetX();

                        $this->SetY($y);
                        $this->Image($dir."images/logos/logo_mad.jpg",($x + 20),0.3,4);

                        $this->SetY($y);
                        $this->Image($dir."images/logos/logo_yucatan.png",($x + 20 + 4.5),0.3,2);
                        $y += 1.3;

                        $this->SetFont("Arial","B",14);
                        $this->SetXY($x_ini, $y);
                        $this->Cell($this->celda_ancho_max,$this->celda_alto,"HOJA DIARIA DE PACIENTES",0,1,"C");
                        $y= $this->GetY();
                        $this->Line($x_ini, $y, $this->celda_ancho_max + 1.3, $y);
                        $y+= 0.3;
                    #BLOQUE DETALLES REPORTE
                        $this->SetXY($x_ini, $y);
                        $this->SetFont("Arial","B",8);
                        $this->Cell(2.3,$this->celda_medio,utf8_decode("JURISDICCIÓN:"),0,0,"L");
                        $this->SetFont("Arial","",8);
                        $this->RoundedBorderCell(1.3,$this->celda_medio,utf8_decode(@$this->data_header["JURISDICCION"]),0,"C");

                        $this->SetFont("Arial","B",8);
                        $this->Cell(2,$this->celda_medio,"BRIGADA:",0,0,"R");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(1.3,$this->celda_medio,utf8_decode(@$this->data_header["BRIGADA"]),0,"C");

                        $this->SetFont("Arial","B",8);
                        $this->Cell(2.2,$this->celda_medio,"MUNICIPIO:",0,0,"R");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(7.5,$this->celda_medio,utf8_decode(@$this->data_header["MUNICIPIO"]),0,"L");

                        $this->SetFont("Arial","B",8);
                        $this->Cell(2.2,$this->celda_medio,"LOCALIDAD:",0,0,"R");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(7.5,$this->celda_medio,utf8_decode(@$this->data_header["LOCALIDAD"]),0,"L");
                        $y += $this->celda_medio + 0.2;

                        $this->SetXY($x_ini, $y);
                        $this->SetFont("Arial","B",8);
                        $this->Cell(3.5,$this->celda_medio,utf8_decode("NOMBRE DEL MÉDICO:"),0,0,"L");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(16,$this->celda_medio,utf8_decode(@$this->data_header["MEDICO"]),0,"L");

                        $this->SetFont("Arial","B",8);
                        $this->Cell(2,$this->celda_medio,"FECHA:",0,0,"R");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(4.8,$this->celda_medio,utf8_decode(" ".str_replace("/"," / ",@$this->data_header["FECHA_REPORTE"])." "),0,"C");
                        $y += $this->celda_medio + 0.1;

                        $this->SetXY($x_ini, $y);
                        $this->SetFont("Arial","B",8);
                        $this->Cell(4.2,$this->celda_medio,utf8_decode("TIPO DE VULNERABILIDAD: 1:"),0,0,"L");
                        $this->SetFont("Arial","",9);
                        $this->Cell(3,$this->celda_medio,utf8_decode("ADULTO MAYOR"),0,0,"L");
                        $this->SetFont("Arial","B",8);
                        $this->Cell(0.2,$this->celda_medio,utf8_decode("2:"),0,0,"R");
                        $x = $this->GetX();
                        $this->SetFont("Arial","",9);
                        $this->SetX($x-0.2);
                        $this->Cell(2.6,$this->celda_medio,utf8_decode("EMBARAZADA"),0,0,"L");
                        $this->SetFont("Arial","B",8);
                        $this->Cell(0.2,$this->celda_medio,utf8_decode("3:"),0,0,"R");
                        $x = $this->GetX();
                        $this->SetFont("Arial","",9);
                        $this->SetX($x-0.2);
                        $this->Cell(5.2,$this->celda_medio,utf8_decode("PERSONA CON DISCAPACIDAD"),0,0,"L");
                        $this->SetFont("Arial","B",8);
                        $this->Cell(0.2,$this->celda_medio,utf8_decode("4:"),0,0,"R");
                        $x = $this->GetX();
                        $this->SetFont("Arial","",9);
                        $this->SetX($x-0.2);
                        $this->Cell(4,$this->celda_medio,utf8_decode("ENFERMO POSTRADO"),0,0,"L");
                        $y += $this->celda_medio + 0.1;

                    #Header tabla
                        $this->SetXY($x_ini,$y);
                        $x_ini = $this->GetX();
                        $y_ini = $this->GetY();
                        $alto = 0.4;
                        $alto_3 = $this->celda_medio + $this->celda_alto_doble;
                        $this->celda_vertical_ajuste = 0.3;
                        $this->SetFont("Arial","B",7);
                        #Numeración
                            $x = $x_ini;
                            $y = $y_ini;
                            $this->Cell($this->celda_vertical,$alto_3,"No.",1,0,'C');
                            $x += $this->celda_vertical;

                        #IDENTIFICACION
                            $this->SetXY($x,$y);
                            $w_iden = $this->celda_idexp + (3*$this->celda_nombre) + $this->celda_edad;
                            $this->Cell($w_iden,$this->celda_medio,utf8_decode("IDENTIFICACIÓN DE PACIENTES"),1,1,"C");
                            $y = $this->GetY();

                            #EXPEDIENTE
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_idexp,$this->celda_alto_doble,"",1,0,"C");
                                $cellspace = ($this->celda_alto_doble - ($alto*2))/2;
                                $this->SetXY($x,$y + $cellspace);
                                $this->Cell($this->celda_idexp,$alto,"ID",0,0,"C");
                                $this->SetXY($x,$y + $cellspace + $alto);
                                $this->Cell($this->celda_idexp,$alto,"EXPEDIENTE",0,0,"C");
                                $x += $this->celda_idexp;
                                //$ajuste_ = $this->celda_alto_doble - 0.3;

                            #Nombre
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_nombre,$this->celda_alto_doble,"",1,0,"C");
                                $cellspace = ($this->celda_alto_doble - $alto)/2;
                                $this->SetXY($x,$y + $cellspace);
                                $this->Cell($this->celda_nombre,$alto,"NOMBRE(S)",0,1,"C");
                                $x += $this->celda_nombre;

                            #Paterno
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_nombre,$this->celda_alto_doble,"",1,0,"C");
                                $cellspace = ($this->celda_alto_doble - ($alto*2))/2;
                                $this->SetXY($x,$y + $cellspace);
                                $this->Cell($this->celda_nombre,$alto,"APELLIDO",0,1,"C");
                                $this->SetXY($x,$y + $cellspace + $alto);
                                $this->Cell($this->celda_nombre,$alto,"PATERNO",0,1,"C");
                                $x += $this->celda_nombre;

                            #Materno
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_nombre,$this->celda_alto_doble,"",1,0,"C");
                                $cellspace = ($this->celda_alto_doble - ($alto*2))/2;
                                $this->SetXY($x,$y + $cellspace);
                                $this->Cell($this->celda_nombre,$alto,"APELLIDO",0,1,"C");
                                $this->SetXY($x,$y + $cellspace + $alto);
                                $this->Cell($this->celda_nombre,$alto,"MATERNO",0,1,"C");
                                $x += $this->celda_nombre;

                            #Edad
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_edad,$this->celda_alto_doble,"",1,0,"C");
                                $cellspace = ($this->celda_alto_doble - $alto)/2;
                                $this->SetXY($x,$y + $cellspace);
                                $this->Cell($this->celda_edad,$alto,"EDAD",0,1,"C");
                                $x += $this->celda_edad;

                        $y = $y_ini;
                        $ajuste_ = $alto_3 - 0.15;
                        $this->SetFont("Arial","B",6);
                        #VULNERABLE
                            $this->SetXY($x,$y);
                            $this->Cell($this->celda_vertical,$alto_3,"",1,0,'C');
                            $txt = $this->RotatedText($x+$this->celda_vertical_ajuste, $y+$ajuste_-0.25,utf8_decode("PACIENTE"),90);
                            $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                            $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                            $txt = $this->RotatedText($x+(2*$this->celda_vertical_ajuste), $y+$ajuste_,utf8_decode("VULNERABLE"),90);
                            $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                            $x += $this->celda_vertical;

                        #TIPO VULNEABLE
                            $this->SetXY($x,$y);
                            $this->Cell($this->celda_vertical,$alto_3,"",1,0,'C');
                            $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                            $txt = $this->RotatedText($x+$this->celda_vertical_ajuste, $y+$ajuste_-0.25,utf8_decode("TIPO DE"),90);
                            $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                            $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                            $txt = $this->RotatedText($x+(2*$this->celda_vertical_ajuste),$y+$alto_3,utf8_decode("VULNERABILIDAD"),90);
                            $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                            $x += $this->celda_vertical;

                        #VISITA
                            $this->SetXY($x,$y);
                            $this->Cell($this->celda_vertical,$alto_3,"",1,0,'C');
                            $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                            $txt = $this->RotatedText($x+$this->celda_vertical_ajuste, $y+$ajuste_,utf8_decode("NÚMERO DE"),90);
                            $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                            $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                            $txt = $this->RotatedText($x+(2*$this->celda_vertical_ajuste),$y+$ajuste_-0.25,utf8_decode("VISITA"),90);
                            $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                            $x += $this->celda_vertical;

                        #CHEQUERA SALUD
                            $this->SetXY($x,$y);
                            $this->Cell($this->celda_vertical,$alto_3,"",1,0,'C');
                            $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                            $txt = $this->RotatedText($x+$this->celda_vertical_ajuste, $y+$ajuste_,utf8_decode("CHEQUERA DE"),90);
                            $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                            $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                            $txt = $this->RotatedText($x+(2*$this->celda_vertical_ajuste),$y+$ajuste_-0.25,utf8_decode("LA SALUD"),90);
                            $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                            $x += $this->celda_vertical;

                        $this->SetFont("Arial","B",7);
                        #DOMICILIO
                            $this->SetX($x);
                            $w_dom = $this->celda_dom_calle + $this->celda_dom_num + $this->celda_dom_colonia;
                            $this->Cell($w_dom,$this->celda_medio,utf8_decode("DIRECCIÓN"),1,1,"C");
                            $y = $this->GetY();
                            #calle
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_dom_calle,$this->celda_alto_doble,"",1,0,"C");
                                $cellspace = ($this->celda_alto_doble - $alto)/2;
                                $this->SetXY($x,$y + $cellspace);
                                $this->Cell($this->celda_dom_calle,$alto,"CALLE",0,1,"C");
                                $x += $this->celda_dom_calle;

                            #num
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_dom_num,$this->celda_alto_doble,"",1,0,"C");
                                $cellspace = ($this->celda_alto_doble - $alto)/2;
                                $this->SetXY($x,$y + $cellspace);
                                $this->Cell($this->celda_dom_num,$alto,utf8_decode("NÚMERO"),0,1,"C");
                                $x += $this->celda_dom_num;

                            #colonia
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_dom_colonia,$this->celda_alto_doble,"",1,0,"C");
                                $cellspace = ($this->celda_alto_doble - $alto)/2;
                                $this->SetXY($x,$y + $cellspace);
                                $this->Cell($this->celda_dom_colonia,$alto,"COLONIA",0,1,"C");
                                $x += $this->celda_dom_colonia;

                        $this->SetFont("Arial","B",6);
                        #ESTATUS
                            $this->SetXY($x,$y_ini);
                            $this->MultiCell((3*$this->celda_vertical),$this->celda_medio/2,"ESTATUS DEL PACIENTE",1,"C");
                            $y = $this->GetY();
                            $ajuste_ = $this->celda_alto_doble - 0.15;

                            #Activo
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,"",1,0,'C');
                                $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                                $txt = $this->RotatedText($x+$this->celda_vertical_ajuste, $y+$ajuste_,utf8_decode("PACIENTE"),90);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                                $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                                $txt = $this->RotatedText($x+(2*$this->celda_vertical_ajuste),$y+$ajuste_-0.15,utf8_decode("ACTIVO"),90);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                                $x += $this->celda_vertical;

                            #BAJA MATERNIDAD
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,"",1,0,'C');
                                $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                                $txt = $this->RotatedText($x+$this->celda_vertical_ajuste, $y+$ajuste_,utf8_decode("BAJA POR"),90);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                                $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                                $txt = $this->RotatedText($x+(2*$this->celda_vertical_ajuste),$y+$this->celda_alto_doble,utf8_decode("MATERNIDAD"),90);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                                $x += $this->celda_vertical;

                            #BAJA DEFUNCION
                                $this->SetXY($x,$y);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,"",1,0,'C');
                                $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                                $txt = $this->RotatedText($x+$this->celda_vertical_ajuste, $y+$ajuste_,utf8_decode("BAJA POR"),90);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                                $this->SetXY($x+$this->celda_vertical_ajuste, $y);
                                $txt = $this->RotatedText($x+(2*$this->celda_vertical_ajuste),$y+$this->celda_alto_doble,utf8_decode("DEFUNCIÓN"),90);
                                $this->Cell($this->celda_vertical,$this->celda_alto_doble,$txt,0);
                                $x += $this->celda_vertical;

                        $this->SetFont("Arial","B",7);
                        #PROXIMA VISITA
                            $this->SetXY($x,$y_ini);
                            $this->Cell($this->celda_prox_visita,$alto_3,"",1,1,"C");
                            $cellspace = ($alto_3 - (3*$alto))/2;
                            $this->SetXY($x, $y_ini + $cellspace);
                            $this->Cell($this->celda_prox_visita,$alto,"FECHA APROXIMADA",0,1,"C");
                            $this->SetXY($x, $y_ini + $cellspace + $alto);
                            $this->Cell($this->celda_prox_visita,$alto,"DE LA SIGUIENTE",0,1,"C");
                            $this->SetXY($x, $y_ini + $cellspace + ($alto*2));
                            $this->Cell($this->celda_prox_visita,$alto,"VISITA",0,1,"C");
                            $y_ini += $alto_3;

                    $this->SetY($y_ini);
                    //fin header
                    break;
                /** CONCENTRADO CONSULTAS */
               
                /** ENCABEZADO PORTRAIT NUTRE */               
                case "nutre1":
                    $bloque_ts=20;//ancho portrait
                    $y = $this->GetY();
                    $this->celda_folio = 5.8;
                    $this->Image($dir."assets/images/logos/logo_gobierno_dif.jpg",0.8,0.5,7);
                    $x = $this->GetX();
                    $y2 = $this->GetY();

                    $this->SetXY(($x + 6.3), ($y + 1.6));
                    $yh = $y + 1.7;
                    // $this->SetTextColor(0,40,130);
                    $this->SetTextColor(13,60,98);
                    $this->SetDrawColor(13,60,98);
                    if($this->titulo){
                        $this->SetFont("Panton-Black","",15);
                        $this->Cell($this->celda_folio,$this->celda_alto,utf8_decode($this->titulo),0,1,"C");
                        $yh += $this->celda_alto;
                        $this->SetXY(($x + 6.3), $yh);
                    }
                    if($this->titulo2){
                        $this->SetFont("Panton-Black","",15);
                        $this->Cell($this->celda_folio,$this->celda_alto,utf8_decode($this->titulo2),0,1,"C");
                        $yh += $this->celda_alto;
                        $this->SetXY(($x + 6.3), $yh);
                    }
                    if($this->titulo3){
                        $this->SetFont("Panton-Black","",15);
                        $this->Cell($this->celda_folio,$this->celda_alto,utf8_decode($this->titulo3),0,1,"C");
                        $yh += $this->celda_alto;
                        $this->SetXY(($x + 6.3), $yh);
                    }
                    if($this->subtitulo){
                        $this->SetFont("Panton-Black","",12);
                        $this->Cell($this->celda_folio,$this->celda_alto,utf8_decode($this->subtitulo),0,1,"C");
                        $yh += $this->celda_alto;
                        $this->SetXY(($x + 8.3), $yh);
                    }

                    $this->Line(0.9, $yh, $bloque_ts + 0.4, $yh);
                    // fechas 
                    // $this->Cell($this->cols_3,$this->celda_alto,utf8_decode("DIA: ").utf8_decode($this->dia));

                    // $this->SetXY($x_ini, $y);
                    
                    $y = $this->GetY();
                    $this->SetY($y+ 0.3);
                        
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(0.6,$this->celda_medio,utf8_decode($this->dia),0,"C");

                        $this->SetFont("Arial","B",8);
                        $this->Cell(1.9,$this->celda_medio,utf8_decode("DEL MES DE"),0,0,"C");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(2.2,$this->celda_medio,utf8_decode($this->meses_nom[intval($this->mes)]),0,"C");

                        $this->SetFont("Arial","B",8);
                        $this->Cell(1.4,$this->celda_medio,utf8_decode("DEL AÑO"),0,0,"C");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(1,$this->celda_medio,utf8_decode($this->anio),0,"C");

                        $this->SetFont("Arial","B",8);
                        $this->Cell(1.9,$this->celda_medio,utf8_decode("MUNICIPIO:"),0,0,"C");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(3.5,$this->celda_medio,utf8_decode($this->municipio),0,"C");

                        $this->SetFont("Arial","B",8);
                        $this->Cell(2,$this->celda_medio,utf8_decode("LOCALIDAD:"),0,0,"C");
                        $this->SetFont("Arial","",10);
                        $this->RoundedBorderCell(4.8,$this->celda_medio,utf8_decode($this->localidad),0,"C");


                        $this->SetDrawColor(13,60,98);
                        $this->SetTextColor(255,255,255);
                        $this->SetFillColor(13,60,98);
                        $this->SetFont("Arial","B",6);
                        $y = $this->GetY();
                        $this->SetY($y+ $this->celda_alto + .2);
                        $this->RoundedBorderCell(0.9,$this->celda_alto,"No.",0,"C",true,"",1);
                        $this->Cell(10,$this->celda_alto,"NOMBRE COMPLETO DEL BENEFICIARIO",1,0,'C',true);
                        $this->Cell(4,$this->celda_alto,"HUELLA O FIRMA DEL BENEFICIARIO",1,0,'C',true);                       
                        $this->RoundedBorderCell(5,$this->celda_alto,"OBSERVACIONES",0,"C",true,"",2);

                    $this->SetTextColor(0,0,0);
                    $this->SetFont("Arial","",10);
                    if(!empty($this->data_folio))
                        $this->Cell($this->celda_folio,$this->celda_alto,utf8_decode((!empty($this->data_folio) ? $this->data_folio : "")),0,1,"C");

                    // $this->SetY($y);
                    // $this->Image($dir."images/logos/logo_mad.jpg",($x + 9.3 + $this->celda_folio),0.5,3);


                    $this->SetY($y);
                    $this->Image($dir."assets/images/logos/logo_yucatan.png",($x + 12.8 + $this->celda_folio),0.4,1.5);



                    if(!empty($this->data_ajuste)){
                        $this->SetY($yh);

                        #Información de la unidad
                        $this->Ln($this->celda_alto);
                        $this->SetFont("Arial","B",8);
                        $this->Cell($this->celda_ancho_max,$this->celda_alto,"Datos de ajuste",1,1);
                        $this->SetFont("Arial","",8);
                        $this->Cell($this->celda_ancho_max,2*$this->celda_alto,"",1,0);

                        $this->SetX($x);
                        $this->Cell(2*$this->cols_3,$this->celda_alto,"USUARIO: ".utf8_decode($this->data_ajuste["USUARIO"]));
                        $this->Cell($this->cols_3,$this->celda_alto,"FECHA Y HORA: ".$this->data_ajuste["FECHA_DMY"]." ".$this->data_ajuste["HORA"],0,1,"C");
                        $this->Cell($this->celda_ancho_max,$this->celda_alto,utf8_decode("MÓDULO: ".$this->data_ajuste["NOMBRE_UNIDAD_CREACION"]),0,1);
                        $this->Ln($this->celda_alto_medio);

                        $this->header_medicamentos();
                    }
                    if(!empty($this->data_recepcion)){
                        #AQUI VA EL QR DEL FOLIO DE ENTRADA
                            $folio_w = 5;
                            $folio_h = 1.25;
                            $folio_x_ajuste = 0.75;
                            $folio_x = $this->celda_ancho_max - $folio_w + $folio_x_ajuste;
                            $folio_y = 0.75;
                            /* $this->Code128($folio_x,$folio_y,$this->data_recepcion["FOLIO"],$folio_w,$folio_h);
                            $this->SetXY($folio_x, $folio_y + 0.2);
                            $this->Cell($folio_w,$this->celda_alto,$this->data_recepcion["FOLIO"],0,1,"C"); */

                        $this->SetXY($x, $yh + 1.5);

                        #Información de la unidad
                        $this->MultiCell($this->celda_ancho_max,$this->celda_alto,"UNIDAD: ".utf8_decode($this->data_recepcion["NOMBRE_UNIDAD"]));
                        $this->MultiCell($this->celda_ancho_max,$this->celda_alto,"RECEPTOR: ".utf8_decode($this->data_recepcion["USUARIO"]));

                        #Información de la recepción
                        $this->Cell($this->cols_3,$this->celda_alto,"FECHA Y HORA: ".$this->data_recepcion["FECHA_DMY"]." ".$this->data_recepcion["HORA"]);
                        $this->Cell($this->cols_3,$this->celda_alto,"FOLIO COMPROBANTE: ".$this->data_recepcion["FOLIO_COMPROBANTE"],0,1);
                        $this->SetXY($x, ($yh + 1.5 + 3*$this->celda_alto));
                        $this->Cell($folio_w,$this->celda_alto, "FOLIO: ".$this->data_recepcion["FOLIO"],0,1);
                        $this->Ln($this->celda_alto_medio);

                        $this->header_medicamentos_entrada();
                    }
                    if(!empty($this->data_salida)){
                        $this->SetY($yh + 0.5);

                        #Información de la unidad
                        $this->Cell($this->cols_3,$this->celda_alto,utf8_decode("ENTREGA: ").utf8_decode($this->data_salida["JURISDICCION"]));
                        if($this->data_salida["ID_MOTIVO_SALIDA"] == 7)
                            $this->Cell(2*$this->cols_3,$this->celda_alto,utf8_decode("BRIGADA ENTREGA: ").utf8_decode($this->data_salida["BRIGADA"]),0,1);
                        else
                            $this->Cell(2*$this->cols_3,$this->celda_alto,"",0,1);

                        $this->Cell($this->cols_3,$this->celda_alto,utf8_decode("RECEPTOR: ").utf8_decode(@$this->data_salida["JURISDICCION_RECEPCION"]));
                        if($this->data_salida["ID_MOTIVO_SALIDA"] == 7)
                            $this->Cell(2*$this->cols_3,$this->celda_alto,utf8_decode("BRIGADA RECEPTOR: ").utf8_decode($this->data_salida["BRIGADA_RECEPCION"]),0,1);
                        else
                            $this->Cell(2*$this->cols_3,$this->celda_alto,"",0,1);

                        #Información de la salida
                        $this->Cell($this->cols_3,$this->celda_alto,"FECHA Y HORA: ".$this->data_salida["FECHA_DMY"]." ".$this->data_salida["HORA"]);
                        $this->Cell(2*$this->cols_3,$this->celda_alto,"MOTIVO DE SALIDA: ".utf8_decode($this->data_salida["MOTIVO_SALIDA"]),0,1);
                        $this->Ln($this->celda_alto_medio);

                        $this->header_medicamentos_salida();
                    }
                    break;
                default:
                    $this->Image($dir."assets/images/logos/logo_mas_y_mejor_salud.jpg",1,0.3,9);

                    $this->Image($dir."assets/images/logos/logo_mad.jpg",12.5,0.3,4);

                    $this->Image($dir."assets/images/logos/logo_yucatan.png",16.5,0.3,2);

                    $this->SetFont('Arial', '', 11);
                    $this->setY($y_header + $y);
                    $this->Cell(0, $this->celda_alto, utf8_decode('MÉDICO A DOMICILIO'), 0, 1, 'C');
                    $this->Ln($this->celda_alto);
                    break;
            }
        }
    }

    function Footer(){
        $this->SetY(-$this->salto_pie_pagina);
        $dir = public_path()."/";

        if ($this->type_file){
            switch ($this->type_file){
                case "formato1": //Listado HOJA DIARIA
                    $y = 20.5;
                    $x = $this->GetX();
                    $this->SetXY($x, $y);
                    $this->SetFont("Arial","",5.3);

                    #AVISO DE PRIVACIDAD
                        $texto = "Este programa es público, ajeno a cualquier partido político. ".
                            "Queda prohibido el uso para ﬁnes distintos a los establecidos en el programa. ".
                            "Dudas o quejas al teléfono 930 31 70 ext 11004 o a la Subsecretaría del Bienestar de la Secretaría de ".
                            "Desarrollo Social ubicada en C. 64 núm. 518 x 65 y 67 Col. Centro, Mérida, Yucatán, México. ".
                            "Los datos personales aquí recabados serán utilizados para el Programa Médico a Domicilio, no se realizarán ".
                            "transferencias de los mismos. ";
                        $this->MultiCell(0,0.2,utf8_decode($texto),0,"C");
                        $y = $this->GetY();
                        $this->Cell(0,0.2,utf8_decode("Consulte el aviso de privacidad integral a través de www.social.yucatan.gob.mx"),0,0,"C");

                    #paginación
                        $this->SetX($x);
                        $this->Cell(4,0.2,utf8_decode("Fecha y hora de impresión: ".date("d/m/Y H:i")),0);
                        $this->SetX(24);
                        $this->Cell(3.3,0.2,utf8_decode("Página ").$this->PageNo()."/{nb}",0,0,"R");
                    break;
                default: //PORTRAIT - atencion mad
                    //$this->SetY($this->salto_pie_pagina);
                    $h = $this->GetPageHeight();
                    $y = $h > 27 ? 24.5 : 20.5;
                    $x = $this->GetX();
                    $this->SetXY($x, $y);
                    
                    $this->SetTextColor(13,60,98);  
                    $firma= "NOMBRE, CARGO Y FIRMA DEL RESPONSABLE DE LA ENTREGA";
                    $parrafo1 = "Este programa es público, no es patrocinado ni promovido por partido politico alguno y sus recursos provienen".
                        " de las contribuciones que pagan todos los tributantes. Esta prohibido el".
                        "el uso de este programa con fines politicos, electorales, de lucro y otros distintos a los establecidos. ".
                        "Quien haga uso indebido de los recursos de este programa será denunciado y sancionado de acuerdo con".
                        " la ley aplicable y ante la autoridad competente";                        
                        
                    $parrafo2 = "Los datos personales aquí recabados serán utilizados para el Programa tal y tal, no se realizarán ".
                    "transferencias de los mismos. ".
                    "Para solicitar información respecto de las opciones  que tiene para denunciar conductas o hechos que contravengan ".
                    "las disposiciones de este programa puede comunicarse al tel. 930 3800 ext. 13047 o acudir a la siguiente dirección:".
                    "Calle 20 A núm 284 B x 3 C. Xcumpich, Piso 1 y 2, C.P. 97204, Mérida, Yucatán";                    
                    // $this->SetLineWidth(0.1);
                    $this->Line(6, $y, 16, $y);
                    $y = $this->GetY();
                    $this->SetXY($x, $y+ 0.2);
                    $this->SetFont("Arial","B",8);
                    $this->Cell(0,0.3,utf8_decode($firma),0,1,"C");

                    $y = $this->GetY();
                    $this->SetXY($x, $y+ 0.2);
                    $this->SetFont("Arial","",7);
                    $this->MultiCell(0,0.3,utf8_decode($parrafo1),0,"C");

                    $y = $this->GetY();
                    $this->SetXY($x, $y+ 0.1);
                    $this->MultiCell(0,0.3,utf8_decode($parrafo2),0,"C");

                    $y = $this->GetY();
                    $this->SetXY($x, $y+ 0.1);
                    $this->Cell(0,0.3,utf8_decode("Este programa es de apoyos y subsidios por parte del Gobierno del Estado por lo que no Generará relación laboral alguna con los beneficiarios"),0,0,"C");
                    // $this->Cell(0,0.3,utf8_decode("Consulte el aviso de privacidad integral a través de www.social.yucatan.gob.mx"),0,0,"C");
                    break;
            }

        }
    }

    #Títulos de Medicamentos AJUSTE
    function header_medicamentos(){
        $this->SetFont("Arial","B",7);
        $x = $this->GetX();
        $x += $this->celda_num + $this->celda_clave + $this->celda_nombre_generico + $this->celda_presentacion;
        $this->SetX($x);

        $celda_ = 2*$this->celda_cantidad;
        $this->Cell($celda_,$this->celda_alto,"EXISTENCIA",1,0,"C");
        $this->Cell($this->celda_cantidad,$this->celda_alto,"AJUSTE",1,1,"C"); //$this->Cell($celda_,$this->celda_alto,"AJUSTE",1,1,"C");

        $this->Cell($this->celda_num,$this->celda_alto,"#",1,0);
        $this->Cell($this->celda_clave,$this->celda_alto,"CLAVE",1,0,"C");
        $this->Cell($this->celda_nombre_generico,$this->celda_alto,utf8_decode("Nombre genérico"),1);
        $this->Cell($this->celda_presentacion,$this->celda_alto,utf8_decode("Presentación"),1,0,"C");
        $this->Cell($this->celda_cantidad,$this->celda_alto,"Cantidad",1,0,"C");
        $this->Cell($this->celda_cantidad,$this->celda_alto,"Piezas",1,0,"C");
        $this->Cell($this->celda_cantidad,$this->celda_alto,"Cantidad",1,1,"C"); //,1,0,"C");
        //$this->Cell($this->celda_cantidad,$this->celda_alto,"Piezas",1,1,"C");
        $this->SetFont("Arial","",7);
    }

    #Títulos de Medicamentos ENTRADA
    function header_medicamentos_entrada(){
        $this->SetFont("Arial","B",8);
        $this->Cell($this->celda_num,$this->celda_alto,"#",1,0);
        $this->Cell($this->celda_clave,$this->celda_alto,"CLAVE",1,0,"C");
        $this->Cell($this->celda_nombre_generico,$this->celda_alto,utf8_decode("NOMBRE GENÉRICO"),1);
        $this->Cell($this->celda_presentacion,$this->celda_alto,utf8_decode("PRESENTACIÓN"),1,0,"C");
        $this->Cell($this->celda_cantidad,$this->celda_alto,"CANTIDAD",1,1,"C"); //,1,0,"C");
        //$this->Cell($this->celda_cantidad,$this->celda_alto,"PIEZAS",1,1,"C");
        $this->SetFont("Arial","",8);
    }

    #Títulos de Medicamentos SALIDA
    function header_medicamentos_salida(){
        $this->SetFont("Arial","B",8);
        $this->Cell($this->celda_num,$this->celda_alto,"#",1,0);
        $this->Cell($this->celda_clave,$this->celda_alto,"CLAVE",1,0,"C");
        $this->Cell($this->celda_nombre_generico,$this->celda_alto,utf8_decode("NOMBRE GENÉRICO"),1);
        $this->Cell($this->celda_presentacion,$this->celda_alto,utf8_decode("PRESENTACIÓN"),1,0,"C");
        $this->Cell($this->celda_cantidad,$this->celda_alto,"CANTIDAD",1,1,"C"); //,1,0,"C");
        //$this->Cell($this->celda_cantidad,$this->celda_alto,"PIEZAS",1,1,"C");
        $this->SetFont("Arial","",8);
    }

    #Títulos - PACIENTS EXTRANJEROS
    function header_tabla(){
        $this->SetFillColor(240,240,240);
        $this->SetFont("Arial","B",7);
        $x = $this->GetX();
        $x += $this->celda_num + $this->celda_descripcion;
        $this->SetX($x);

        $celda_ = 2*$this->celda_total;
        foreach(array("Local","Foráneo","Extranjero","No especificado","TOTAL") as $caso)
            $this->Cell($celda_,$this->celda_alto,utf8_decode($caso),1,0,"C",1);
        $this->Ln($this->celda_alto);

        if(!empty($this->titulo_tabla)){
            $this->Cell($this->celda_num,$this->celda_alto,"#",1,0,"L",1);
            $this->Cell($this->celda_descripcion,$this->celda_alto,utf8_decode($this->titulo_tabla),1,0,"L",1);
        }else
            $this->Cell($this->celda_num + $this->celda_descripcion,$this->celda_alto,"",0,0,1);

        for($i=0;$i<5;$i++)
            foreach(array("Consultas","Pacientes") as $caso)
                $this->Cell($this->celda_total,$this->celda_alto,$caso,1,0,"C",1);
        $this->Ln($this->celda_alto);

        $this->SetFillColor(0,0,0);
        $this->SetFont("Arial","",$this->tamanio_fuente);
    }

    /**
     *
     */
    function llenar_fila(
        $descripcion,
        $datos,
        $color       = 0,
        $orientacion = "L",
        $iteracion   = null,
        #$clave       = null,
        $columnas_descriptivas_negritas = true) {
        //CALCULAR SALTO
        $lineas_descripcion    = $this->NbLines($this->celda_titulo,$descripcion);

        $lineas = max(array($this->lineas_fila,$lineas_descripcion));
        $alto   = $lineas*$this->celda_alto;

        $this->MultiCell($this->celda_ancho_max,$alto,"");

        $x = $this->GetX();
        $y = $this->GetY()-$alto;

        $this->SetY($y);

        #CONSULTAS
        #if($clave === null || $clave === null)
        #    $this->SetFillColor(220,220,220);
        #else
            $this->SetFillColor(240,240,240);
        $this->SetTextColor(0,0,0);
        $this->SetFont("Arial", $columnas_descriptivas_negritas ? "B" : "",$this->tamanio_fuente);

        //Pintar celda
        $this->Cell($this->celda_titulo,$alto,"",1,0,$orientacion,$color);
        $this->setX($x);

        /**
         * Pintar datos.
         */
        // Una sola columna de descripción.
        if($iteracion === null){ #&& $clave === null){
            $this->MultiCell($this->celda_titulo,$this->celda_alto,$descripcion,0,$orientacion);
            $x += $this->celda_titulo;
        }else{
            $this->Cell($this->celda_num,$alto,"",1,0,$orientacion,$color);
            #$this->Cell($this->celda_clave,$alto,"",1,0,$orientacion,$color);
            $this->Cell($this->celda_descripcion,$alto,"",1,0,$orientacion,$color);
            $this->setX($x);

            $this->Cell($this->celda_num,$this->celda_alto,$iteracion,0,0,$orientacion,$color);
            #$this->Cell($this->celda_clave,$this->celda_alto,$clave,0,0,$orientacion,$color);
            $this->MultiCell($this->celda_descripcion,$this->celda_alto,$descripcion,0,$orientacion,$color);

            $x += $this->celda_num + $this->celda_descripcion; #$this->celda_clave +
        }

        $this->SetXY($x,$y);
        $this->SetFont("Arial","",$this->tamanio_fuente);

        //Pintar celdas
        $dias_mes = $this->data_header["DIAS_MES"];
        for($i=1;$i<=$dias_mes;$i++)
            $this->Cell($this->celda_dia,$alto,"",1,0,"R",$color);

        $this->Cell($this->celda_total,$alto,"",1,0,"R",1);
        $this->SetX($x);

        // Pintar datos.
        for($i = 1; $i <= $dias_mes; $i++)
            $this->Cell($this->celda_dia,$this->celda_alto,$datos["CONSULTAS"][$i],0,0,"R");

        $this->Cell($this->celda_total,$this->celda_alto,$datos["CONSULTAS"]["TOTAL"],0,0,"R");
        $this->Ln($alto);

        // Salto final.
        $this->SetY($y+$alto);
    }

    /**
     *
     */
    function llenar_fila_doble($params)
    {
        $color       = isset($params["COLOR"]) ? $params["COLOR"] : 0;
        $orientacion = isset($params["ORIENTACION"]) ? $params["ORIENTACION"] : "L";
        $bold        = isset($params["BOLD"]) ? $params["BOLD"] : "";

        if($params["TIPO"] == "datos"){
            $this->llenar_fila(
                $params["DESCRIPCION"],
                $params["DATOS"],
                $color,
                $orientacion,
                $params["NUM"],
                #$params["CLAVE"],
                !empty($bold)
            );
        }else{
            $this->SetFillColor(240,240,240);
            $this->SetTextColor(0,0,0);
            $this->SetFont("Arial",$bold,$this->tamanio_fuente);

            //TÍTULO
            $this->Cell($this->celda_num,$this->celda_alto,$params["NUM"],1,0,$orientacion,$color);
            #$this->Cell($this->celda_clave,$this->celda_alto,$params["CLAVE"],1,0,$orientacion,$color);
            $this->Cell($this->celda_descripcion,$this->celda_alto,$params["DESCRIPCION"],1,0,$orientacion,$color);
            $this->Cell($this->celda_dias_total,$this->celda_alto,"",1,1,$orientacion,$color);
        }

        $this->SetFont("Arial","",$this->tamanio_fuente);
    }

    /**
     * Llena FILA PARA PACIENTES EXTRANJEROS
     */
    function llenar_fila_pacientes($descripcion, $datos, $color = 0, $orientacion = "L", $numeracion = null, $negritas = ""){
        #CALCULAR SALTO

            $lineas = $this->NbLines($this->celda_descripcion,$descripcion);
            $alto = $lineas*$this->celda_alto;

            $this->MultiCell($this->celda_ancho_max,$alto,"");

            $x = $this->GetX();
            $y = $this->GetY()-$alto;

            $this->SetY($y);

            #CONSULTAS
            $this->SetFillColor(240,240,240);
            $this->SetTextColor(0,0,0);
            $this->SetFont("Arial",$negritas,$this->tamanio_fuente);

            #Pintar celda
            $this->Cell($this->celda_num_descripcion,$alto,"",1,0,$orientacion,$color);
            $this->setX($x);

        #DATOS

            #Una sola columna de descripción.
            if($numeracion === null){
                $this->MultiCell($this->celda_num_descripcion,$this->celda_alto,$descripcion,0,$orientacion);
                $x += $this->celda_num_descripcion;
            }else{
                $this->Cell($this->celda_num,$alto,"",1,0,$orientacion,$color);
                $this->Cell($this->celda_descripcion,$alto,"",1,0,$orientacion,$color);
                $this->setX($x);

                $this->Cell($this->celda_num,$this->celda_alto,$numeracion,0,0,$orientacion,$color);
                $this->MultiCell($this->celda_descripcion,$this->celda_alto,$descripcion,0,$orientacion,$color);

                $x += $this->celda_num_descripcion;
            }

            $this->SetXY($x,$y);
            $this->SetFont("Arial",$negritas,$this->tamanio_fuente);

            #Pintar celdas
            foreach($datos as $data_caso)
                foreach($data_caso as $data_total)
                    $this->Cell($this->celda_total,$alto,"",1,0,"R",$color);
            $this->SetX($x);

            #Pintar datos.
            foreach($datos as $data_caso)
                foreach($data_caso as $data_total)
                    $this->Cell($this->celda_total,$this->celda_alto,$data_total,0,0,"R");
            $this->Ln($alto);

        #Salto final
        $this->SetY($y+$alto);
    }

    /**
     * FUNCIONES PARA DISEÑO PDF
     */
    function NbLines($w,$txt) {
        $cw=&$this->CurrentFont['cw'];
        if($w==0) $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;

        $s  = str_replace('\r','',$txt);
        $nb = strlen($s);

        if($nb>0 and $s[$nb-1]=='\n') $nb–;

        $sep=-1; $i=0; $j=0; $l=0; $nl=1;

        while($i<$nb){
                $c = $s[$i];
                if($c=='\n'){
                    $i++; $sep=-1; $j=$i; $l=0; $nl++;
                    continue;
                }

                if($c==' ') $sep = $i;

                $l += $cw[$c];

                if($l>$wmax){
                    if($sep==-1){ if($i==$j) $i++; }
                    else $i = $sep+1;

                    $sep=-1; $j=$i; $l=0; $nl++;
                }
                else $i++;
        }
        return $nl;
    }

    //FUNCION PARA CELL CON BORDES REDONDEADOS
    function RoundedBorderCell($w, $h=0, $txt='', $ln=0, $align='', $fill=false, $link='', $rounded = '1234') {
        $spaceLeft = ($this->h - $this->GetY() - $this->bMargin);
        $cellHeight = $h + $this->cellspacing;
        if ($spaceLeft < $cellHeight) {
            $this->AddPage();
        }
        //RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
        $this->RoundedRect(
            $this->GetX() + $this->cellspacing / 2, //X
            $this->GetY() + $this->cellspacing / 2, //Y
            $w - $this->cellspacing, //W
            $h, //H
            $this->roundRadio, //RADIO
            $rounded, //rounded esquinas
            'D'.($fill?'F':'')); //STYLE
        $this->Cell($w, $cellHeight, $txt, $ln, 0, $align, 0, $link);
    }

    //FUNCIONES PARA ROTACIÓN
    function Rotate($angle, $x=-1, $y=-1) {
        if($x==-1)	$x=$this->x;
        if($y==-1)	$y=$this->y;
        if($this->angle_!=0) $this->_out('Q');

        $this->angle_=$angle;

        if($angle!=0) {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }

    function RotatedText($x, $y, $txt, $angle) {
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

    function RotatedImage($file, $x, $y, $w, $h, $angle) {
        $this->Rotate($angle, $x, $y);
        $this->Image($file, $x, $y, $w, $h);
        $this->Rotate(0);
    }

    //FUNCIONES PARA HTML
    function WriteHTML($html, $sangria = 0, $hcelda = 0.5) {
        // Intérprete de HTML
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e) {
            if($i%2==0) {
                if($sangria > 0){
                    $this->SetX($sangria);
                }
                // Text
                if($this->HREF){
                    $this->PutLink($this->HREF,$e);
                }elseif($this->ALIGN == 'center'){
                    $this->Cell(0, $hcelda, $e, 0, 1, 'C');
                }elseif($this->ALIGN == 'left'){
                    $this->MultiCell(0, $hcelda, $e, 0, 'L');
                }else{
                    $this->Write($this->celda_alto,$e);
                }
            } else {
                // Etiqueta
                if($e[0]=='/'){
                    $this->CloseTag(strtoupper(substr($e,1)));
                }else {
                    // Extraer atributos
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v) {
                        //if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        if(preg_match('/^([^=]*)=["\']?([^"\']*)["\']?$/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr) {
        // Etiqueta de apertura
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln($this->celda_alto);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR') {
            if( $prop['WIDTH'] != '' )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x, $y, $x+$Width, $y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag) {
        // Etiqueta de cierre
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag, $enable) {
        // Modificar estilo y escoger la fuente correspondiente
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s) {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt) {
        // Escribir un hiper-enlace
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write($this->celda_alto,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

    #x, y: top left corner of the rectangle.
        #w, h: width and height.
        #r: radius of the rounded corners.
        #style: same as Rect(): F, D (default value), FD or DF.
        #        D - Draw Line
        #        F - Fill
        #        DF or FD - Draw Line and Fill
    function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '') {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        if (strpos($corners, '2')===false)
            $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($corners, '3')===false)
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($corners, '4')===false)
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($corners, '1')===false) {
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3) {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

    #CODE 128
        function Code128($x, $y, $code, $w, $h) {
            $Aguid = "";                                                                      // Création des guides de choix ABC
            $Bguid = "";
            $Cguid = "";
            for ($i=0; $i < strlen($code); $i++) {
                $needle = substr($code,$i,1);
                $Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O");
                $Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O");
                $Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
            }

            $SminiC = "OOOO";
            $IminiC = 4;

            $crypt = "";
            while ($code > "") {
                                                                                            // BOUCLE PRINCIPALE DE CODAGE
                $i = strpos($Cguid,$SminiC);                                                // forçage du jeu C, si possible
                if ($i!==false) {
                    $Aguid [$i] = "N";
                    $Bguid [$i] = "N";
                }

                if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
                    $crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // début Cstart, sinon Cswap
                    $made = strpos($Cguid,"N");                                             // étendu du set C
                    if ($made === false) {
                        $made = strlen($Cguid);
                    }
                    if (fmod($made,2)==1) {
                        $made--;                                                            // seulement un nombre pair
                    }
                    for ($i=0; $i < $made; $i += 2) {
                        $crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
                    }
                    $jeu = "C";
                } else {
                    $madeA = strpos($Aguid,"N");                                            // étendu du set A
                    if ($madeA === false) {
                        $madeA = strlen($Aguid);
                    }
                    $madeB = strpos($Bguid,"N");                                            // étendu du set B
                    if ($madeB === false) {
                        $madeB = strlen($Bguid);
                    }
                    $made = (($madeA < $madeB) ? $madeB : $madeA );                         // étendu traitée
                    $jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours

                    $crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // début start, sinon swap

                    $crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

                }
                $code = substr($code,$made);                                           // raccourcir légende et guides de la zone traitée
                $Aguid = substr($Aguid,$made);
                $Bguid = substr($Bguid,$made);
                $Cguid = substr($Cguid,$made);
            }                                                                          // FIN BOUCLE PRINCIPALE

            $check = ord($crypt[0]);                                                   // calcul de la somme de contrôle
            for ($i=0; $i<strlen($crypt); $i++) {
                $check += (ord($crypt[$i]) * $i);
            }
            $check %= 103;

            $crypt .= chr($check) . chr(106) . chr(107);                               // Chaine cryptée complète

            $i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
            $modul = $w/$i;

            for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
                $c = $this->T128[ord($crypt[$i])];
                for ($j=0; $j<count($c); $j++) {
                    $this->Rect($x,$y,$c[$j]*$modul,$h,"F");
                    $x += ($c[$j++]+$c[$j])*$modul;
                }
            }
        }

}

?>
