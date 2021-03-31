<?php
session_start();
require_once('model.php');

$_SESSION['fechaIReporte'] = $_POST['fechaIReporte'];
$_SESSION['fechaFReporte'] = $_POST['fechaFReporte'];

echo realizarConsulta($_POST['fechaIReporte'], $_POST['fechaFReporte']);

include("../_boton_descargar.html");
?>