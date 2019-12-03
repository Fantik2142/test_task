<?php
$id = $_POST['varsel'];


$host = '127.0.0.1'; // адрес сервера 
$database = 'test_db'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

$conn = new mysqli($host, $user, $password, $database) //подключение к базе данных
or die ('Cannot connect to db');


//Выбор данных из 'clients'
$result = mysqli_query($conn, "SELECT * FROM clients WHERE id = '$id'") or die("Ошибка " . mysqli_error($conn)); 

	$row = mysqli_fetch_array($result);
	$surname = $row['surname'];
	$name = $row['name'];
	$middle_name = $row['middle_name'];
	$passport_series = $row['passport_series'];
	$passport_id = $row['Passport_id'];
	$date_of_issue = $row['date_of_issue'];
	$issued = $row['issued'];
	$arr_clients = array ($surname, $name, $middle_name, $passport_series, $passport_id, $date_of_issue, $issued);

//Выбор данных из 'address'
$result2 = mysqli_query($conn, "SELECT * FROM address WHERE client_id = '$id'") or die("Ошибка " . mysqli_error($conn));



	$row2 = mysqli_fetch_array($result2);
	$city = $row2['city'];
	$street = $row2['street'];
	$house_number = $row2['house_number'];
	$apartment = $row2['apartment'];
	$arr_address = array ($city, $street, $house_number, $apartment);

//Выбор данных из 'contact'
$result3 = mysqli_query($conn, "SELECT * FROM contact WHERE client_id = '$id'") or die("Ошибка " . mysqli_error($conn));


	$row3 = mysqli_fetch_array($result3);
	$phone_number = $row3['phone_number'];
	$email = $row3['email'];
	$arr_contact = array ($phone_number, $email);



//Отправляем данные обратно на страницу
$out = array(
	"clients" => $arr_clients,
	"address" => $arr_address,
	"contact" => $arr_contact

);
header('Content-Type: text/json; charset=utf-8');
echo json_encode ($out);

mysqli_close($conn);

?>