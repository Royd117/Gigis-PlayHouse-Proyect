<?php  
session_start();
$usernamel=$_POST["user"];
$passwordl=$_POST["userpassword"];

require_once("DBConnection.php");
//$consulta="select * from personal where CorreoPersonal='$username' and ContrasenaPersonal = '$password'";
$consulta="SELECT * FROM personal WHERE CorreoPersonal = '".$usernamel."' AND ContrasenaPersonal = '".$passwordl."'";
$result = mysqli_query($conn, $consulta);

$row = mysqli_fetch_array($result);
if($row["CorreoPersonal"] == $usernamel && $row["ContrasenaPersonal"]== $passwordl && $row["RolPersonal"]!= "Ninguno")
{
	 $_SESSION['Personal'] = $row["IdPersonal"];
	 $_SESSION['Nombre'] = $row["NombrePersonal"];
	 $_SESSION['Role'] = $row["RolPersonal"];
	 $_SESSION['eliminado']=false; 
	 $_SESSION['actualizado']=false;
	 $_SESSION['formato_archivo']=false;
     $_SESSION['tamano_archivo']=false;
     $_SESSION['exito_archivo']=false;
     $_SESSION['eliminado_donador']=false; 
     $_SESSION['actualizado_donador']=false;

	 header("Location: ../Home_Screen/IndexH.php");

}

else
{
	$_SESSION["Login"]=False;

	header("Location: IndexL.php");
}

?>