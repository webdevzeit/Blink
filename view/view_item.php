<?php 
	require '../db/db.php';
	$getid = $_GET['item'];
	$item  = R::load( 'items', $getid);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Item</title>
	<link rel="stylesheet" type="text/css" href="../css/view_item.css">
</head>
<body>
	<div class="wrapper">
		<div class="img_box">
			<img src="../images/items/<?php echo $item['img'] ; ?>" alt="Art">
		</div>
		<div class="info">
					<p>Region: <?php echo $item['region'] ; ?></p>
					<p>Type: <?php echo $item['type'] ; ?></p>
					<p>Color: <?php echo $item['color']  ; ?></p>
					<p>Price: <?php echo $item['price'] ; ?> AZN</p>
					<p>About: <?php echo $item['about'] ; ?></p>
					<p>Author: <a href="view_profile.php?author=<?php echo $item['added'] ; ?>"><?php echo $item['added']; ?></a></p>
		</div>
	</div>
</body>
</html>