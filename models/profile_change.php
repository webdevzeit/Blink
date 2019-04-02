<?php 
require '../db/db.php';
$user = $_SESSION['logged_user']['name'];
$item = R::findOne('users',' name = ? ',array($user));
$delete = "../images/userpic/".$_POST['old_picture'];

if ($user == '' || $user != $item['name']) {
  var_dump($item);
    die('Access denied ! You do not have access rights !  <a href="../index.php">Home Page</a> ');
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta charset="UTF-8">
     <title>Change profile</title>
     <link rel="stylesheet" type="text/css" href="../css/change.css">
 </head>
 <body>
    <div class="wrapper">
        <div class="change_img">
            <div class="img_box">
                <img src="../images/userpic/<?php echo $item['userpic'] ;?>" alt="IMG">
                <form class="img_change_form" action="profile_change.php" method="POST" enctype="multipart/form-data">
                    <p>Set new picture</p>
                    <textarea name="old_picture" class="hidden" readonly="readonly"><?php echo $item['img']; ?></textarea>
                    <input type="file" name="picture">
                    <input class="submit_change" type="submit" name="change_img" value="Save new picture">
                </form>
            </div>
        </div>
        <div class="change_info">
            <form action="profile_change.php" method="POST">
               <p>Name</p>
               <textarea name="name" class="user_info"><?php echo $item['name']; ?></textarea>
               <p>Email</p>
               <textarea name="email" class="user_info"><?php echo $item['email']; ?></textarea>
               <p>Workphone</p>
               <textarea name="workphone" class="user_info"><?php echo $item['workphone']; ?></textarea>
               <p>Mobilephone</p>
               <textarea name="mobilephone" class="user_info"><?php echo $item['mobilephone']; ?></textarea>
               <p>Address</p>
               <textarea name="address" class="user_info"><?php echo $item['address']; ?></textarea>
              <input class="submit_change" type="submit" name="change_info" value="Save new info">
            </form>
        </div>
    </div>
     
 </body>
 </html>
 <?php 
    if (isset($_POST['change_img'])) {
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
        unlink($delete);
        

        $item->userpic = $_FILES['picture']['name'];
        R::store($item);
        echo ' <script type="text/javascript">document.location.href = "profile_change.php";</script>';
    }
if (isset($_POST['change_info'])) {
    $item->name = $_POST['name'];
    $item->email = $_POST['email'];
     $item->workphone = $_POST['workphone'];
      $item->mobilephone = $_POST['mobilephone'];
       $item->address =  $_POST['address'];
       R::store($item);
       echo ' <script type="text/javascript">document.location.href = "profile_change.php";</script>';
}

  ?>

