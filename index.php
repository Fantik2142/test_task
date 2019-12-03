<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Юридическая помощь</title>
	<meta name="discription" content="Киномонстр - это портал о кино">
	<meta name="keywords" content="фильмы, фильмы онлайн, hd">
	<link rel="stylesheet" href="assets/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="assets/js/chosen.jquery.min.js"></script>
	<link rel="stylesheet" href="assets/js/chosen.min.css" />
</head>
<body>
	<div class="main">
		<div class="header">
			<div class="logo">
				<div class="logotext">
					<h1>Связь-Телеком</h1>
					<h2>Заключение договора об услугах связи</h2>
				</div>
			</div>	
		</div>
		<div class="content">
		    <script type="text/javascript">
		    
		       	$(document).ready( function(e) {
  				$(".chosen-select").chosen({
  				width: "35%",
  				disable_search: false,
  				disable_search_threshold: 1,
  				enable_split_word_search: false,
  				max_selected_options: 1,
  				no_results_text: "Ничего не найдено",
  				placeholder_text_multiple: "Выберите несколько параметров",
  				placeholder_text_single: "Выберите параметр",
  				search_contains: true,
  				display_disabled_options: false,
  				display_selected_options: false,
  				max_shown_results: Infinity
  				});
 				});

			</script>
		    <div class="select_menu">  <!-- Выбор существующего пользователя -->
		      <p id="selct_name">Если вы ранее регистрировались, то выберите ФИО из ссписка:</p>
		      	<select id= "sel1" class='chosen-select' size="6" >
    				<option value="none" selected disabled=""> </option> 
                	<?php include_once 'select.php'?>  
    			</select>
		    </div>

            <form id="form_data" action="input_form.php" method="POST">
            	<p class="note">Поля со знаком * обязательны для заполнения!</p>
              <label>Введите вашу фамилию*:</label>
		      <input id="surname" name="surname" placeholder="Фамилия" required></input><br>
		      <label>Введите ваше имя*:</label>
		      <input id="name" name="name" placeholder="Имя" required ></input><br>
		      <label>Введите ваше отчество*:</label>
		      <input id="middle_name" name="middle_name" placeholder="Отчество" required></input><br>
		      <label>Введите серию паспорта*:</label>
		      <input id="passport_series" name="passport_series" placeholder="Серия паспорта" maxlength="4" minlength="4" required pattern="[0-9]{4}"></input><br>
		      <label>Введите номер паспорта*:</label>
		      <input id="passportid" name="passportid" placeholder="Номер паспорта" maxlength="6" minlength="6" required pattern="[0-9]{6}"></input><br>
		      <label>Введите дату выдачи паспорта*:</label>
		      <input id="date_of_issue" name="date_of_issue" placeholder="Дата выдачи паспорта" required></input><br>
		      <label>Введите кем выдан паспорт*:</label>
		      <input id="issued" name="issued" placeholder="Кем выдан паспорт" required></input><br>
		      <label>Введите город*:</label>
		      <input id="city" name="city" placeholder="Город" required></input><br>
		      <label>Введите улицу*:</label>
		      <input id="street" name="street" placeholder="Улица" required></input><br>
		      <label>Введите номер дома*:</label>
		      <input id="house_number" name="house_number" placeholder="Номер дома" required></input><br>
		      <label>Введите номер квартиры*:</label>
		      <input id="apartment" name="apartment" placeholder="Номер квартиры" required></input><br>
		      <label >Введите ваш номер телефона или несколько телефонов через "|" *:</label>
		      <input id="phone_number" name="phone_number" placeholder="xxxxxxxxxx" required pattern="[0-9]{10}|[0-9]{10}([|]{1,}[0-9]{10}){1,}" minlength="10"></input><br>
		      <label >Введите ваш Email:</label>
		      <input type="email" id="email" name="email" placeholder="Email"></input><br>
		      <input type ="submit" name="save_submit" value="Сохранить"></input>
		      <input id="delete_button" type ="hidden" name="delete" value="Удалить"></input>
		      <input type ="submit" name="print_submit" value="Распечатать договор"></input>
            </form>
		</div>
<script>
	//Выбор id из списка, заполнение полей данными из бд
    let sel = document.getElementById("sel1");
    sel.onchange = function() {
    var varsel =sel.value; 
    alert(varsel);
    	$.ajax({              
 		url: "selectdata.php",
        dataType: "json",
        data: {"varsel": varsel},
        type: "POST",
        success: function(result) {
            document.getElementById('surname').value = (result.clients['0']);
            $("#surname").prop("readonly", true);
            document.getElementById('name').value = (result.clients['1']);
            $("#name").prop("readonly", true);
            document.getElementById('middle_name').value = (result.clients['2']);
            $("#middle_name").prop("readonly", true);
            document.getElementById('passport_series').value = (result.clients['3']);
            $("#passport_series").prop("readonly", true);
            document.getElementById('passportid').value = (result.clients['4']);
            $("#passportid").prop("readonly", true);
            document.getElementById('date_of_issue').value = (result.clients['5']);
            $("#date_of_issue").prop("readonly", true);
            document.getElementById('issued').value = (result.clients['6']);
            $("#issued").prop("readonly", true);
            document.getElementById('city').value = (result.address['0']);
            document.getElementById('street').value = (result.address['1']);
            document.getElementById('house_number').value = (result.address['2']);
            document.getElementById('apartment').value = (result.address['3']);
            document.getElementById('phone_number').value = (result.contact['0']);
            document.getElementById('email').value = (result.contact['1']);
            $("#delete_button").prop("type", "submit");
            $("#form_data").prop("action", "update_form.php");
             }
 	});
    }

</script>

		<div class="footer">
		<p>finhelp.com</p>
		<p>2019</p>
		</div>
	</div>
</body>
</html>