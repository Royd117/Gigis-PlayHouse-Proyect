<?php
	$TodosProductos = "SELECT * FROM Cantidad NATURAL JOIN Producto WHERE IdAlmacen= ".$_SESSION["Almacen"] ;
  ?>