<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/Reg.css">
    <title>Registration</title>
</head>
<body>
<div class="main">
    <div class="window-reg">
        <div class="REload">
            <a href="auto.php">Авторизация</a>
            <a href="index.php">Регистрация</a>
        </div>
        <h2>Регистрация</h2>
        <form action="auto.php" method="post">
            <div class="inputs">
                <p><b>Никнейм</b></p>
                <input type="text" placeholder="Придумайте любое имя (не вписываете свои реальные данные)" name="name" required>
                <p><b>Почта</b></p>
                <input type="email" placeholder="почта" name="email" required>
                <p><b>Пароль</b></p>
                <input type="password" placeholder="Введите пароль" name="pass" required>
                <p><b>Проверка ввода пароля</b></p>
                <input type="password" placeholder="Проверьте совпадение" name="pass2" required>
                <button>Зарегистрироваться</button>
            </div>

        </form>
    </div>
</div>
</body>
</html>

