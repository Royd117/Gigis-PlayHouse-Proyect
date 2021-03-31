<?php
//Libreria de interacciones

function conectar() 
{

    $conexion_bd = mysqli_connect("websigner-db-mysql-do-user-8217587-0.b.db.ondigitalocean.com","doadmin","gp7xci3jm2vh5wca","GIGIS_DB","25060");   //Nombre del DBMS, Usuario, Contraseña, BaseDeDatos
    
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

function Pasar_a_Excel()
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
    $file = "NombredelDoc_".date('Ymd').".xls"; //Nombre del Documento junto a la fecha en la que está siendo sacado con la extensión
  
    header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE;");
    header("Content-Disposition: attachment; filename=$file");
    
  
    $flag = false;
    $consulta = 'SELECT * FROM TABLA';  //Aquí se hace la consulta que pasaremos a Excel
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta) or die('¡Consulta fallida!');
    while($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC))
    {
      if(!$flag) 
      {
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
      }
      array_walk($row, __NAMESPACE__ . '\cleanData');
      echo implode("\t", array_values($row)) . "\r\n";
    }
    desconectar($conexion_bd);
    exit;
}
//https://www.the-art-of-web.com/php/dataexport/
?>