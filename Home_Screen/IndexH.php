<?php
	session_start();
	require_once("../SessionCheck/SessionCheck.php");
	include("ConsultaH.php");
	//Cambiar dirección de conexión a base de datos
	require_once("../Productos/DBConnection.php");
	include("HeaderH.html");
  	include("../Navbar/_headernavbar.html");
  	if($_SESSION['Role']=="Administrador")
  			include("../Navbar/_navbar.html");
  	include("ContainerH.html");
	include("TAlmacenes.php");
	//$_SESSION['Rol']=="Voluntario"; 
	//if($_SESSION['Role']=="Administrador")
		//include("ButtonH.html");
	//include("FooterH.html");
	include("FooterH.html");

?>