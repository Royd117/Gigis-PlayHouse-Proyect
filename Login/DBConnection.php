<?php
//Cambiar dirección servidor
$servername = "websigner-db-mysql-do-user-8217587-0.b.db.ondigitalocean.com";
$username = "doadmin";
//configura password
$password = "gp7xci3jm2vh5wca";
$database = "GIGIS_DB";
// Create connection
$port= "25060";
$conn = mysqli_connect($servername, $username, $password, $database, $port);

/*$conexion_bd = mysqli_connect("websigner-db-mysql-do-user-8217587-0.b.db.ondigitalocean.com","doadmin","gp7xci3jm2vh5wca","GIGIS_DB","25060");*/
?>