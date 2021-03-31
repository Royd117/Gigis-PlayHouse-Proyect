<?php 

  session_start();
  require_once("DBConnection.php");
  require("Consultas.php");
  $_SESSION["Producto"]=productoN($_GET["id"],$conn);
  $_SESSION["cantidad"]=productoC($_GET["id"],$conn);
  $_SESSION["ProductoN"]=$_GET["id"];
  include("HeaderP.html");
  include("../Navbar/_headernavbar.html");
  if($_SESSION['Role']=="Administrador")
    include("../Navbar/_navbar.html");
  include("NombreProducto.php");
  //$_SESSION['Rol']=="Voluntario"; 
  include("FormCantidad.html");
  if($_SESSION['Role']=="Administrador")
    include("EliminarProducto.html");
  include("divsend.html");
  include("FooterP.html");

 ?>