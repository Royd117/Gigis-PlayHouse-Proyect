<?php  
require_once('model.php');

eliminar_producto($_POST['IdProducto']);

header('location: ../index.php');

?>