<?php
	session_start();


	require_once("DBConnection.php");
	include("Consultas.php");


	$_SESSION["Almacen"]=get_almacen($_GET['id'],$conn);	
	$_SESSION["AlmacenN"]=get_almacenN($_GET['id'],$conn);
	$_SESSION["UltimoP"]=UltimoP($conn)+1;

	include("ConsultaP.php");
	include("HeaderP.html");
  	include("../Navbar/_headernavbar.html");
  	if($_SESSION['Role']=="Administrador")
  			include("../Navbar/_navbar.html");
  	include("NombreAlmacen.php");
  	include("SearchBarP.html");
	include("TProductos.php");
	//$_SESSION['Rol']=="Voluntario"; 
    if($_SESSION['Role']=="Administrador")
    	include("ButtonP.html");
	include("FooterP.html");

?>