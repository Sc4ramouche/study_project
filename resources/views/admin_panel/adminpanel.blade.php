@extends('template.site')

@section('content')

<style>
	.list {
		margin-left: 5%;
	}

	#container::after { 
		content: ""; 
		display: table; 
		clear: both; 
	}

	#LeftBlock {
		width: 40%;
		float: left;
	}

	#RightBlock {
		width: 60%;
		float: right;
	}

	td {
		text-align: center;
	}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<h3 align="center">Панель администратора</h3>

<div id="container">
	<div id="LeftBlock">
		<dl class="list">
			<dt><a  onclick="hidetext('List1')" href="#" role="button">Категория</a></dt>
				<span id="List1">
					<dd><a onclick="ShowCategory()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddCategoryForm()" href="#" role="button">Добавить</a></dd>
					<dd>
					</dd>
				</span>
			<dt><a onclick="hidetext('List2')" href="#" role="button">Подкатегории</a></dt>
				<span id="List2">
					<dd><a onclick="ShowSubCategory()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddSubCategoryForm()" href="#" role="button">Добавить</a></dd>
				</span>
			<dt><a onclick="hidetext('List3')" href="#" role="button">Характеристики подкатегории</a></dt>
				<span id="List3">
					<dd><a onclick="ShowSubCharacteristics()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddCharFromSub()" href="#" role="button">Добавить</a></dd>
					<dd>Редактировать</dd>
					<dd>Удалить</dd>
				</span>	
			<dt><a onclick="hidetext('List4')" href="#" role="button">Товар</a></dt>
				<span id="List4">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List5')" href="#" role="button">Бренды</a></dt>
				<span id="List5">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List6')" href="#" role="button">Модели</a></dt>
				<span id="List6">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List7')" href="#" role="button">Страны</a></dt>
				<span id="List7">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List8')" href="#" role="button">Заказы</a></dt>
				<span id="List8">
					<dd>Просмотреть</dd>
					<dd>Редактировать</dd>
					<dd>Удалить</dd>
				</span>
		</dl>	
	</div>

	<div id="RightBlock">
		<div id="Response">
		</div>
		<div id="ResponseTable">
		</div>
	</div>
</div>
	


<form id="logout-form" action="{{ url('/admin/logout') }}" method="GET" >
    {{ csrf_field() }}
    <button type="submit">
        Выйти
    </button>
</form>

