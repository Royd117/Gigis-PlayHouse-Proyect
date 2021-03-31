<?php
session_start();  
require_once('model.php');
$_SESSION['eliminado']=true;
eliminar_personal($_POST['id']);

header('location: ../index.php');

?>