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

function tabla_reporte() 
{
    $consulta = 'SELECT DONADOR.NombreDonador, PRODUCTO.NombreProducto, PROPORCIONA.FechaProporcionado, PROPORCIONA.CantidadProporcionada, PROPORCIONA.CantidadProporcionada*PRODUCTO.PrecioEstimado AS "Valor"';
    $consulta .= ' FROM PRODUCTO NATURAL JOIN PROPORCIONA NATURAL JOIN DONADOR';
    $consulta .= ' ORDER BY PROPORCIONA.FechaProporcionado DESC';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
 //   var_dump($consulta);
    $resultado = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>Nombre del Donador</th><th>Nombre del Producto Donado</th><th>Fecha</th><th>Cantidad Proporcionada</th><th>Valor Generado</th></tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    { 
        $resultado .= '<tr>';
        $resultado .= '<td>'.$row["NombreDonador"].'</td>';
        $resultado .= '<td>'.$row["NombreProducto"].'</td>';
        $resultado .= '<td>'.$row["FechaProporcionado"].'</td>';
        $resultado .= '<td>'.$row["CantidadProporcionada"].'</td>';
        $resultado .= '<td>'.$row["Valor"].'</td>';
        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table><br>';
    
    desconectar($conexion_bd);
    return $resultado;
} 

function realizarConsulta($fechai, $fechaf) 
{
    $conexion_bd = conectar();
    $consulta1 = 'SELECT DONADOR.NombreDonador, PRODUCTO.NombreProducto,PROPORCIONA.FechaProporcionado, PROPORCIONA.CantidadProporcionada, PROPORCIONA.CantidadProporcionada*PRODUCTO.PrecioEstimado AS "Valor"';
    $consulta1 .= ' FROM PRODUCTO NATURAL JOIN PROPORCIONA NATURAL JOIN DONADOR';
    $consulta1 .= ' WHERE PROPORCIONA.FechaProporcionado >= "'.$fechai.'" AND PROPORCIONA.FechaProporcionado <= "'.$fechaf.'"';
    $consulta1 .= ' ORDER BY PROPORCIONA.FechaProporcionado DESC;';

    $consulta2 = 'SELECT SUM(PROPORCIONA.CantidadProporcionada*PRODUCTO.PrecioEstimado) AS "Total"';
    $consulta2 .= ' FROM PRODUCTO NATURAL JOIN PROPORCIONA NATURAL JOIN DONADOR';
    $consulta2 .= ' WHERE PROPORCIONA.FechaProporcionado >=  "'.$fechai.'" AND PROPORCIONA.FechaProporcionado <= "'.$fechaf.'"';

    $conexion_bd = conectar();
    $resultados_consulta1 = $conexion_bd->query($consulta1);  

    $resultado1 = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado1 .= '<thead class="bg-warning"><tr><th>Nombre del Donador</th><th>Nombre del Producto Donado</th><th>Fecha</th><th>Cantidad Proporcionada</th><th>Valor Generado</th></tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta1, MYSQLI_ASSOC)) 
    { 
        $resultado1 .= '<tr>';
        $resultado1 .= '<td>'.$row["NombreDonador"].'</td>';
        $resultado1 .= '<td>'.$row["NombreProducto"].'</td>';
        $resultado1 .= '<td>'.$row["FechaProporcionado"].'</td>';
        $resultado1 .= '<td>'.$row["CantidadProporcionada"].'</td>';
        $resultado1 .= '<td>'.$row["Valor"].'</td>';
        $resultado1 .= '</tr>';
    }
    mysqli_free_result($resultados_consulta1); //Liberar la memoria
    $resultado1 .= '</table><br>';
    
    $resultados_consulta2 = $conexion_bd->query($consulta2);
    $row = mysqli_fetch_array($resultados_consulta2, MYSQLI_ASSOC);
    $resultado1 .= '<table class="table table-hover table-condensed table-bordered">';
    $resultado1 .= '<thead class="bg-warning"><tr><th>Total en Donativos Recibidos</th></tr></thead>';
    $resultado1 .= '<tbody><tr><th>'.$row["Total"].'</th></tr></tbody>';
    $resultado1 .= '</table>';
    
    desconectar($conexion_bd);
    return $resultado1;
}

function PasaraExcel($fechai, $fechaf)
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
    $consulta1 = 'SELECT DONADOR.NombreDonador, PRODUCTO.NombreProducto, PROPORCIONA.FechaProporcionado, PROPORCIONA.CantidadProporcionada, PROPORCIONA.CantidadProporcionada*PRODUCTO.PrecioEstimado AS "Valor"';
    $consulta1 .= ' FROM PRODUCTO NATURAL JOIN PROPORCIONA NATURAL JOIN DONADOR';
    $consulta1 .= ' WHERE PROPORCIONA.FechaProporcionado >= "'.$fechai.'" AND PROPORCIONA.FechaProporcionado <= "'.$fechaf.'"';
    $consulta1 .= ' ORDER BY PROPORCIONA.FechaProporcionado DESC;';

    $consulta2 = 'SELECT SUM(PROPORCIONA.CantidadProporcionada*PRODUCTO.PrecioEstimado) AS "Total"';
    $consulta2 .= ' FROM PRODUCTO NATURAL JOIN PROPORCIONA NATURAL JOIN DONADOR';
    $consulta2 .= ' WHERE PROPORCIONA.FechaProporcionado >=  "'.$fechai.'" AND PROPORCIONA.FechaProporcionado <= "'.$fechaf.'"';
   
    $resultados_consulta1 = $conexion_bd->query($consulta1) or die('¡Consulta fallida!');
    while($row = mysqli_fetch_array($resultados_consulta1, MYSQLI_ASSOC))
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

    $resultados_consulta2 = $conexion_bd->query($consulta2) or die('¡Consulta fallida!');
    while($row = mysqli_fetch_array($resultados_consulta2, MYSQLI_ASSOC))
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

    if (isset($_GET["fechaIReporte"])) {
        $_GET["fechaIReporte"] = htmlspecialchars($_GET["fechaIReporte"]);
    }

    if (isset( $_POST["fechaIReporte"])) {
       $_POST["fechaIReporte"] = htmlspecialchars($_POST["fechaIReporte"]);
    }

    if (isset($_GET["fechaFReporte"])) {
        $_GET["fechaFReporte"] = htmlspecialchars($_GET["fechaFReporte"]);
    }

    if (isset( $_POST["fechaFReporte"])) {
       $_POST["fechaFReporte"] = htmlspecialchars($_POST["fechaFReporte"]);
    }   
}

?>