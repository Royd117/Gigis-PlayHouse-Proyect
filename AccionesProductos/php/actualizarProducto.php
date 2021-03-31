<?php

require_once("model.php");
//recibe los datos de la forma con post
//mandar a llamar actualiza persona
//debe de estar model.php 
//redirigir a index.php

actualizar_producto($_POST['IdProducto'], $_POST['nombreproducto'], $_POST['descripcionproducto'], $_POST['precioestimado']);
header('location: ../index.php');

?>