<?php  
require_once('model.php');

insertar_donador($_POST['nombred'], $_POST['telefonod'], $_POST['correod'], $_POST['recurrente']);

echo tabla_donador();

?>