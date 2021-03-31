<?php
//Funcion para conectar a la base de datos  mysqli_connect("websigner-db-mysql-do-user-8217587-0.b.db.ondigitalocean.com","doadmin","gp7xci3jm2vh5wca","GIGIS_DB","25060")
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


// Funcion que genera la tabla de donadores con la informacion  en la base de datos
function tabla_donador( $criterio= "" ) {
    //$sum1=0;
    $consulta = 'SELECT D.IdDonador as IdDonador, D.NombreDonador as NombreDonador, D.TelefonoDonador as TelefonoDonador, D.CorreoDonador as CorreoDonador, D.Recurrente  as Recurrente ';
    $consulta .= ' FROM donador D ';
 //   $consulta .= 'WHERE  t.Id = acusa.acusador_id AND s.Id = acusa.acusado_id'; , D.NumDonaciones as NumDonaciones
    if($criterio != ""){
        $consulta .= 'WHERE  NombreDonador LIKE "%'.$criterio.'%" OR TelefonoDonador lIKE "%'.$criterio.'%" OR CorreoDonador lIKE "%'.$criterio.'%"  OR Recurrente lIKE "%'.$criterio.'%" '; //OR NumDonaciones lIKE "%'.$criterio.'%"

    }
    $consulta .= ' ORDER BY NombreDonador ASC';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
 //   var_dump($consulta); <th>Número de donaciones</th>
    $resultado = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>Nombre completo</th><th>Teléfono</th><th>Correo electrónico</th><th>Estado</th><th>Mensaje</th><th>Editar</th><tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) { 
        //$resultado .= '<td>'.$row["IdPersonal"].'</td>';
        $resultado .= '<td>'.$row["NombreDonador"].'</td>';
        $resultado .= '<td>'.$row["TelefonoDonador"].'</td>';
        $resultado .= '<td>'.$row["CorreoDonador"].'</td>';
        $resultado .= '<td>'.$row["Recurrente"].'</td>';
        //$resultado .= '<td>'.$row["NumDonaciones"].'</td>';
        //$resultado .= '<td>'.$row["Descripcion"].'</td>';
       // $resultado .= '<td> $ '.$row["Cuatrimestre1"].'</td>';
        //$value = $row['Value'];$sum += $value; , SUM(D.Cuatrimestre1) as c1
        //$resultado .= '<td> $ '.$row["Cuatrimestre2"].'</td>';
        //$resultado .= '<td> $ '.$row["Cuatrimestre3"].'</td>';
        //$resultado .= '<td> $ '.$row["Cuatrimestre4"].'</td>';
       // $resultado .= '<td><a href="subirArchivos.php?id='.$row["IdDonador"].'">Documentos</a></td>';
         $resultado .= '<td>'.'<a href="https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&ct=1605076017&rver=7.0.6737.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.live.com%2fowa%2f%3fnlp%3d1%26RpsCsrfState%3d726350eb-a869-f9f1-d656-660edb737243&id=292841&aadredir=1&CBCXT=out&lw=1&fl=dob%2cflname%2cwld&cobrandid=90015" target="_blank" class="btn btn-primary" ><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/></svg></button>'.' </td>';

        $resultado .= '<td>'. '<a class="btn btn-secondary" href="editarDonador.php?id='.$row["IdDonador"].'"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></a>'.'</td>';

        $resultado .= '</tr>';
    }
    /*$resultado .= '<td  colspan="5">'.'Donativo recibido' .'</td>';
    $resultado .= '<td> $ '.$row["c1"].'</td>';*/
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table><br>';
    
    desconectar($conexion_bd);
    return $resultado;
}
//echo tabla_donador();

//function nombre() funcion imprime nombre 


 
                    
 /*funcion que retorna el nombre del donador atraves de su id*/              


