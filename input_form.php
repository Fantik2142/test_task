<?php
$host = 'localhost'; // адрес сервера 
$database = 'test_db'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

$conn1 = new mysqli($host, $user, $password, $database) //Подключение к базе данных
or die ('Cannot connect to db');

$surname = $_POST['surname'];
$name = $_POST['name'];
$middle_name = $_POST['middle_name'];
$fio = $_POST['surname'].' '.$_POST['name'].' '.$_POST['middle_name'];
$passport_series = $_POST['passport_series'];
$passport_id = $_POST['passportid'];
$date_of_issue = $_POST['date_of_issue'];
$issued = $_POST['issued'];
$city = $_POST['city'];
$street = $_POST['street'];
$house_number = $_POST['house_number'];
$apartment = $_POST['apartment'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$date = date("d-m-Y");


if (isset($_POST['print_submit'])) {
//Автозаполняем шаблон договора
	$rtf= file_get_contents('assets/dogovor.rtf');
	$rtf = str_replace("city", $city, $rtf);
	$rtf = str_replace('fio', $fio, $rtf);
	$rtf = str_replace('series', $passport_series, $rtf);
	$rtf = str_replace('passport', $passport_id, $rtf);
	$rtf = str_replace('vidan', $issued, $rtf);
	$rtf = str_replace('issued', $date_of_issue, $rtf);
	$rtf = str_replace('street', $street, $rtf);
	$rtf = str_replace('number', $house_number, $rtf);
	$rtf = str_replace('appart', $apartment, $rtf);
	$rtf = str_replace('phone', $phone_number, $rtf);
	$rtf = str_replace('date', $date, $rtf);
	$rtf=mb_convert_encoding($rtf, "Windows-1251", "utf8");

	header('Content-type: application/msword');
	header('Content-Disposition: attachment; filename=dogovor.rtf');
	die();



} else {


//Проверяем существование клиента
$result4 = mysqli_query($conn1, "SELECT * FROM `clients` WHERE passport_series = '$passport_series' AND Passport_id = '$passport_id' ");
if ($result4->num_rows > 0) {
	echo "<script> alert('Клиент с такими паспортными данными уже существует!') </script>";
	header("refresh:0;url=http://localhost/kinomonster/");
} else {

//Создаем пользователя в 'clients'
$result = mysqli_query($conn1, "INSERT INTO `clients` VALUES (NULL, '$surname', '$name', '$middle_name', '$fio', '$passport_series', '$passport_id', '$date_of_issue', '$issued', NULL, 'Активен')") or die("Ошибка " . mysqli_error($conn1));
mysqli_close($conn1);


$conn2 = new mysqli($host, $user, $password, $database) 
or die ('Cannot connect to db');

$query_id = mysqli_query($conn2, "SELECT id FROM `clients` WHERE passport_series = '$passport_series'");
$row = mysqli_fetch_array($query_id);
$id = $row['id'];
//Создаем пользователя в 'status'
$result1status = mysqli_query($conn2, "INSERT INTO `status` VALUES (NULL, '$id', 'Активен')") or die("Ошибка " . mysqli_error($conn2));
//Создаем пользователя в 'contact'
$result2contact = mysqli_query($conn2, "INSERT INTO `contact` VALUES (NULL, '$id', '$phone_number', '$email')") or die("Ошибка " . mysqli_error($conn2));
//Создаем пользователя в 'address'
$result3address = mysqli_query($conn2, "INSERT INTO `address` VALUES (NULL, '$id', '$city', '$street', '$house_number', '$apartment')") or die("Ошибка " . mysqli_error($conn2));

};
}

mysqli_close($conn2);

?>