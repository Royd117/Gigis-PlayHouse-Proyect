<?php
session_start(); 
require_once("model.php");
//recibe los datos de la forma con post
//mandar a llamar actualiza persona
//debe de estar model.php 
//redirigir a index.php passwordu
$_SESSION['actualizado_donador']=true;

actualizar_donador($_POST['id'],$_POST['nombredu'],$_POST['telefonodu'], $_POST['correodu'], $_POST['recurrenteu']);
header('location: ../index.php');

?>