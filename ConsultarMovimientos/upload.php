<?php

require_once("php/model.php");



if(isset($_POST['save'])){
	$idpersona=$_POST['idarchivo'];
	$nombrea= $_POST['nombrea']; 

	$filename= date_timestamp_get(date_create()).$_FILES['myfile']['name'];

	$destination='uploads/'.$filename;

	$extension=pathinfo($filename, PATHINFO_EXTENSION);

	$file=$_FILES['myfile']['tmp_name'];

	$size=$_FILES['myfile']['size'];

	if(!in_array($extension, ['zip', 'pdf','png'])){
	
		echo "La extension de tu archivo debe ser .zip, .pdf o .png";

	}
	elseif($_FILES['myfile']['size']> 1000000){

		echo "El archivo es muy grande";

	}
	else{
		if(move_uploaded_file($file, $destination)){

			insertar_archivo($idpersona, $nombrea, $destination);

		}
	}


}


if(isset($_GET['file_id'])){
	$idfile=$_GET['file_id'];

	$sql="SELECT * FROM archivo WHERE IdArchivo=$idfile";
	$result=mysqli_query($conn,$sql);

	$file=mysqli_fetch_assoc($result);

	$filepath='uploads/'.$file['name'];

	if(file_exists($filepath)){
		header('Content-Type: application/octet-stream');
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename='. basename($filepath));

		header('Expires: 0');

		header('Cache-Control: must-revalidate');
		header('Pragma:public');

		header('Content-Length:'. filesize('uploads/'.$file['name']));

		readfile('uploads/'.$file['name']);

		mysqli_query($conn,$updatQuery);
		exit;

	}

}
//desconectar($conn);
//insertar_archivo($_POST['nombre'], $_POST['telefono'], $_POST['correo']);

//echo tabla_archivo();
header("location: subirArchivos.php?id=$idpersona");
//header('location: ../index.php');


?>