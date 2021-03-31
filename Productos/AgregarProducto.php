<?php
	session_start();
	include("DBConnection.php");
	function insertar_Producto($almacen,$nombre,$descripcion,$precio,$ultimo,$conn){
		$consulta1="INSERT INTO Producto(NombreProducto,Descripcion,PrecioEstimado) VALUES ('".$nombre."','".$descripcion."','".$precio."')";
		$consulta2="INSERT INTO Cantidad(IdProducto,IdAlmacen,CantidadRegistrada) VALUES ('".$ultimo."','".$almacen."','1')";
		mysqli_query($conn, $consulta1);
		mysqli_query($conn, $consulta2);
		header("Location: ../Productos/IndexP.php?id=".$_SESSION["Almacen"]."");
		$destination='image/'.$ultimo.'.png';
		$file=$_FILES['image']['tmp_name'];
		move_uploaded_file($file, $destination);
	}
	insertar_Producto($_SESSION["Almacen"],$_POST["NombreProducto"],$_POST["Descripcion"],$_POST["PrecioEstimado"],$_SESSION["UltimoP"],$conn);
  ?>