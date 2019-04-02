<?php 
require '../db/db.php';
$id = $_GET['id'];
$item = R::load('items',$id);
$user = $_SESSION['logged_user']['name'];
$delete = "../images/items/".$_POST['old_picture'];

if ($user == '' || $user != $item['name']) {
    die('Access denied ! You do not have access rights !  <a href="../index.php">Home Page</a> ');
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta charset="UTF-8">
     <title>Change item</title>
     <link rel="stylesheet" type="text/css" href="../css/change.css">
 </head>
 <body>
    <div class="wrapper">
        <div class="change_img">
            <div class="img_box">
                <img src="../images/items/<?php echo $item['img'] ;?>" alt="IMG">
                <form class="img_change_form" action="change_item.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <p>Set new picture</p>
                    <textarea name="old_picture" class="hidden" readonly="readonly"><?php echo $item['img']; ?></textarea>
                    <input type="file" name="picture">
                    <input class="submit_change" type="submit" name="change_img" value="Save new picture">
                </form>
            </div>
        </div>
        <div class="change_info">
            <form action="change_item.php?id=<?php echo $id; ?>" method="POST">
                <p>About</p>
              <textarea class="about" name="about"><?php echo $item['about']; ?></textarea> 
              <p>Price</p>
              <textarea class="price" name="price"><?php echo $item['price']; ?> </textarea> AZN
              <p>Region</p>
              <select name="region">
                        <option selected><?php echo $item['region']; ?></option>
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
                </select>
              <p>Type</p>
              <select name="type">
                        <option selected ><?php echo $item['type']; ?></option>
                        <option>Canta</option>
                        <option>Ayaqabi</option>
                </select>
              <p>Color</p>
              <select name="color">
                        <option selected ><?php echo $item['color']; ?></option>
                        <option>Black</option>
                        <option>Purple</option>
                        <option>Blue</option>
                        <option>Green</option>
                        <option>Yellow</option>
                        <option>White</option>
                        <option>Gold</option>
                        <option>Silver</option>
                </select><br>
              <input class="submit_change" type="submit" name="change_info" value="Save new info">
            </form>
        </div>
    </div>
     
 </body>
 </html>
 <?php 
    if (isset($_POST['change_img'])) {
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
        unlink($delete);
        

        $item->img = $_FILES['picture']['name'];
        R::store($item);
        echo ' <script type="text/javascript">document.location.href = "change_item.php?id='.$id.'";</script>';
    }
if (isset($_POST['change_info'])) {
    $item->about = $_POST['about'];
    $item->price = $_POST['price'];
     $item->region = $_POST['region'];
      $item->type = $_POST['type'];
       $item->color =  $_POST['color'];
       R::store($item);
       echo ' <script type="text/javascript">document.location.href = "change_item.php?id='.$id.'";</script>';
}

  ?>

