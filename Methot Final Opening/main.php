<?php
$connection = new PDO('mysql:host=localhost;dbname=web-master_kurenkov','root','');

if ($_SESSION['name'] != ""){
    $MySQL1 = $connection->prepare("SELECT * FROM users");
    $MySQL1->execute();
    $MySQL1=$MySQL1->fetchAll(PDO::FETCH_ASSOC);

    $name = $_SESSION['name'];
}else{
    $MySQL1 = $connection->prepare("SELECT * FROM users");
    $MySQL1->execute();
    $MySQL1=$MySQL1->fetchAll(PDO::FETCH_ASSOC);

    $name = $_POST['name'];
    $_SESSION['name'] = $name;
//print_r($MySQL1);
//echo "<br>";
//echo "<br>";
//print_r($_POST);
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

if(isset($_POST['delete'])){
    $str = htmlspecialchars(trim($_POST['delete']));
    $adob = $connection->prepare("DELETE FROM `cartoon` where `name_vadeo`=?");
    $adob->execute([$str]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="css/Style_User.css">
	<title>Главное меню</title>
</head>
<body>
<form action="" method="POST">
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




<?php
                        //echo "<p>$Video[0][0]</p>";

for($i=0;$i<$countUser;$i++){
    for ($s=0; $s < $countVideo; $s++) {
        if($MySQL1[$i]['id'] == $Video[$s]['id_user']){
            $src = "videos/".$Video[$s]['name_vadeo'];
            $name = $Video[$s]['name_vadeo'];
            $ost = $Video[$s]['description'];
            //$value =
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
                    }
                   }
                }
                $mips = $MySQL1[$i]['name'];
                $date1 = $Video[$s]['date'];
            echo "</p>
             <p><b>Автор: $mips</b></p>
              <p><b>Дата: $date1</b></p>
               <br>
               <input type='hidden' name='delete' value='$name'>
               <button>Удалить</button>
                </div>
            </div>";
            }
        }
    }

    print_r($_POST);
?>

</div>
</form>
</body>
</html>