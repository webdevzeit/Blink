<?php 
	require '../db/db.php';
	$author = $_GET['author'];
	$result = R::findOne('users','name = ?',array($author));
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>View profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/view_item.css">
</head>
<body>
<div class="wrapper">
		<div class="img_box">
			<img src="../images/userpic/<?php echo $result['userpic'] ; ?>" alt="Art">
		</div>
		<div class="info">
					<p>Name: <?php echo $result['name'] ; ?></p>
					<p>Email: <?php echo $result['email'] ; ?></p>
					<p>Address: <?php echo $result['address']  ; ?></p>
					<p>Workphone: <?php echo $result['workphone'] ; ?></p>
					<p>Mobilephone: <?php echo $result['mobilephone'] ; ?></p>
	</div>
</body>
</html>