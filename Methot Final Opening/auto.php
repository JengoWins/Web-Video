<?php
session_start();

if ($_SESSION['name']!=''){
    session_unset();
    session_destroy();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/Auto.css">
    <title>Document</title>
</head>
<body>
<div class="main">
    <div class="window-reg">
        <div class="REload">
            <a href="auto.php">Авторизация</a>
            <a href="index.php">Регистрация</a>
        </div>
        <h2>Авторизация</h2>
        <form action="bd-connect.php" method="post">
            <div class="inputs">
                <p><b>Никнейм</b></p>
                <input type="text" placeholder="Придумайте любое имя (не вписываете свои реальные данные)" name="name">
                <p><b>Пароль</b></p>
                <input type="password" placeholder="Введите пароль" name="password">
 		<button>Войти</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php
//Base
$database = "web-master_kurenkov";
//Server (alt from Colledj on study)
$server = "127.0.0.1";
$serverAlt = "localhost";
//user
$user = "root";
//password (alt analog server)
$password = "root";
$passwordAlt = '';

$connection = new PDO('mysql:host=localhost;dbname=web-master_kurenkov',$user,'');
// ----------------------------------------------------------------------------------------------------

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

if ($pass == $pass2){
    $connection->query("INSERT INTO users (`name`, `email`, `password`, `role`) VALUES ('$name','$email','$pass',0)");
}


?>
