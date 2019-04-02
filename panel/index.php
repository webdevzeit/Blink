<?php 
require '../db/db.php';
if (empty($_SESSION['logged_user'])) {
	echo '<script type="text/javascript">document.location.href = "../user/sign_in.php";</script>';
}
$user = $_SESSION['logged_user']->name;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/panel.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Panel</title>
</head>
<body>
	<div id="top_menu">
		<div class="top_menu_articles"><a href="add_item.php">Add new</a></div> 
		<div class="top_menu_articles"><a href="../models/profile_change.php">Profile</a></div>
		<div class="top_menu_articles"><a href="../user/sign_out.php">Exit</a></div>
	</div>
	<main>
		<section class="goods">
			<div class="container">
				<div class="row-between">
				<?php 
					$results =R::findLike( 'items', ['added' => $user]);
					 foreach($results as $item => $item_value){
					 	echo'<div class="goods-items">
					 	<div class="item_pic_box" ><img class="item_pic" src="../images/items/'.$item_value['img'].'" alt="image"></div>
					 	<br><div class="info_box"><p>About:</p>
							<div class="about"><p>'.$item_value['about'].'</p></div><br>
							<div class="info">
							<p>Region: '.$item_value['region'].'</p>
							<p>Type: '.$item_value['type'].'</p>
							<p>Color: '.$item_value['color'].'</p>
							<p>Price: '.$item_value['price'].' AZN</p>
							</div>
							<br>
							<div class="action_btn">
								<div class="change_btn">
								<div class="change_link">
									<form action="../models/change_item.php" method="GET">
										<textarea readonly="readonly" hidden="hidden"  name="id">'.$item_value['id'].'</textarea>
										<input class="change_link" value="Change" type="submit">
									</form>
								</div>
							</div>
							<div class="delete_btn">
								<div class="delete_link">
									<form action="../models/delete_item.php" method="POST">
										<textarea readonly="readonly" hidden="hidden"  name="id">'.$item_value['id'].'</textarea>
										<input class="delete_link" value="Delete" type="submit" name="delete">
									</form>
								</div>
							</div>
						</div>
						</div></div>
						
						' ;}
?>


				</div>
			</div>
		</section>
	</main>
</body>
</html>