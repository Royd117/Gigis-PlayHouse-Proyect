<?php 
  require_once("php/model.php");

  session_start();
  require_once("../SessionCheck/SessionCheck.php");
  limpiar_entradas();

  include("_header.html");
  include("../Navbar/_headernavbar.html");
 // if($_SESSION['Role']=="Administrador")
  include("../Navbar/_navbar.html");
  include("_container.html");
  include("_modal_consultar.html");
  include("_boton_consultar.html");

  include("_tabla_movimientos.html");
  
  include("_endcontainer.html");
  include("_footer.html"); 
 ?>