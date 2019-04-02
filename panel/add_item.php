<?php 
	require '../db/db.php';
	$data=$_POST;
		$login = $_SESSION['logged_user']->name;
	if (empty($login)) {
		echo '<script type="text/javascript">document.location.href = "../user/sign_in.php";</script>';
	}
	$itempic = $_FILES['picture']['name'];

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Item</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/add_item.css">
</head>
<body>
	<div class="menu"><a href="index.php">Panel</a></div>
		<div class="search_fild_form">
			<form method="POST" action="add_item.php" enctype="multipart/form-data" >
				<input name="picture" type="file"><br>
				<input type="text" name="price" placeholder="Price"><br>
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
					</select><br>
					<p>About to item</p>
					<textarea class="about" name="about" placeholder="Your text where"></textarea><br><br>

					<input class="button_1" type="submit" name="add" value="Add">
					<textarea class="hidden" name="author"><?php echo $login ?></textarea>
				</form>
		</div>
		<?php 
		if (isset($_POST['add'])) {
		$items = R::dispense('items');
		$items->img=$itempic;
		$items->region=$data['region'];
		$items->type=$data['type'];
		$items->color=$data['color'];
		$items->price=$data['price'];
		$items->about=$data['about'];
		$items->added=$data['author'];
		R::store($items);
		
		// Пути загрузки файлов
$path = '../images/items/';
$tmp_path = 'tmp/';
// Массив допустимых значений типа файла
$types = array('image/gif', 'image/png', 'image/jpeg');
// Максимальный размер файла
$size = 1024000;

// Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 // Проверяем тип файла
 if (!in_array($_FILES['picture']['type'], $types))
  die('Запрещённый тип файла. <a href="?">Попробовать другой файл?</a>');

 // Проверяем размер файла
 if ($_FILES['picture']['size'] > $size)
  die('Слишком большой размер файла. <a href="?">Попробовать другой файл?</a>');

 // Загрузка файла и вывод сообщения
 if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
  echo 'Что-то пошло не так';
}
}

		 ?>
</body>
</html>