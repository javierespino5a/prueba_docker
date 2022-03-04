<?php
  $mysqli = new mysqli('162.241.2.113', 'javibirt_javier', 'javierespinosa', 'javibirt_registros');
  //$mysqli = new mysqli('192.168.29.94', 'root', 'srvsedesol', '');
    $mysqli->set_charset("utf8");


$query = $mysqli -> query ("SELECT id_municipio, municipio FROM cat_municipio");
echo '<option value="" data-foo="">Seleccione una opción</option>';

while ($valores = mysqli_fetch_assoc($query)) {
  echo '<option value="'.$valores['municipio'].'"data-foo="'.$valores['id_municipio'].'">'.$valores['municipio'].'</option>';
}

?>