<?php 
	require 'db/db.php';
	$region = $_GET['region'];
	$type = $_GET['type'];
	$color = $_GET['color'];
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/result.css">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Result</title>
</head>
<body>
	<main>
		<section class="goods">
			<div class="container">
				<div class="row-between">
				<?php 
					$results =R::findLike( 'items', ['region' => $region,'type' => $type,'color' => $color],' ORDER BY id DESC LIMIT 40 ');
					 foreach($results as $item => $item_value){
					 	echo'<div class="goods-items">
					 	<div class="item_pic_box" ><img class="item_pic" src="/images/items/'.$item_value['img'].'" alt="image"></div>
					 	<br>
					 	<div class="bot_panel">
					 	<div class="author" ><a href="view/view_item.php?item='.$item_value['id'].'">View</a></div>
						<div class="price">'.$item_value['price'].' AZN</div>
						</div>
						</div>
						
						' ;}
?>


				</div>
			</div>
		</section>
	</main>
</body>
</html>