<?php  
require_once('model.php');

insertar_producto($_POST['nombreproducto'], $_POST['descripcionproducto'], $_POST['precioestimado']);

echo tabla_producto();

?>
<!---De alguna forma si le cambio el nombre deja de funcionar =v --->