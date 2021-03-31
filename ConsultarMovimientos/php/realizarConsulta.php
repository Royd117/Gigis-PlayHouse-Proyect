<?php
session_start();
require_once('model.php');

$_SESSION['NomAlmacen'] = $_POST['NomAlmacen'];
$_SESSION['fechaIConsulta'] = $_POST['fechaIConsulta'];
$_SESSION['fechaFConsulta'] = $_POST['fechaFConsulta'];

echo realizarConsulta($_POST['NomAlmacen'], $_POST['fechaIConsulta'], $_POST['fechaFConsulta']);

include("../_boton_descargar.html");
?>