<?php
//Base
session_start();
$database = "web-master_kurenkov";
//Server (alt from Colledj on study)
$server = "127.0.0.1";
$serverAlt = "localhost";
//user
$user = "root";
//password (alt analog server)
$password = "root";
$passwordAlt = "";

$connection = new PDO('mysql:host=localhost;dbname=web-master_kurenkov',$user,'');
// ----------------------------------------------------------------------------------------------------
if ($_SESSION['name'] != ""){
    $name = $_SESSION['name'];
    $MySQL1 = $connection->prepare("SELECT * FROM users where name = :name");
    $MySQL1->execute(array('name'=>$name));
    $MySQL1=$MySQL1->fetchAll(PDO::FETCH_ASSOC);


}else{
    $name = $_POST['name'];
    $MySQL1 = $connection->prepare("SELECT * FROM users where name = :name");
    $MySQL1->execute(array('name'=>$name));
    $MySQL1=$MySQL1->fetchAll(PDO::FETCH_ASSOC);
    if($MySQL1[0]['name'] == $name){
        $_SESSION['name'] = $name;
    }
}

$VideoSql = $connection->prepare("SELECT `id_user`,`id_category`,`name_vadeo`,`description`,`date`,`count_plus`,`count_mines`,`private` FROM `cartoon`");
$VideoSql->execute();
$Video = $VideoSql->fetchAll(PDO::FETCH_ASSOC);
$countUser=count($MySQL1);
$countVideo = count($Video);


$category = $connection->prepare("SELECT * FROM category");
$category->execute();
$category= $category->fetchAll(PDO::FETCH_ASSOC);
$countCategory=count($category);

print_r($MySQL1);echo "<br><br>";
print_r($Video);echo "<br><br>";
print_r($category);


if($MySQL1[0]['role'] == 0){
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/Style_User.css">
	<title>Профиль</title>
	</head>
	<body>
    <div class="main">
        <header>
            <div class="logo">
                <img src="img/i.jpg" alt="">
            </div>


            <div class="buttons-auto">
                <a href="index.php">Авторизация</a>
                <a href="auto.php">Регистрация</a>
            </div>
            <div class="buttons-exit">
                <a href="auto.php">Выход</a>
                <a href="VideoHost.php">Видеохостинг</a>
                <a href="bd-connect.php">Профиль</a>
                <a href="main.php">Главная страница</a>
            </div>
        </header>


            <h2 style="text-align: center" >Ваши персональные данные</h2>
            <div class="profit">
                <div class="Images"><img src="img/img1.jpg" alt=""></div>
                <div class="Text">
                    <?php
                    foreach($MySQL1 as $mip){
                        if ($name == $mip['name']){
                            echo "<p class='Sillet'><b>Логин: </b>".$mip['name']."</p>";
                            echo "<p><b>Почта: </b>".$mip['email']."</p>";
                            echo "<p class='Sillet'><b>Роль: </b>".$mip['role']."</p><br>";
                        }
                    }
                    ?>
                </div>
        </div>

 <?php
                        //echo "<p>$Video[0][0]</p>";

for($i=0;$i<$countUser;$i++){
    for ($s=0; $s < $countVideo; $s++) {
        if($MySQL1[$i]['id'] == $Video[$s]['id_user']){
            $src = "videos/".$Video[$s]['name_vadeo'];
            $name = $Video[$s]['name_vadeo'];
            $ost = $Video[$s]['description'];
            echo "
                 <div class='Info'>
                    <div class='Zav'>
                        <div class='Aa'><h3>$name</h3></div>
                        <hr>
                        <div class='Text_Info'>
                            <div class='ImgInfos'>
                                <video width='400' height='300' controls>
                                    <source src='$src' type='video/mp4'>
                                </video>
                            </div>
                    <div class='TextInfos'>
                        <p>$ost</p>
                    </div>
                </div>
                <br>
                <p><b>Категория: </b>
            ";
             for($g=0;$g<$countCategory;$g++){
                   for ($d=0; $d < $countVideo; $d++) {
                        if($category[$g]['id'] == $Video[$d]['id_category']){
                        $mip = $category[$g]['name_category'];
                        echo $mip;
                        //echo 'jbavbaoibv';
                    }
                   }
                }
                $mips = $MySQL1[$i]['name'];
                $date1 = $Video[$s]['date'];
            echo "</p>
             <p><b>Автор: $mips</b></p>
              <p><b>Дата: $date1</b></p>
                </div>
            </div>
        </div>";
            }
        }
    }
?>
  </div>
</body>
</html>

<?php
}else if($MySQL1[0]['role'] == 1){
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/Style_User.css">
    <title>Профиль</title>
    </head>
    <body>
    <div class="main">
        <header>
            <div class="logo">
                <img src="img/i.jpg" alt="">
            </div>


            <div class="buttons-auto">
                <a href="index.php">Авторизация</a>
                <a href="auto.php">Регистрация</a>
            </div>
            <div class="buttons-exit">
                <a href="auto.php">Выход</a>
                <a href="VideoHost.php">Видеохостинг</a>
                <a href="bd-connect.php">Профиль</a>
                <a href="main.php">Главная страница</a>
            </div>
        </header>


            <h2 style="text-align: center" >Ваши персональные данные</h2>
            <div class="profit">
                <div class="Images"><img src="img/img1.jpg" alt=""></div>
                <div class="Text">
                    <?php
                    foreach($MySQL1 as $mip){
                        if ($name == $mip['name']){
                            echo "<p class='Sillet'><b>Логин: </b>".$mip['name']."</p>";
                            echo "<p><b>Почта: </b>".$mip['email']."</p>";
                            echo "<p class='Role_Admin'><b>Роль: </b>".$mip['role']."</p><br>";
                        }
                    }
                    ?>
                </div>
        </div>



 <?php
                        //echo "<p>$Video[0][0]</p>";

for($i=0;$i<$countUser;$i++){
    for ($s=0; $s < $countVideo; $s++) {
        if($MySQL1[$i]['id'] == $Video[$s]['id_user']){
            $src = "videos/".$Video[$s]['name_vadeo'];
            $name = $Video[$s]['name_vadeo'];
            $ost = $Video[$s]['description'];
            echo "
                 <div class='Info'>
                    <div class='Zav'>
                        <div class='Aa'><h3>$name</h3></div>
                        <hr>
                        <div class='Text_Info'>
                            <div class='ImgInfos'>
                                <video width='400' height='300' controls>
                                    <source src='$src' type='video/mp4'>
                                </video>
                            </div>
                    <div class='TextInfos'>
                        <p>$ost</p>
                    </div>
                </div>
                <br>
                <p><b>Категория: </b>
            ";
             for($g=0;$g<$countCategory;$g++){
                   for ($d=0; $d < $countVideo; $d++) {
                        if($category[$g]['id'] == $Video[$d]['id_category']){
                        $mip = $category[$g]['name_category'];
                        echo $mip;
                        //echo 'jbavbaoibv';
                    }
                   }
                }
                $mips = $MySQL1[$i]['name'];
                $date1 = $Video[$s]['date'];
            echo "</p>
             <p><b>Автор: $mips</b></p>
              <p><b>Дата: $date1</b></p>
                </div>
            </div>
        </div>";
            }
        }
    }
?>

</body>
</html>

<?php
}
?>