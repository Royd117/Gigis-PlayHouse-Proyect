<?php
session_start(); 
require_once("model.php");
//recibe los datos de la forma con post
//mandar a llamar actualiza persona
//debe de estar model.php 
//redirigir a index.php passwordu
$_SESSION['actualizado']=true;

actualizar_personal($_POST['id'],$_POST['nombreu'],$_POST['telefonou'], $_POST['correou'], $_POST['passwordu'], $_POST['puestou'],  $_POST['rolu'], $_POST['fechaicolabu'], $_POST['fechafcolabu']);
header('location: ../index.php');

?>