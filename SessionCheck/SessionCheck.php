<?php
	if(!isset($_SESSION['Role'])) {
		header("Location: ../Login/IndexL.php");
	}
?>