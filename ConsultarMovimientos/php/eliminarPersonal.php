<?php  
require_once('model.php');

eliminar_personal($_POST['id']);

header('location: ../index.php');

?>