function nombre_donador($id){
    $consulta = 'SELECT  D.NombreDonador as NombreDonador';
    $consulta .= ' FROM donador D ';
    $consulta .= 'WHERE  D.IdDonador ='.$id.'';

    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
        
      
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) {
        
        $resultado = $row["NombreDonador"]; 
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    desconectar($conexion_bd);
    return $resultado;

}

//echo nombre_personal('3');

 /*funcion que retorna la informacion de un donador segun su id*/ 

function get_donador($id){
    $consulta = 'SELECT D.IdDonador as IdDonador, D.NombreDonador as NombreDonador, D.TelefonoDonador as TelefonoDonador, D.CorreoDonador as CorreoDonador, D.Recurrente as Recurrente, D.NumDonaciones as NumDonaciones ';
    $consulta .= ' FROM donador D ';
 //   $consulta .= 'WHERE  t.Id = acusa.acusador_id AND s.Id = acusa.acusado_id';
  
    $consulta .= 'WHERE  D.IdDonador ='.$id.'';

    

    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
        
    $persona = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC); 
   
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    
    desconectar($conexion_bd);
    return $persona;



}


/*
INSERT INTO `donador` (`IdDonador`, `NombreDonador`, `TelefonoDonador`, `CorreoDonador`, `Donativo`, `Descripcion`, `Cuatrimestre1`, `Cuatrimestre2`, `Cuatrimestre3`, `Cuatri  stre4`) VALUES (NULL, 'Alan', '1234', 'Alan@hotmail.com', 'Hojas blanca', '1 paquete', '203', '100', '100', '1000');
      
 
*/
//funcion que inserta los datos del donador atraves  de una consulta 

