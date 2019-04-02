<?php 
	require '../db/db.php';
	unset($_SESSION['logged_user']);
	header('Location: /');
?>
