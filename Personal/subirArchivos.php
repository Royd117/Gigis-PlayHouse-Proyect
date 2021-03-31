<?php 

  require_once("php/model.php");

  session_start();
  //require_once("../SessionCheck/SessionCheck.php");
  $persona=get_personal($_GET['id']);
  //var_dump($persona);
  $idpersonal=$persona['IdPersonal'];



  include("_header.html");
  include("../Navbar/_headernavbar.html");
  include("../Navbar/_navbar.html");
  include("_container.html");
  if ( isset($_SESSION['formato_archivo']) && $_SESSION['formato_archivo']==true){
    include("_mensaje_error_formato.html");
  }
  if ( isset($_SESSION['tamano_archivo']) && $_SESSION['tamano_archivo']==true){
    include("_mensaje_error_tamano.html");
  }
  if ( isset($_SESSION['exito_archivo']) && $_SESSION['exito_archivo']==true){
    include("_mensaje_exito_archivo.html");
  }
  include("_form_archivo.html");
 // include("_modal_archivo.html");
  //include("_boton_subir_archivo.html");
  //include("_barra_de_busqueda_archivos.html");
  include("_tabla_archivo.html");
  //include("_form_editar.html");
  
 
  include("_endcontainer.html");
  include("_footer.html"); 
  $_SESSION['formato_archivo']=false;
  $_SESSION['tamano_archivo']=false;
  $_SESSION['exito_archivo']=false;


 ?>