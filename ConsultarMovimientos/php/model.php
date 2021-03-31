<?php

function conectar() 
{
    $conexion_bd = mysqli_connect("websigner-db-mysql-do-user-8217587-0.b.db.ondigitalocean.com","doadmin","gp7xci3jm2vh5wca","GIGIS_DB","25060");
    //$conexion_bd = mysqli_connect("localhost","root","","gigis_db");
    
    if ($conexion_bd == NULL) 
    {
        die("No se pudo conectar a la base de datos");
    }
    
    $conexion_bd->set_charset("utf8");
    return $conexion_bd;
}

function desconectar($conexion_bd) 
{
    mysqli_close($conexion_bd);
}

//para las opciones 
function select($name, $tabla="ALMACEN", $id="IdAlmacen", $Nombre="NombreAlmacen") 
{
    $resultado = '<select class="form-control" id="'.$name.'" name="'.$name.'" class="custom-select">';
    $resultado .= '<option value="" disabled selected>Selecciona un Almacen</option>';
    $conexion_bd = conectar();
    
    $consulta = 'SELECT * FROM ALMACEN ORDER BY '.$Nombre.'';
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_BOTH)) 
    {    
        $resultado .= '<option value="'.$row[$id].'">'.$row[$Nombre].'</option>';
    }
    $resultado .= '<option value="Todos">Todos</option>';
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</select>';
    
    desconectar($conexion_bd);
    return $resultado;
    var_dump($name);

}

