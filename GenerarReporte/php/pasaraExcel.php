<?php
session_start();
require_once("model.php");
PasaraExcel($_SESSION['fechaIReporte'], $_SESSION['fechaFReporte']);
?>