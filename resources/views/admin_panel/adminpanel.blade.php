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
			if (CurrentElement != elements[i]) 
				elements[i].style.display = "none";
			else 
				document.getElementById(responseID).style.display = "block";
		}
	}

	//Отобразить перечень категорий
	//Отослать JAX GET-запрос на сервер по url
	//если статус ответа === 200, то вывести таблицу с категориями  
	function ShowCategory() {
		$.ajax({
			type: "GET",
			url: '/admin/ShowCategory',
			success: function(data){
				$("#Response").empty();
				//преобразовать полученный JSON в массив объектов:
				//параметры: ID_CATEGORY, Name
				var AllCategory = JSON.parse(data);

				//Создать таблицу в теге id = Response1
				//С колонками Индекс и Наименование категории
				$('#Response').append("<table width='500' border='1'></table");
				$('#Response').find('table').append("<tr><td>Индекс</td><td>Наименование категории</td></tr>")

				for (var i = 0; i < AllCategory.length; i++) {

					$('#Response').find('table').append("<tr><td>" + AllCategory[i].ID_CATEGORY + "</td>" +
															 "<td>" + AllCategory[i].Name + "</td></tr>")					
				}
			},
			error: function(data){
				alert('Error:' + data);
			}
		})
	}
</script>

<h3 align="center">Панель администратора</h3>

<div id="container">
	<div id="LeftBlock">
		<dl class="list">
			<dt><a  onclick="hidetext('List1')" href="#" role="button">Категория</a></dt>
				<span id="List1">
					<dd><a onclick="ShowCategory()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddCategory()" href="#" role="button">Добавить</a></dd>
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
		<div id="Response">
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
