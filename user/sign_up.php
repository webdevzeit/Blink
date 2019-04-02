<?php 
	require '../db/db.php';
	$data = $_POST;
	$userpic = $_FILES['picture']['name'];



 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../css/sign.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<form class="sign_up_form" method="POST" action="sign_up.php" enctype="multipart/form-data">
		<h5>Download you picture</h5>
		<input name="picture" type="file"><br>
		<input type="text" name="name" placeholder="Name"><br>
		<input type="text" name="login" placeholder="Login"><br>
		<input type="password" name="password" placeholder="Password"><br>
		<input type="password" name="password_2" placeholder="Password again"><br>
		<input type="mail" name="email" placeholder="@email"><br>
		<input type="text" name="address" placeholder="Address"><br>
		<input type="text" name="workphone" placeholder="Work Phone"><br>
		<input type="text" name="mobilephone" placeholder="Mobile Phone"><br>
		<input id="button_submit" type="submit" name="sign_up" value="Sign Up">
	</form>
</body>
</html>
<?php 

if( isset($data['sign_up']) )
{
	//здесь делаем проверки на пустоту логина
	$errors = array();
	if (trim($data['login']) =='') {
		$errors[] = 'Введите логин !';
	}
	
	if ($data['email'] =='') {
		$errors[] = 'Введите email !';
	}
	if ($data['password'] =='') {
		$errors[] = 'Введите пароль !';
	}
	if ($data['password_2'] !=$data['password']) {
		$errors[] = 'Пароли не одинаковы !';
	}
  // исключаем два одинаковых мейла
	if (R::count('users', "login = ?", array($data['login']))>0)
	{
		$errors[] = 'Пользователь с таким Логином существует !';
	}
	if (R::count('users', "email = ?", array($data['email']))>0)
	{
		$errors[] = 'Пользователь с таким Email существует !';
	}
	//здесь регистрируем
	if (empty($errors)) 
	{
	// все хорошо, регисирируем в Базе Данных
	// Ред Бин исключает SQL иньекции
		$user = R::dispense('users');
		$user->userpic=$userpic;
		$user->name=$data['name'];
		$user->login=$data['login'];
		$user->email=$data['email'];
		$user->password= password_hash($data['password'], PASSWORD_DEFAULT);
		$user->address=$data['address'];
		$user->workphone=$data['workphone'];
		$user->mobilephone=$data['mobilephone'];
		$user->email=$data['email'];

		$user->join_date=time();
		R::store($user);
		echo '<div style = "color: green;">Вы успешно зарегистрированы! </div><hr>';
	} else 
	{
		echo'<div id="errors">'.array_shift($errors). '</div><hr>';
	}


// Пути загрузки файлов
$path = '../images/userpic/';
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