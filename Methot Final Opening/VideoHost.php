<?php
session_start();
$bd = "web-master_kurenkov";
$user = "root";
$host = "localhost";

$connection = new PDO('mysql:host=localhost;dbname=web-master_kurenkov',$user,'');
$MySql = $connection->prepare("SELECT * FROM users");
$MySql->execute();
$MySqlUser= $MySql->fetchAll(PDO::FETCH_ASSOC);
print_r($MySql);

$users;

foreach($MySqlUser as $use){
    if($use['name'] == $_SESSION['name']){
        $users=$use['id'];
    }
}

$category = $connection->prepare("SELECT * FROM category");
$category->execute();
$category= $category->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/Style_User.css">
	<title>Videos</title>
</head>
<body>

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

            </div>
        </header>
    <form enctype="multipart/form-data" action="" method="POST">
	<div class="Info">
        <div class="Zav">
            <div class="Aa"><h3>Форма добавления видео</h3></div>
            <hr>
            <p>Описание</p>
            <textarea name="descript" id="" cols="40" rows="10" style="resize: none"></textarea><br>
            <select name="select" id="">
                <?php
                foreach($category as $cat){
                    $number = $cat['id'];
                    $name_cat= $cat['name_category'];
                    echo "<option value='$number'>".$name_cat."</option>";
                }
                ?>
            </select><br><br>
            <input type="file" name="files" id="files">
            <br>
            <br>
            <button>Добавить</button>
        </div>
    </div>
    </form>

     
</body>
</html>

<?php
//echo $_SESSION['name'];
print_r($_FILES);
//echo $_FILES['files']['name'];
echo "<br><br>";
print_r($_POST);

$path = "videos/";
$updateFile = $path.basename($_FILES['files']['name']);


echo $users."<br>";
$select = $_POST['select'];
echo $select."<br>";
$name = basename($_FILES['files']['name']);
echo $name."<br>";
$des = $_POST['descript'];
echo $des."<br>";
$date=date('Y-m-d');
echo $date."<br>";
$file=$_FILES['files']['type'];

//echo $updateFile;
/*
if (is_uploaded_file($_FILES['files']['tmp_name'])) {
    echo "Файл ". $_FILES['files']['name'] ." успешно загружен.\n";
} else {
    echo "Возможная атака с участием загрузки файла: ";
    echo "файл '". $_FILES['files']['tmp_name'] . "'.";
}
*/
if(move_uploaded_file($_FILES['files']['tmp_name'],$updateFile)){
    echo "<p>Файл загружен</p>";
    $connection->query("INSERT INTO `cartoon`(`id_user`,`id_category`,`name_vadeo`,`description`,`file`, `date`,`count_plus`,`count_mines`,`private`) VALUES ($users,$select,'$name','$des','$file','$date',0,0,0)");
}else{
    echo "<p>Упс... Похоже файл не загружен</p>";
}
?>