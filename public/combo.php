<?php
$id=$_POST['id'];
  $mysqli = new mysqli('162.241.2.113', 'javibirt_javier', 'javierespinosa', 'javibirt_registros');
 // $mysqli = new mysqli('192.168.29.94', 'root', 'srvsedesol', 'registros');
  $mysqli->set_charset("utf8");

$valores="";

  $query = $mysqli -> query ("SELECT * FROM cat_localidad where id_municipio=".$id);
  while ($valores = mysqli_fetch_assoc($query)) {
    echo "<option value='".$valores['localidad']."'>".$valores['localidad']."</option>";
  }
?>