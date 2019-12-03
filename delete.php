
<?php

$id = $_POST['varsel'];

$host = 'localhost'; // адрес сервера 
$database = 'test_db'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

$conn1 = new mysqli($host, $user, $password, $database) 
or die ('Cannot connect to db');

$result = mysqli_query($conn1, "UPDATE `status` SET status = 'Удален' WHERE client_id = '$id'" ) or die("Ошибка " . mysqli_error($conn1));
$result = mysqli_query($conn1, "UPDATE `clients` SET status = 'Удален' WHERE id = '$id'" ) or die("Ошибка " . mysqli_error($conn1));
mysqli_close($conn1);

echo "<script> alert('Пользователь удален!') </script>";
header("refresh:0;url=http://localhost/kinomonster/");
?>