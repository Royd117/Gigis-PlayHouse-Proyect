<?php 

  require_once("php/model.php");


  session_start();
  require_once("../SessionCheck/SessionCheck.php");
  //limpiar_entradas();
  

  include("_header.html");
  include("../Navbar/_headernavbar.html");
  //if($_SESSION['Role']=="Administrador")
  include("../Navbar/_navbar.html");
  include("_container.html"); 
  if ( isset($_SESSION['eliminado_donador']) && $_SESSION['eliminado_donador']==true){
    include("_mensaje_de_usuario_eliminado.html");
  }
  if ( isset($_SESSION['actualizado_donador']) && $_SESSION['actualizado_donador']==true){
    include("_mensaje_de_usuario_actualizado.html");
  }
  include("_modal_registrar.html");
  include("_boton_descargar_excel.html");
  include("_boton_registrar.html");
  include("_barra_de_busqueda.html");

  include("_tabla_donadores.html");

  include("_endcontainer.html");
  include("_footer.html");
  $_SESSION['eliminado_donador']=false; 
  $_SESSION['actualizado_donador']=false;


 ?>