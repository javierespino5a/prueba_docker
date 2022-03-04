<?php

$servername = "162.241.2.113";
$username = "javibirt_javier";
$password = "javierespinosa";
$dbname = "javibirt_registros";
$id=$_POST['nombres'];

$id=$_POST['nombres'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO tbl_registro (FECHA, MUNICIPIO, LOCALIDAD, NOMBRES, APELLIDO_MATERNO, APELLIDO_PATERNO, SEXO, EDAD, TELEFONO, JEFE_DE_FAMILIA,
CALLE,NUMERO, CRUZAMIENTO1, CRUZAMIENTO2, COLONIA, REFERENCIA_DOMICILIO, DISCAPACIDAD, NUM_DISCAPACITADOS, PARENTESCO_DISC,
MUJERES_PERIODO, HABITAN_NINIOS, NUM_NINIOS)
VALUES ('".$_POST['fecha']."', '".$_POST['cbx']."', '".$_POST['localidad']."','".$_POST['nombres']."','".$_POST['apellidop']."','".$_POST['apellidom']."','".$_POST['sexo']."'
,'".$_POST['edad']."','".$_POST['telefono']."','".$_POST['jefe']."','".$_POST['calle']."','".$_POST['numero']."','".$_POST['cruzamiento1']."','".$_POST['cruzamiento2']."'
,'".$_POST['colonia']."','".$_POST['domicilio']."','".$_POST['discapacidad']."','".$_POST['cuantosdiscapacidad']."','".$_POST['parentesco']."'
,'".$_POST['periodo']."','".$_POST['ninios']."','".$_POST['cuantosninios']."'
)";

if ($conn->query($sql) === TRUE) {
  echo'<script type="text/javascript">
        alert("Tarea Guardada");
        window.location.href="index.php";
        </script>';
} 

$conn->close();
?>