<script>
	//Делегированная обработка событий для динамически добавленных документов
	//ищет все нужные элементы в родительском теге (в данном случае - <body>)
	$(document).ready(function() {

		//Отловить нажатие кнопки с id = InsertCategoryTable
		//Записать название категории в таблицу Категория
		$('body').on("click", '#InsertCategoryTable', function() {
			//проверка на введенное значение в поле Label с id = CategoryName
			if ( $('#CategoryName').val() != '' ) {
				//получить защитный токен, чтобы можно было отправить запрос
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				//составить и отправить POST запрос
				//по адресу /admin/AddCategory 
				//данные, которые передаются по запросу: CSRF токен, название категории 
				$.ajax({
					type: "POST",
					url: "/admin/AddCategory",
					data: {_token: CSRF_TOKEN, name: $('#CategoryName').val()},
					dataType: 'JSON',
					success: function(data) {
						alert("Новая категория добавлена!");
					},
					error: function(data) {
						alert('Ошибка при передаче запроса на сервер!');
					}
				});
			}
			//иначе, если название категории было не введено
			else {
				alert('Введите название категории');
				return;
			}
		});


		//Отловить нажатие динамической кнопки с id = "InsertSubCategoryTable"
		//Записать введенные данные в форму в таблицу Подкатегория 
		$('body').on("click", '#InsertSubCategoryTable', function() {

			//проверка на ввод названия подкатегории в форму
			if ( $("#SubCategoryName").val() != '' ) {
				//проверка на ввод типа подкатегории в форму
				if ($("#SubCategoryType").val() != '') {
					var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
					//составить и отправить POST запрос
					//по адресу /admin/AddSubCategory 
					//данные, которые передаются по запросу: CSRF токен, название категории, 
					//										ID категории, тип подкатегории
					$.ajax({
						type: "POST",
						url: "/admin/AddSubCategory",
						data: {_token: CSRF_TOKEN, name: $('#SubCategoryName').val(), 
								id_category: $('#CategoryForSub').val(), type: $('#SubCategoryType').val()},
						dataType: 'JSON',
						success: function(data) {
							alert("Новая подкатегория добавлена!");
						},
						error: function(data) {
							alert('Ошибка при передаче запроса на сервер!');
						}
					});
				}
				//иначе, если тип подкатегории не введен
				else {
					alert('Введите тип подкатегории');
					return;
				}
			}
			//иначе, если название подкатегории не введено
			else {
				alert('Введите название подкатегории');
				return;
			}
		});

		//Отловить нажатие на динамической кноки с id = ShowSubCategoryTable
		//Отображает таблицу выбранной подкатегории товара
		$('body').on("click", '#ShowSubCategoryTable', function() {
			$('#ResponseTable').empty();
			GetSubCharacteristics(function(SubCharacteristics) {
				$('#ResponseTable').append("<table id='kekekek' width='700' border='1'></table>")
				$('#ResponseTable').find('table').append("<tr><td>Номер</td><td>Наименование характеристики</td>" +
														"<td>Значение характеристики</td></tr>");

				//если у подхарактеристики имеется хоть 1 значение, то вывести его
				if (SubCharacteristics.length > 0) {
					for (var i = 0; i < SubCharacteristics.length; i++) {
						$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" +
																"<td>" + SubCharacteristics[i].Characteristic + "</td>" + 
																"<td>" + SubCharacteristics[i].Value + "</td></tr>");
					}
				}
				else {
					alert("Данная подкатегория не имеет характеристик");
					return;
				}
			},$('#SubCategoryForChar').val())

		});

		//Отловить нажатие на динамическую кнопку с id = InsertNewCharForSub
		//Отправляет POST-запрос на сервер
		//Записывает новую характеристику для подкатегории в таблицу
		$('body').on("click", "#InsertNewCharForSub", function() {
			//проверка на ввод названия новой характеристики
			if ( $('#NewCharForSub').val() != '' ) {
				//проверка на ввод значения новой характеристики для подкатегории в форму
				if ( $("#NewValueForCharSub").val() != '' ) {
					var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
					//составить и отправить POST запрос
					//по адресу /admin/AddSubCatChar 
					//данные, которые передаются по запросу: CSRF токен, название характеристики, 
					//										ID категории, значение характеристики
					$.ajax({
						type: "POST",
						url: "/admin/AddSubCatChar",
						data: {_token: CSRF_TOKEN, nameChar: $('#NewCharForSub').val(), 
								id_subCategory: $('#SubCategoryForChar').val(), valueChar: $('#NewValueForCharSub').val()},
						dataType: 'JSON',
						success: function(data) {
							alert("Новая характеристика добавлена!");
						},
						error: function(data) {
							alert('Ошибка при передаче запроса на сервер!');
						}
					});
				}
				//иначе, если не было введено значение
				else {
					alert("Введите значение новой характеристики!");
					return;
				}
			}
			//иначе, если не было введено название
			else {
				alert("Введите название новой характеристики!");
				return;
			}
		});
	});

	//как только загружается документ, то на выполнение поступает
	//функция - ready()
	document.addEventListener("DOMContentLoaded", ready);

	//установить изначально все span в display : none
	//установить все теги div Resopne в display : none
	function ready() {
		var elements = document.getElementsByTagName("span");
		for (var i = 0; i < elements.length; i++) {
			elements[i].style.display = "none";
		}
	};

	//поменять значение display у элемента - span
	//с IdName
	//и вместе с ним поменять div Respone соответсвующий
	function hidetext(IdName) { 
		if (document.getElementById(IdName).style.display == "none") {
			document.getElementById(IdName).style.display = "block";
			hideanother(IdName);
		}
		else
			document.getElementById(IdName).style.display = "none";
	};

	//скрыть другие span, чтобы активен был только один
	//скрыть другие div Response, чтобы активен был только один	
	function hideanother(IdName) {

		var elements = document.getElementsByTagName("span");
		var CurrentElement = document.getElementById(IdName);
		

		for (var i = 0; i < elements.length; i++) {
			if (CurrentElement != elements[i]) 
				elements[i].style.display = "none";
		}
	};

	//Фнукция, которая отсылает  AJAX GET-запрос на сервер
	//Если response === success, то возвращает перечень категорий, как массив объектов
	//Параметры массива: ID_CATEGORY, Name
	function GetAllCategory(AllCategory) {
		$.ajax({
			type: "GET",
			url: '/admin/GetCategory',
			success: function(data) {
				AllCategory(JSON.parse(data));
			},
			error: function(data) {
				alert('Ошибка при отправке запроса на сервер!');
				return;
			}
		});
	};

	//Фнукция, которая отсылает  AJAX GET-запрос на сервер
	//Если response === success, то возвращает перечень подкатегорий, как массив объектов
	//Параметры массива: ID_SUBCATEGORY, Name, CategoryName, Type
	function GetAllSubCategory(AllSubCategory) {
		$.ajax({
			type: "GET",
			url: "/admin/GetSubCategory",
			success: function(data) {
				AllSubCategory(JSON.parse(data));
			},
			error: function(data) {
				alert('Ошибка при отправке запроса на сервер!');
				return;
			}
		});
	};

	//Функция, которая отсылает AJAX GET-запрос на сервер
	//Если response === 200, то возвращает перечень характеристик и значений выбранной подкатегории
	//Как массив объектов
	//Параметры массива: Characteristics, Value
	function GetSubCharacteristics(SubCharacteristics, id_SubCategory) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetSubCatChar",
			data: {_token: CSRF_TOKEN, id_SubCategory: id_SubCategory},
			success: function(data) {
				SubCharacteristics(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	};

	//Функция, которая отсылает AJAX GET-запрос на сервер
	//Если response === 200, то возвращает перечень всех характеристик, как массив объектов
	//Параметры массива: ID_CHARACTERISTICSUBC, Name
	function GetAllCharacteristics(AllCharacteristics) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetCharacteristic",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllCharacteristics(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Отобразить перечень категорий в виде таблицы
	//Вызвать функцию GetAllCategory и занести полученные данные в таблицу 
	function ShowCategory() {
		GetAllCategory(function(AllCategory) {
			$("#Response").empty();
			$("#ResponseTable").empty();
			//Создать таблицу в теге id = Response1
			//С колонками Индекс и Наименование категории
			$('#ResponseTable').append("<table width='500' border='1'></table");
			$('#ResponseTable').find('table').append("<tr><td>Индекс</td><td>Наименование категории</td></tr>");

			for (var i = 0; i < AllCategory.length; i++) {

				$('#ResponseTable').find('table').append("<tr><td>" + AllCategory[i].ID_CATEGORY + "</td>" +
																 "<td>" + AllCategory[i].Name + "</td></tr>")					
			}
		});
	};

	//Отобразить перечень категорий в виде таблицы
	//Вызвать функцию GetAllSubCategory и занести полученные данные в таблицу
	function ShowSubCategory() {
		GetAllSubCategory(function(AllSubCategory) {
			$("#Response").empty();
			$("#ResponseTable").empty();

			$('#ResponseTable').append("<table width='700' border='1'></table>")
			$('#ResponseTable').find('table').append("<tr><td>Название категории</td>" + 
													"<td>Название подкатегории</td>" + 
													"<td>Тип подкатегории</td></tr>");

			//цикл для категорий
			for (var i = 0; i < AllSubCategory.length; i++) {
				//если в категории есть хоть одна подкатегория, тогда вывести категорию
				//и список подкатегорий
				if (AllSubCategory[i].SubCategoryArray.length > 0) {
					$('#ResponseTable').find('table').append("<tr><td>" + AllSubCategory[i].CategoryName + "</td>" +
														"<td>" + AllSubCategory[i].SubCategoryArray[0].Name + "</td>" +
														"<td>" + AllSubCategory[i].SubCategoryArray[0].Type + "</td></tr>");
					// цикл для каждой подкатегории, кроме первой т.к. вывели ее до этого
					for (var j = 1; j < AllSubCategory[i].SubCategoryArray.length; j++) {
						$('#ResponseTable').find('table').append("<tr><td></td>" + 
																"<td>" + AllSubCategory[i].SubCategoryArray[j].Name + "</td>" +
																"<td>" + AllSubCategory[i].SubCategoryArray[j].Type + "</td></tr>");
					}
				}
				//иначе, если в категории нет подкатегорий, то
				//вывести только название категории
				else {
					$('#ResponseTable').find('table').append("<tr><td>" + AllSubCategory[i].CategoryName + "</td>" +
															"<td></td>" +
															"<td></td></tr>");
				}
			}
		});
	};

	//Отобразить форму для добавления новой категории
	function AddCategoryForm() {
		$('#Response').empty();
		$("#ResponseTable").empty();
		$('#Response').append("<label>Введите название категории: </label>");
		$('#Response').append("<input type='text' id='CategoryName'/>");
		$('#Response').append("<br><button id='InsertCategoryTable'>Добавить</button>")
	};

	//Отобразить форму для добавления новой подкатегории
	//Отправить GET-запрос на сервер, получить перечень категорий для поля <select>
	function AddSubCategoryForm() {
		GetAllCategory(function(AllCategory) {
			$('#Response').empty();
			$("#ResponseTable").empty();
			$('#Response').append("<label>Выберите категорию: <label>");
			$('#Response').append("<select id='CategoryForSub'></select><br>");
			for (var i = 0; i < AllCategory.length; i++) {
				$('#Response').find("select").append("<option value=" + AllCategory[i].ID_CATEGORY + ">" + 
																		AllCategory[i].Name + "</option>");
			}
			$('#Response').append("<label>Введите название подкатегории: </label>");
			$('#Response').append("<input type='text' id='SubCategoryName'/><br>");
			$('#Response').append("<label>Введите тип подкатегории: </label>");
			$('#Response').append("<input type='text' id='SubCategoryType'/>");
			$('#Response').append("<br><button id='InsertSubCategoryTable'>Добавить</button>");
		});
	};

	//Отобразить тэг <select> с перечнем подкатегорий
	//Отправить GET-запрос на сервер (GetAllSubCategory), чтобы получить перечень подкатегорий
	function ShowSubCharacteristics() {
		GetAllSubCategory(function(AllSubCategory) {
			$('#Response').empty();
			$("#ResponseTable").empty();
			$('#Response').append("<label>Выберите подкатегорию: <label>");
			$('#Response').append("<select id='SubCategoryForChar'></select><br>");
			//пройтись по каждой категории
			for (var i = 0; i < AllSubCategory.length; i++) {
				//пройтись по каждой подкатегории
				for (var j = 0; j < AllSubCategory[i].SubCategoryArray.length; j++) {
				$('#Response').find("select").append("<option value=" + AllSubCategory[i].SubCategoryArray[j].ID_SUBCATEGORY + ">" + 
																		AllSubCategory[i].SubCategoryArray[j].Name + "</option>");
				}
			}
			$('#Response').append("<button id='ShowSubCategoryTable'>Показать</button>");
		});
	};

	//Отобразить форму для добавления новой характеристики, для подкатегории
	//Отправить GET-запрос на сервер (GetAllSubCategory), чтобы получить перечень подкатегорий
	function AddCharFromSub() {
		GetAllSubCategory(function(AllSubCategory) {
			$('#Response').empty();
			$("#ResponseTable").empty();
			$('#Response').append("<label>Выберите подкатегорию: <label>");
			$('#Response').append("<select id='SubCategoryForChar'></select><br>");
			//пройтись по каждой категории
			for (var i = 0; i < AllSubCategory.length; i++) {
				//пройтись по каждой подкатегории
				for (var j = 0; j < AllSubCategory[i].SubCategoryArray.length; j++) {
				$('#Response').find("select").append("<option value=" + AllSubCategory[i].SubCategoryArray[j].ID_SUBCATEGORY + ">" + 
																		AllSubCategory[i].SubCategoryArray[j].Name + "</option>");
				}
			}

			$('#Response').append("<label>Введите новую характеристику и значение подкатегории: </label>");
			$('#Response').append("<input type='text' id='NewCharForSub'/>  ");
			$('#Response').append("<input type='text' id='NewValueForCharSub'/>");
			$('#Response').append("<br><button id='InsertNewCharForSub'>Добавить</button>");
		});
	};

</script>


@endsection()
