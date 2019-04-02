<?php
require 'libs/rb.php';

R::setup( 'mysql:host=localhost;dbname=blink',
    'root', '' ); //Подключение к базе
session_start();
 ?>