function insertar_donador($nombre, $telefono, $correo, $recurrente) {                   
     
    $conexion_bd = conectar();
    // INSERT INTO `personal` (`IdPersonal`, `NombrePersonal`, `TelefonoPersonal`, `CorreoPersonal`, `Privilegio`, `FechaInicioLaboral`, `Contrato`, `Respaldo`) VALUES (NULL, 'Sebas', '9678523', 'seba@hotmail.com', '3', '12/10/20', NULL, NULL); `FechaInicioLaboral`, `FechaFinLaboral` , ?, ?  , $_POST['fechaicolab'], $_POST['fechafcolab']$fechaicolab, $fechafcolab
    $consulta = "INSERT INTO `donador` (`NombreDonador`, `TelefonoDonador`, `CorreoDonador`, `Recurrente`) VALUES (?, ?, ? , ?)";
    
    if(!($statement = $conexion_bd->prepare($consulta))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("ssss",$nombre, $telefono, $correo,  $recurrente))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

//insertar_personal('Pikachu', '9678103', 'poke@hotmail.com', '11/11/20', '12/11/21');
//Funcion que elimina el donador  atraves de la consulta del id
function eliminar_donador($id ) {
     
    $conexion_bd = conectar();
    
    $consulta = "DELETE FROM `donador` WHERE IdDonador = ?";
    
    if(!($statement = $conexion_bd->prepare($consulta))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("s",$id))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

//eliminar_personal('7');
//UPDATE `personal` SET `NombrePersonal` = 'Pol', `TelefonoPersonal` = '9678593', `CorreoPersonal` = 'pol@hotmail.com', `FechaInicioLaboral` = '2018-10-20', `FechaFinLaboral` = '2022-10-20' WHERE `personal`.`IdPersonal` = 4;

/*
INSERT INTO `donador` (`IdDonador`, `NombreDonador`, `TelefonoDonador`, `CorreoDonador`, `Donativo`, `Descripcion`, `Cuatrimestre1`, `Cuatrimestre2`, `Cuatrimestre3`, `Cuatri  stre4`) VALUES (NULL, 'Alan', '1234', 'Alan@hotmail.com', 'Hojas blanca', '1 paquete', '203', '100', '100', '1000');
      
 
*/
 /*funcion que actualiza la informacion de un donador atraves de su id con una consulta*/ 
function actualizar_donador($id, $nombre, $telefono, $correo,  $recurrente ) {
     
    $conexion_bd = conectar();
    
    $consulta = "UPDATE `donador` SET `NombreDonador` = ?,  `TelefonoDonador` = ?, `CorreoDonador` = ?, `Recurrente`=?   WHERE IdDonador = ?";
    
    if(!($statement = $conexion_bd->prepare($consulta))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("sssss",$nombre, $telefono, $correo,  $recurrente, $id))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

//actualizar_personal('10','CMLL','9678103', 'poke@hotmail.com', '11/11/20', '12/11/21');


// tabla archivo IdPersonal IdArchivo NombreArchivo LinkArchivo CreatedAt dd/MMM/yyyy HH:mm:ss  
/* posible expansion para generar la tabla de archivos al igual que el del Personal 
function tabla_archivo( $idpersona , $criterio= "" ) {
    
    $consulta = 'SELECT A.IdPersonal as IdPersonal, A.IdArchivo as IdArchivo, A.NombreArchivo as NombreArchivo, A.LinkArchivo as LinkArchivo, DATE_FORMAT(A.CreatedAt, "%d/%m/%Y %H:%i:%s") as CreatedAt ';
    $consulta .= ' FROM archivo A, personal P ';
 //   $consulta .= 'WHERE  t.Id = acusa.acusador_id AND s.Id = acusa.acusado_id';
    if($criterio != ""){
        $consulta .= 'WHERE  NombreArchivo LIKE "%'.$criterio.'%" OR LinkArchivo lIKE "%'.$criterio.'%" OR CreatedAt lIKE "%'.$criterio.'%" ';

    }
    $consulta .= 'WHERE  A.IdPersonal = P.IdPersonal AND P.IdDonador= '.$idpersona.' ';
    $consulta .= ' ORDER BY NombreArchivo ASC';
    //var_dump($consulta);
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
 //   var_dump($consulta);
    $resultado = '<table id="archivos" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>Nombre del archivo</th><th>Subido</th><tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) { 
        //$resultado .= '<td>'.$row["IdPersonal"].'</td>';
        $resultado .= '<td><a href="'.$row["LinkArchivo"].'" target= "_blank">' .$row["NombreArchivo"].'</a></td>';
       // $resultado .= '<td>'.$row["LinkArchivo"].'</td>';
        $resultado .= '<td>'.$row["CreatedAt"].'</td>';
       /* $resultado .= '<td>'. '<a class="btn btn-secondary" href="subirArchivo.php?file_id='.$row["IdArchivo"].'"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg></a>'.'</td>';

        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table><br>';
    
    desconectar($conexion_bd);
    return $resultado;
}
*/
/* Expansion para subir arhivos del donador
function insertar_archivo($id, $NombreArchivo, $LinkArchivo){
    $conexion_bd = conectar();
    // INSERT INTO `personal` (`IdPersonal`, `NombrePersonal`, `TelefonoPersonal`, `CorreoPersonal`, `Privilegio`, `FechaInicioLaboral`, `Contrato`, `Respaldo`) VALUES (NULL, 'Sebas', '9678523', 'seba@hotmail.com', '3', '12/10/20', NULL, NULL); `FechaInicioLaboral`, `FechaFinLaboral` , ?, ?  , $_POST['fechaicolab'], $_POST['fechafcolab']$fechaicolab, $fechafcolab
    $consulta ="INSERT INTO archivo (IdDonador,NombreArchivo, LinkArchivo) VALUES(?,?,?)";
    
    if(!($statement = $conexion_bd->prepare($consulta))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("sss",$id, $NombreArchivo, $LinkArchivo))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);


}*/

/*Funcion que genera el excel al llamarla atravez de una consulta los datos de los donadores*/
function generar_excel()
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
    $file = "Donadores_".date('Ymd').".xls"; //Nombre del Documento junto a la fecha en la que está siendo sacado con la extensión
  
    header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE;");
    header("Content-Disposition: attachment; filename=$file");
    
  
    $flag = false;
    $consulta = 'SELECT  D.NombreDonador as NombreDonador, D.TelefonoDonador as TelefonoDonador, D.CorreoDonador as CorreoDonador, D.Recurrente  as Recurrente  '; //, D.NumDonaciones as NumDonaciones
    $consulta .= ' FROM donador D ';
    $consulta .= ' ORDER BY NombreDonador ASC';

    //$consulta = 'SELECT * FROM personal';  //Aquí se hace la consulta que pasaremos a Excel
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

function limpiar_entradas() {
    if (isset($_GET["id"])) {
        $_GET["id"] = htmlspecialchars($_GET["id"]);
    }

    if (isset( $_POST["nombre"])) {
       $_POST["nombre"] = htmlspecialchars($_POST["nombre"]);
    }
    if (isset($_GET["nombre"])) {
        $_GET["nombre"] = htmlspecialchars($_GET["nombre"]);
    }

    if (isset( $_POST["nombre"])) {
       $_POST["nombre"] = htmlspecialchars($_POST["nombre"]);
    }

    if (isset($_GET["telefono"])) {
        $_GET["telefono"] = htmlspecialchars($_GET["telefono"]);
    }

    if (isset( $_POST["telefono"])) {
       $_POST["telefono"] = htmlspecialchars($_POST["telefono"]);
    }

    if (isset($_GET["correo"])) {
        $_GET["correo"] = htmlspecialchars($_GET["correo"]);
    }

    if (isset( $_POST["correo"])) {
       $_POST["correo"] = htmlspecialchars($_POST["correo"]);
    }

    if (isset($_GET["fechaicolab"])) {
        $_GET["fechaicolab"] = htmlspecialchars($_GET["fechaicolab"]);
    }

    if (isset( $_POST["fechaicolab"])) {
       $_POST["fechaicolab"] = htmlspecialchars($_POST["fechaicolab"]);
    }


    if (isset($_GET["fechafcolab"])) {
        $_GET["fechafcolab"] = htmlspecialchars($_GET["fechafcolab"]);
    }

    if (isset( $_POST["fechafcolab"])) {
       $_POST["fechafcolab"] = htmlspecialchars($_POST["fechafcolab"]);
    }   

    if (isset($_GET["nombreu"])) {
        $_GET["nombreu"] = htmlspecialchars($_GET["nombreu"]);
    }

    if (isset( $_POST["nombreu"])) {
       $_POST["nombreu"] = htmlspecialchars($_POST["nombreu"]);
    }

    if (isset($_GET["telefonou"])) {
        $_GET["telefonou"] = htmlspecialchars($_GET["telefonou"]);
    }

    if (isset( $_POST["telefonou"])) {
       $_POST["telefonou"] = htmlspecialchars($_POST["telefonou"]);
    }

    if (isset($_GET["correou"])) {
        $_GET["correou"] = htmlspecialchars($_GET["correou"]);
    }

    if (isset( $_POST["correou"])) {
       $_POST["correou"] = htmlspecialchars($_POST["correou"]);
    }

    if (isset($_GET["fechaicolabu"])) {
        $_GET["fechaicolabu"] = htmlspecialchars($_GET["fechaicolabu"]);
    }

    if (isset( $_POST["fechaicolabu"])) {
       $_POST["fechaicolabu"] = htmlspecialchars($_POST["fechaicolabu"]);
    }


    if (isset($_GET["fechafcolabu"])) {
        $_GET["fechafcolabu"] = htmlspecialchars($_GET["fechafcolabu"]);
    }

    if (isset( $_POST["fechafcolabu"])) {
       $_POST["fechafcolabu"] = htmlspecialchars($_POST["fechafcolabu"]);
    }   

}
//echo tabla_archivo();
//acusa(5,6);
//echo tabla_personal();
?>