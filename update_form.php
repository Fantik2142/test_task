<?php 
$host = 'localhost'; // адрес сервера 
$database = 'test_db'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

$conn = new mysqli($host, $user, $password, $database) //Подлючение к базе данных
or die ('Cannot connect to db');

$date_of_issue = $_POST['date_of_issue'];
$issued = $_POST['issued'];
$fio = $_POST['surname'].$_POST['name'].$_POST['middle_name'];
$passport_series = $_POST['passport_series'];
$passport_id = $_POST['passportid'];
$city = $_POST['city'];
$street = $_POST['street'];
$house_number = $_POST['house_number'];
$apartment = $_POST['apartment'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$date = date("d-m-Y");
if (isset($_POST['print_submit'])) {
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
//iconv("windows-1251", "UTF-8", $rtf);
$rtf=mb_convert_encoding($rtf, "Windows-1251", "utf8");
//var_dump($rtf);

header('Content-type: application/msword');
header('Content-Disposition: attachment; filename=survey_result.rtf');
echo $rtf;
die();



} else {

if(isset($_POST['delete'])) {
	//Изменение статуса на "Удален"
$res_id_delete = mysqli_query($conn, "SELECT id FROM `clients` WHERE passport_series = '$passport_series' AND Passport_id = '$passport_id'" ) or die("Ошибка " . mysqli_error($conn));
$row = mysqli_fetch_array($res_id_delete);
$id_delete = $row['id'];

//Выставление статуса ""
$result = mysqli_query($conn, "UPDATE `status` SET status = 'Удален' WHERE client_id = '$id_delete'" ) or die("Ошибка " . mysqli_error($conn1));
$result = mysqli_query($conn, "UPDATE `clients` SET status = 'Удален' WHERE id = '$id_delete'" ) or die("Ошибка " . mysqli_error($conn));
mysqli_close($conn);

echo "<script> alert('Пользователь удален!') </script>";
header("refresh:0;url=http://localhost/kinomonster/");


} else {
	//Обновление данных, которые можно изменить в форме
$res_id = mysqli_query($conn, "SELECT id FROM `clients` WHERE passport_series = '$passport_series' AND Passport_id = '$passport_id'" ) or die("Ошибка " . mysqli_error($conn));
$row = mysqli_fetch_array($res_id);
$id_update = $row['id'];

$result = mysqli_query($conn, "UPDATE `address` SET city = '$city', street = '$street', house_number = '$house_number', apartment = '$apartment' WHERE client_id = '$id_update' " ) or die("Ошибка " . mysqli_error($conn));

$result = mysqli_query($conn, "UPDATE `contact` SET phone_number = '$phone_number', email = '$email' WHERE client_id = '$id_update'" ) or die("Ошибка " . mysqli_error($conn));


echo "<script> alert('Данные успешно изменены!') </script>";
header("refresh:0;url=http://localhost/kinomonster/");
mysqli_close($conn);
	}
}

?>