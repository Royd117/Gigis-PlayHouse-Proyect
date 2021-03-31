<?php 

  require_once("php/model.php");


  session_start();
  //require_once("../SessionCheck/SessionCheck.php");
  $persona=get_personal($_GET['id']);



  include("_header.html");
  include("../Navbar/_headernavbar.html");
  include("../Navbar/_navbar.html");
  include("_container.html");
 
  include("_form_editar.html");
  
 
  include("_endcontainer.html");
  include("_footer.html"); 

 ?>