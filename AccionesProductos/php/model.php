<?php

function conectar() {
    $conexion_bd = mysqli_connect("websigner-db-mysql-do-user-8217587-0.b.db.ondigitalocean.com","doadmin","gp7xci3jm2vh5wca","GIGIS_DB","25060");
    
    if ($conexion_bd == NULL) {
        die("No se pudo conectar a la base de datos");
    }
    
    $conexion_bd->set_charset("utf8");
    return $conexion_bd;
}

function desconectar($conexion_bd) {
    mysqli_close($conexion_bd);
}

//para las opciones 
function select($name, $tabla, $id="id", $nombre="nombre") 
{
    $resultado = '<select id="'.$name.'"  name="'.$name.'" class="browser-default">';
    $resultado .= '<option value="" disabled selected>Selecciona un '.$tabla.'</option>';
    $conexion_bd = conectar();
    
    $consulta = 'SELECT '.$id.', '.$nombre.' FROM '.$tabla.' ORDER BY '.$nombre.' ASC';
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_BOTH)) {
        
        $resultado .= '<option value="'.$row[$id].'">'.$row[$nombre].'</option>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</select><label>'.$tabla.'</label>';
    
    desconectar($conexion_bd);
    return $resultado;
}

function tabla_producto( $criterio= "") 
{
    
    $consulta = 'SELECT *';
    $consulta .= ' FROM producto ';
 //   $consulta .= 'WHERE  t.Id = acusa.acusador_id AND s.Id = acusa.acusado_id';
    if($criterio != "")
    {
        $consulta .= 'WHERE  IdProducto LIKE "%'.$criterio.'%" OR NombreProducto lIKE "%'.$criterio.'%" OR Descripcion lIKE "%'.$criterio.'%" ';
    }
    $consulta .= ' ORDER BY IdProducto DESC';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
 //   var_dump($consulta);
    $resultado = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>ID del Producto</th><th>Nombre del Producto</th><th>Descripción</th><th>Precio Estimado</th><th>Fotografía del Producto</th><th>Editar</th></tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    { 
        $resultado .= '<th scope="row">'.$row["IdProducto"].'</th>';
        $resultado .= '<td>'.$row["NombreProducto"].'</td>';
        $resultado .= '<td>'.$row["Descripcion"].'</td>';
        $resultado .= '<td>'.$row["PrecioEstimado"].'</td>';
        $resultado .= '<td>'.$row["Fotografía"].'</td>';
     
        $resultado .= '<td>'. '<a class="btn btn-secondary" href="editarProducto.php?id='.$row["IdProducto"].'"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></a>'.'</td>';
        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table>';
    
    desconectar($conexion_bd);
    return $resultado;
}

function get_producto($id)
{
    $consulta = 'SELECT * FROM PRODUCTO WHERE IdProducto ='.$id.'';
 //   $consulta .= 'WHERE  t.Id = acusa.acusador_id AND s.Id = acusa.acusado_id';

    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
        
    $persona = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC); 
   
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    desconectar($conexion_bd);
    return $persona;
}

function insertar_producto($NombreProducto, $Descripcion, $PrecioEstimado) 
{
     
    $conexion_bd = conectar();
    // INSERT INTO `personal` (`IdPersonal`, `NombrePersonal`, `TelefonoPersonal`, `CorreoPersonal`, `Privilegio`, `FechaInicioLaboral`, `Contrato`, `Respaldo`) VALUES (NULL, 'Sebas', '9678523', 'seba@hotmail.com', '3', '12/10/20', NULL, NULL); `FechaInicioLaboral`, `FechaFinLaboral` , ?, ?  , $_POST['fechaicolab'], $_POST['fechafcolab']$fechaicolab, $fechafcolab
    $consulta = "INSERT INTO PRODUCTO (NombreProducto, Descripcion, PrecioEstimado) VALUES (?, ? , ?)";
    
    if(!($statement = $conexion_bd->prepare($consulta))) 
    {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("sss",$NombreProducto, $Descripcion, $PrecioEstimado))) 
    {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) 
    {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}
//insertar_producto('Prueba2', 'asdfghjgfds', 500);

function eliminar_producto($id) 
{
    $conexion_bd = conectar();
    
    $consulta = "DELETE FROM PRODUCTO WHERE IdProducto = ?";
    
    if(!($statement = $conexion_bd->prepare($consulta))) 
    {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("s",$id))) 
    {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) 
    {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}
//eliminar_personal(2);
//UPDATE `personal` SET `NombrePersonal` = 'Pol', `TelefonoPersonal` = '9678593', `CorreoPersonal` = 'pol@hotmail.com', `FechaInicioLaboral` = '2018-10-20', `FechaFinLaboral` = '2022-10-20' WHERE `personal`.`IdPersonal` = 4;

function actualizar_producto($IdProducto, $NombreProducto, $Descripcion, $PrecioEstimado) 
{
    $conexion_bd = conectar();
    
    $consulta = "UPDATE PRODUCTO SET NombreProducto = ?, Descripcion = ?, PrecioEstimado = ? WHERE IdProducto = ?";
    
    if(!($statement = $conexion_bd->prepare($consulta))) 
    {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("ssss", $NombreProducto, $Descripcion, $PrecioEstimado, $IdProducto))) 
    {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

?>