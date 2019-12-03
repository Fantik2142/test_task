<?php  //выбор сотрудников из существующих
$host = 'localhost'; // адрес сервера 
$database = 'test_db'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

$conn1 = new mysqli($host, $user, $password, $database) //Подключение к базе данных
or die ('Cannot connect to db');

//Выбор ФИО для выпадающего списка
$result = mysqli_query($conn1, "SELECT id, FIO FROM clients WHERE status = 'Активен'") or die("Ошибка " . mysqli_error($conn1));
while ($row = $result->fetch_assoc()) {
	unset($id, $name);
	$id = $row['id'];
	$name = $row['FIO']; 
	echo '<option value="'.$id.'">'.$name.'</option>';
}

mysqli_close($conn1);
                    ?>
