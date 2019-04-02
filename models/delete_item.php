<?php 
	require '../db/db.php';
	
	$delete = R::load('items',$_POST['id']);
	$img = $delete['img'];
	$path = "../images/items/".$img;
	if ($_SESSION['logged_user']['name'] != $delete['added']) {
		echo "Acces denied !";
	}else{
		if(empty($_POST['id'])){
		echo "Please check you getting";
	}else{
		unlink($path);
		R::trash($delete);
		echo ' <script type="text/javascript">document.location.href = "../panel/index.php";</script>';
	}
	}
	?>
	
	