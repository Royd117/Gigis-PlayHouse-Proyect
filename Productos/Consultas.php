<?php
	require_once("DBConnection.php");
	function get_almacen($id,$conn){
	    $consulta = "SELECT * From almacen ";
	  
	    $consulta .= "WHERE  IdAlmacen =".$id;
		    
		$resultados_consulta = mysqli_query($conn, $consulta);  
	        
	    $row = mysqli_fetch_assoc($resultados_consulta);
	   
	    mysqli_free_result($resultados_consulta); //Liberar la memoria
	  
	    return $row["IdAlmacen"];

	}
		function get_almacenN($id,$conn){
	    $consulta = "SELECT * From almacen ";
	  
	    $consulta .= "WHERE  IdAlmacen =".$id;
		    
		$resultados_consulta = mysqli_query($conn, $consulta);  
	        
	    $row = mysqli_fetch_assoc($resultados_consulta);
	   
	    mysqli_free_result($resultados_consulta); //Liberar la memoria
	  
	    return $row["NombreAlmacen"];

	}
		function UltimoP($conn){
	    $consulta = "SELECT * FROM `cantidad` ORDER BY `cantidad`.`IdProducto` DESC LIMIT 1";
		    
		$resultados_consulta = mysqli_query($conn, $consulta);  
	        
	    $row = mysqli_fetch_assoc($resultados_consulta);
	   
	    mysqli_free_result($resultados_consulta); //Liberar la memoria
	  
	    return $row["IdProducto"];
	}
	function productoN($idproducto,$conn){
	    $consulta = "SELECT * FROM producto WHERE IdProducto= ".$idproducto;
		    
		$resultados_consulta = mysqli_query($conn, $consulta);  
	        
	    $row = mysqli_fetch_assoc($resultados_consulta);
	   
	    mysqli_free_result($resultados_consulta); //Liberar la memoria
	  
	    return $row["NombreProducto"];
	}
	function productoC($idproducto,$conn){
	    $consulta = "SELECT * FROM producto NATURAL JOIN cantidad WHERE IdProducto= ".$idproducto;
		$resultados_consulta = mysqli_query($conn, $consulta);  
	        
	    $row = mysqli_fetch_assoc($resultados_consulta);
	   
	    mysqli_free_result($resultados_consulta); //Liberar la memoria
	  
	    return $row["CantidadRegistrada"];
	}
	
	

  ?>