function tabla_movimientos() 
{
    $consulta = 'SELECT PERSONAL.NombrePersonal, ALMACEN.NombreAlmacen, PRODUCTO.NombreProducto, MOVIMIENTO.Tipo, MOVIMIENTO.Cantidad, MOVIMIENTO.Destinatario, MOVIMIENTO.Fecha'; 
    $consulta .= ' FROM PERSONAL NATURAL JOIN MOVIMIENTO NATURAL JOIN ALMACEN NATURAL JOIN PRODUCTO';
    $consulta .= ' ORDER BY MOVIMIENTO.Fecha DESC';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
    $resultado = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>Personal</th><th>Almacen</th><th>Producto</th><th>Tipo de Movimiento</th><th>Cantidad</th><th>Destinatario</th><th>Fecha</th></tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    { 
        $resultado .= '<tr>';
        $resultado .= '<td>'.$row["NombrePersonal"].'</td>';
        $resultado .= '<td>'.$row["NombreAlmacen"].'</td>';
        $resultado .= '<td>'.$row["NombreProducto"].'</td>';
        $resultado .= '<td>'.$row["Tipo"].'</td>';
        $resultado .= '<td>'.$row["Cantidad"].'</td>';
        $resultado .= '<td>'.$row["Destinatario"].'</td>';
        $resultado .= '<td>'.$row["Fecha"].'</td>';
        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table><br>';
    
    desconectar($conexion_bd);
    return $resultado;
} 

function realizarConsulta($almacen, $fechai, $fechaf) 
{
    $conexion_bd = conectar();
    $consulta = 'SELECT PERSONAL.NombrePersonal, ALMACEN.NombreAlmacen, PRODUCTO.NombreProducto, MOVIMIENTO.Tipo, MOVIMIENTO.Cantidad, MOVIMIENTO.Destinatario, MOVIMIENTO.Fecha';
    $consulta .= ' FROM PERSONAL NATURAL JOIN MOVIMIENTO NATURAL JOIN ALMACEN NATURAL JOIN PRODUCTO';

    if ($almacen=="Todos")
    {
        $consulta .= ' WHERE MOVIMIENTO.Fecha >= "'.$fechai.'" AND MOVIMIENTO.Fecha <= "'.$fechaf.'"';
        $consulta .= ' ORDER BY MOVIMIENTO.Fecha DESC';
    }
    else
    {
        $consulta .= ' WHERE MOVIMIENTO.IdAlmacen = '.$almacen.' AND MOVIMIENTO.Fecha >= "'.$fechai.'" AND MOVIMIENTO.Fecha <= "'.$fechaf.'"';
        $consulta .= ' ORDER BY MOVIMIENTO.Fecha DESC';
    }
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
 //   var_dump($consulta);
    $resultado = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>Personal</th><th>Almacen</th><th>Producto</th><th>Tipo de Movimiento</th><th>Cantidad</th><th>Destinatario</th><th>Fecha</th></tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    { 
        $resultado .= '<tr>';
        $resultado .= '<td>'.$row["NombrePersonal"].'</td>';
        $resultado .= '<td>'.$row["NombreAlmacen"].'</td>';
        $resultado .= '<td>'.$row["NombreProducto"].'</td>';
        $resultado .= '<td>'.$row["Tipo"].'</td>';
        $resultado .= '<td>'.$row["Cantidad"].'</td>';
        $resultado .= '<td>'.$row["Destinatario"].'</td>';
        $resultado .= '<td>'.$row["Fecha"].'</td>';
        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table><br>';
    
    desconectar($conexion_bd);
    return $resultado;
}

function PasaraExcel($almacen, $fechai, $fechaf)
{
    function cleanData(&$str)
    {
        if($str == 't') $str = 'TRUE';
        if($str == 'f') $str = 'FALSE';
        if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) 
        {
            $str = "'$str";
        }
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        $str = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
    }

    // filename for download
    $file = "Revision_".date('Ymd').".xls";
  
    header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE;");
    header("Content-Disposition: attachment; filename=$file");
    
    $flag = false;
    $conexion_bd = conectar();
    $consulta = 'SELECT PERSONAL.NombrePersonal, ALMACEN.NombreAlmacen, PRODUCTO.NombreProducto, MOVIMIENTO.Tipo, MOVIMIENTO.Cantidad, MOVIMIENTO.Destinatario, MOVIMIENTO.Fecha';
    $consulta .= ' FROM PERSONAL NATURAL JOIN MOVIMIENTO NATURAL JOIN ALMACEN NATURAL JOIN PRODUCTO';

    if ($almacen=="Todos")
    {
        $consulta .= ' WHERE MOVIMIENTO.Fecha >= "'.$fechai.'" AND MOVIMIENTO.Fecha <= "'.$fechaf.'"';
        $consulta .= ' ORDER BY MOVIMIENTO.Fecha DESC';
    }
    else
    {
        $consulta .= ' WHERE MOVIMIENTO.IdAlmacen = '.$almacen.' AND MOVIMIENTO.Fecha >= "'.$fechai.'" AND MOVIMIENTO.Fecha <= "'.$fechaf.'"';
        $consulta .= ' ORDER BY MOVIMIENTO.Fecha DESC';
    }
    $resultados_consulta = $conexion_bd->query($consulta) or die('¡Consulta fallida!');
    while($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC))
    {
      if(!$flag) 
      {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
      }
      array_walk($row, __NAMESPACE__ . '\cleanData');
      echo implode("\t", array_values($row)) . "\r\n";
    }
    desconectar($conexion_bd);
    exit;
}

function limpiar_entradas() {
    if (isset($_GET["id"])) {
        $_GET["id"] = htmlspecialchars($_GET["id"]);
    }

    if (isset($_GET["NomAlmacen"])) {
        $_GET["ALMACEN"] = htmlspecialchars($_GET["ALMACEN"]);
    }

    if (isset( $_POST["NomAlmacen"])) {
        $_POST["ALMACEN"] = htmlspecialchars($_POST["ALMACEN"]);
     }

    if (isset($_GET["fechaIConsulta"])) {
        $_GET["fechaIConsulta"] = htmlspecialchars($_GET["fechaIConsulta"]);
    }

    if (isset( $_POST["fechaIConsulta"])) {
       $_POST["fechaIConsulta"] = htmlspecialchars($_POST["fechaIConsulta"]);
    }

    if (isset($_GET["fechaFConsulta"])) {
        $_GET["fechaFConsulta"] = htmlspecialchars($_GET["fechaFConsulta"]);
    }

    if (isset( $_POST["fechaFConsulta"])) {
       $_POST["fechaFConsulta"] = htmlspecialchars($_POST["fechaFConsulta"]);
    }   
}

?>