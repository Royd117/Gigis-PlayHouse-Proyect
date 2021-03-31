<?php
session_start(); 
require_once("php/model.php");



if(isset($_POST['save'])){
	$idpersona=$_POST['idarchivo'];
	$nombrea= $_POST['nombrea']; 

	$filename= date_timestamp_get(date_create()).$_FILES['myfile']['name'];

	$destination='uploads/'.$filename;

	$extension=pathinfo($filename, PATHINFO_EXTENSION);

	$file=$_FILES['myfile']['tmp_name'];

	$size=$_FILES['myfile']['size'];

	if(!in_array($extension, ['zip', 'pdf','png' ,'jpg'])){
	
		$_SESSION['formato_archivo']=true;

	}
	elseif($_FILES['myfile']['size']> 1000000){

		$_SESSION['tamano_archivo']=true;

	}
	else{
		$_SESSION['exito_archivo']=true;
		if(move_uploaded_file($file, $destination)){

			insertar_archivo($idpersona, $nombrea, $destination);

		}
		
	}


}


//desconectar($conn);
//insertar_archivo($_POST['nombre'], $_POST['telefono'], $_POST['correo']);

//echo tabla_archivo();
header("location: subirArchivos.php?id=$idpersona");
//header('location: ../index.php');


?>