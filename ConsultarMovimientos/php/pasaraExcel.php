<?php
session_start();
require_once("model.php");
PasaraExcel($_SESSION['NomAlmacen'], $_SESSION['fechaIConsulta'], $_SESSION['fechaFConsulta']);
?>