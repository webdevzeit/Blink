<?php require '../db/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="../css/sign.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php 
    if($_SESSION['logged_user'] == ''){
    echo '
            <div class="log_box">
                    <form action="sign_in.php" method="POST">
                        <div>
                            <input type="login" name="login" placeholder="Ввидите логин"><br>
                            <input type="password" name="password"  placeholder="Ввидите пароль"><br>
                            <input id="button_submit" type="submit" value="Войти"  name="sign_in" ><br>
                            <a style="text-decoration: none; color:purple;" href="sign_up.php">Sign Up</a>

                        </div>
                    </form>
                </div>
                ';
    }else{
echo '
                            <script type="text/javascript">document.location.href = "../panel/index.php";</script>';
}
 $data = $_POST;
    if ( isset($data['sign_in']) )
{
    if (empty($data['login'])) {
        $errors[] = 'Поле логина пусто';
    }
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if ($user)
    { 
        if(password_verify($data['password'], $user->password))
            {
                $_SESSION['logged_user'] = $user;
           echo '
                            <script type="text/javascript">document.location.href = "../panel/index.php";</script>';
        }else
        {
            $errors[] = 'Неверно введен пароль!';
        }
 
    }else
    {
        $errors[] = 'Пользователь с таким логином не найден!';
    }
    if ( ! empty($errors) )
    {
           echo             '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
    }
}
        ?>
  
</body>
</html>
