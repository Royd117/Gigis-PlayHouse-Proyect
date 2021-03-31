<?php
	session_start();
	include("Login.html");
	if(isset($_SESSION['Login']) && $_SESSION['Login']==false)
	if($_SESSION['Login']==false)
		include("Error.html");
	include("Footer.html");
	$_SESSION['Login']=True;
?>