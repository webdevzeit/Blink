<?php require 'db/db.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blink</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

		<div class="logo"><a href="/">Blink</a></div>
		<div class="menu">
		<?php 
		if(empty($_SESSION['logged_user'])){
			echo '<div class="menu_link"><a href="/user/sign_in.php">Sign in</a></div><div class="menu_link"><a href="/user/sign_up.php">Sing Up</a></div>';
		}else{
			echo '<div class="menu_link"><a href="/panel/index.php">Panel</a></div><div class="menu_link"><a href="/user/sign_out.php">Exit</a></div>';
		}

		 ?>
		</div>
		<form class="filtr" action="result.php" method="GET">
					<select name="region">
						<option selected disabled>Region</option>
						<option>Absheron</option>
						<option>Agcabedli</option>
						<option>Astara</option>
						<option>Lenkeran</option>
						<option>Xirdalan</option>
						<option>Yasamal</option>
						<option>Nizami</option>
						<option>Qax</option>
						<option>Zaqatala</option>
						<option>Balaken</option>
						<option>Xudat</option>
						<option>Xudat</option>
					</select><br>
					<select name="type">
						<option selected disabled>Tip</option>
						<option>Canta</option>
						<option>Ayaqabi</option>
					</select><br>
					<select name="color">
						<option selected disabled>Reng</option>
						<option>Black</option>
						<option>Purple</option>
						<option>Blue</option>
						<option>Green</option>
						<option>Yellow</option>
						<option>White</option>
						<option>Gold</option>
						<option>Silver</option>
					</select><br><br>
					<input class="button_1" type="submit" name="searchgo" value="Search">
			</form>
		</div>
</body>
</html>