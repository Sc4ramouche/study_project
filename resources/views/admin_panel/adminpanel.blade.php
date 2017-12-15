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
		width: 50%;
		float: left;
	}

	#RightBlock {
		width: 50%;
		float: right;
	}
</style>

<script>
	//как только загружается документ, то на выполнение поступает
	//функция - ready()
	document.addEventListener("DOMContentLoaded", ready);

	//установить изначально все span в display : none
	//установить все теги div Resopne в display : none
	function ready() {
		var elements = document.getElementsByTagName("span");
		for (var i = 0; i < elements.length; i++) {
			elements[i].style.display = "none";

			var responseID = "Response" + (i + 1);
			document.getElementById(responseID).style.display = "none";
		}
	}

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
	}

	//скрыть другие span, чтобы активен был только один
	//скрыть другие div Response, чтобы активен был только один	
	function hideanother(IdName) {

		var elements = document.getElementsByTagName("span");
		var CurrentElement = document.getElementById(IdName);
		

		for (var i = 0; i < elements.length; i++) {
			var responseID = "Response" + (i + 1);
			if (CurrentElement != elements[i]) {
				elements[i].style.display = "none";
				document.getElementById(responseID).style.display = "none";
				document.getElementById(responseID).innerHTML = "";
			}
			else {
				document.getElementById(responseID).style.display = "block";
			}
		}
	}

	//Отобразить перечень категорий
	//Отослать JAX GET-запрос на сервер по url
	//если статус ответа === 200, то вывести таблицу с категориями  
	function ShowCategory() {
		var request = new XMLHttpRequest();
		var url = "/admin/ShowCategory";

		request.open("GET", url, true);
		request.send();
		
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status === 200){
				alert("Таблица создалась!");
				//преобразовать полученный JSON в массив объектов:
				//параметры: ID_CATEGORY, Name
				var AllCategory = JSON.parse(request.responseText);
				
				//Вывести название каждого объекта в HTML таблицу
				//создать элемент таблицу
				var table = document.createElement('table');
				table.style.border = "1px solid black";
				//получить доступ к теку с id = Response1 
				var InnerTable = document.getElementById('Response1');
				//добавить в тег с id = Response1 новый тег table
				InnerTable.appendChild(table);

				//Задать шапку таблицы
				var NameRow = document.createElement('tr');
				var NameColumn1 = document.createElement('td');
				NameColumn1.innerHTML = "Идентификатор";
				var NameColumn2 = document.createElement('td');
				NameColumn2.innerHTML = "Название категории";
				table.appendChild(NameRow);
				NameRow.appendChild(NameColumn1);
				NameRow.appendChild(NameColumn2);
				
				//Из массива объектов записать в таблицу
				//tr - стока (newTR), td - столбец в строке (newTD1, newTD2) 
				for (var i = 0; i < AllCategory.length; i++) {
					var newTR = document.createElement('tr');
					var newTD1 = document.createElement('td');
					newTD1.innerHTML = AllCategory[i].ID_CATEGORY;
					var newTD2 = document.createElement('td');
					newTD2.innerHTML = AllCategory[i].Name;
					table.appendChild(newTR);
					newTR.appendChild(newTD1);
					newTR.appendChild(newTD2);
					newTR.style.border = "1px solid black";
					newTD1.style.border = "1px solid black";
					newTD2.style.border = "1px solid black";
				}
			}
		}
	}
</script>

<h3 align="center">Панель администратора</h3>

<div id="container">
	<div id="LeftBlock">
		<dl class="list">
			<dt><a  onclick="hidetext('List1')" href="#" role="button">Категория</a></dt>
				<span id="List1">
					<dd><a onclick="ShowCategory()" href="#" role="button">Просмотреть</a></dd>
					<dd><a href="#" role="button">Добавить</a></dd>
					<dd>
					</dd>
				</span>
			<dt><a onclick="hidetext('List2')" href="#" role="button">Подкатегории</a></dt>
				<span id="List2">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
				</span>
			<dt><a onclick="hidetext('List3')" href="#" role="button">Товар</a></dt>
				<span id="List3">
					<dd>Добавить</dd>
					<dd>Редактировать</dd>
					<dd>Удалить</dd>
				</span>	
			<dt><a onclick="hidetext('List4')" href="#" role="button">Бренды</a></dt>
				<span id="List4">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List5')" href="#" role="button">Модели</a></dt>
				<span id="List5">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List6')" href="#" role="button">Страны</a></dt>
				<span id="List6">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List7')" href="#" role="button">Заказы</a></dt>
				<span id="List7">
					<dd>Просмотреть</dd>
					<dd>Редактировать</dd>
					<dd>Удалить</dd>
				</span>
		</dl>	
	</div>

	<div id="RightBlock">
		<div id="Response1">
		</div>
		<div id="Response2">
		</div>
		<div id="Response3">
		</div>
		<div id="Response4">
		</div>
		<div id="Response5">
		</div>
		<div id="Response6">
		</div>
		<div id="Response7">
		</div>
	</div>
</div>
	


<form id="logout-form" action="{{ url('/admin/logout') }}" method="GET" >
    {{ csrf_field() }}
    <button type="submit">
        Выйти
    </button>
</form>



@endsection()
