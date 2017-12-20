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
					<dd><a onclick="RedactCharFromSub()" href="#" role="button">Редактировать</a></dd>
					<dd><a onclick="DeleteCharFromSub()" href="#" role="button">Удалить</a></dd>
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
					<dd><a onclick="ShowAllBrend()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddBrend()" href="#" role="button">Добавить</a></dd>
					<dd><a onclick="DeleteBrend()" href="#" role="button">Удалить</a></dd>
					<dd><a onclick="UpdateBrend()" href="#" role="button">Редактировать</a></dd>
				</span>
			<dt><a onclick="hidetext('List6')" href="#" role="button">Материал</a></dt>
				<span id="List6">
					<dd><a onclick="ShowAllMaterials()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddMaterial()" href="#" role="button">Добавить</a></dd>
					<dd><a onclick="DeleteMaterial()" href="#" role="button">Удалить</a></dd>
					<dd><a onclick="UpdateMaterial()" href="#" role=button>Редактировать</a></dd>
				</span>
			<dt><a onclick="hidetext('List7')" href="#" role="button">Модели</a></dt>
				<span id="List7">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List8')" href="#" role="button">Страны</a></dt>
				<span id="List8">
					<dd>Просмотреть</dd>
					<dd>Добавить</dd>
					<dd>Удалить</dd>
					<dd>Редактировать</dd>
				</span>
			<dt><a onclick="hidetext('List9')" href="#" role="button">Заказы</a></dt>
				<span id="List9">
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
			if ( $('#CategoryName').val() != '' )
				//Запрос на добавление новой категории
				AddCategory($('#CategoryName').val());
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
				if ($("#SubCategoryType").val() != '')
					//Отправить запрос на сервер
					AddSubCategory($('#SubCategoryName').val(), $('#CategoryForSub').val(), $('#SubCategoryType').val());
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
				$('#ResponseTable').append("<table width='700' border='1'></table>")
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
				if ( $("#NewValueForCharSub").val() != '' )
					AddCharacteristicsSub($('#NewCharForSub').val(), $('#SubCategoryForChar').val(), $('#NewValueForCharSub').val());
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


		//Отлавливает нажатие на динамическую кнопку с id = ShowCharSubForRedact
		//Отправляет AJAX GET-запрос, чтобы получить перечень характеристик выбранной подкатегории
		//Поля характеристики: Characteristic (название), Value (значение), ID_SubChar(нормер характеристики для подкатегории)
		$('body').on("click", "#ShowCharSubForRedact", function() {
			$('#ResponseTable').empty();
			GetSubCharacteristics(function(SubCharacteristics) {
				//если у подкатегория  имеет  0 характеристи
				if (SubCharacteristics.length == 0) {
					alert("Данная подкатегория не имеет характеристик");
					return;
				}
				//функция для вывода таблицы с характеристиками
				ShowCharacteristicTable(SubCharacteristics);
				$('#ResponseTable').append("<label>Отредактируйте выбранную характеристику: </label>");
				$('#ResponseTable').append("<input type='text' id='NameCharEdit'/>  ");
				$('#ResponseTable').append("<input type='text' id='ValueCharEdit'/>");
				$('#ResponseTable').append("<br><button id='ReductCharForSubButton'>Редактировать</button>");
			},$('#SubCategoryForChar').val())
		});

		//Отлавливает нажатие на динамическую кнопку с id = ReductCharForSubButton
		//Отправляет AJAX PUT-запрос, чтобы редактировать выбранную характеристику подкатегории
		$('body').on("click", '#ReductCharForSubButton', function() {
			if ('value', $('#Name' + $('input[name=Characteristic]:checked').val()).text() == '') {
				alert("Вы не выбрали характеристику для изменения!");
				return;
			}
			else 
				PutCharacteristicsSub( $('input[name=Characteristic]:checked').val(), $('#NameCharEdit').val(), $('#ValueCharEdit').val() );
		});

		//Отловить изменение input RadioButton с name =  Characteristic
		//Присвоить полям для редактирования выбранные значения из таблицы
		$('body').on("click", "input[name=Characteristic]", function() {
			$('#NameCharEdit').attr('value', $('#Name' + $('input[name=Characteristic]:checked').val()).text() );
			$('#ValueCharEdit').attr('value', $('#Value' + $('input[name=Characteristic]:checked').val()).text() );
		});

		//если в теге <select> с Id = SubCategoryForChar Было выбрано новое значение
		//то очистить все чтобы было снизу (таблицу с характеристиками)
		$('body').on("change", "#SubCategoryForChar", function() {
			$('#ResponseTable').empty();
		});

		//Отловить нажатие на динамическую кнопку с id = ShowCharSubForDelete
		//Отправляет AJAX GET-запрос, чтобы получить перечень характеристик выбранной подкатегории
		$('body').on("click", '#ShowCharSubForDelete', function() {
			$('#ResponseTable').empty();
			GetSubCharacteristics(function(SubCharacteristics) {
				if (SubCharacteristics.length == 0) {
					alert("Данная подкатегория не имеет характеристик");
					return;
				}
				//функция для вывода таблицы с характеристиками
				ShowCharacteristicTable(SubCharacteristics);
				$('#ResponseTable').append("<button id='DeleteCharForSubButton'>Удалить</button>");
			}, $('#SubCategoryForChar').val());
		});

		//Отловить нажатие на динамическую кнопку с id = DeleteCharForSubButton
		//Отправить AJAX DELTE-запрос, чтобы удалить выбранную характеристику у подкатегории
		//Передать на запрос значение из <radio>, который хранит идентификатор характеристики
		$('body').on("click", "#DeleteCharForSubButton", function() {
			if ( $('#Name' + $('input[name=Characteristic]:checked').val()).text() == '') {
				alert("Вы не выбрали характеристику для удалени!");
				return;
			}
			else 
				DeleteCharacteristicsSub( $('input[name=Characteristic]:checked').val() );
		});

		//Отловить нажатие на динамическую кнопку с Id = AddBrendName
		//Отправить AJAX POST-запрос, чтобы добавить новое название бренда
		//Передать по запросу значение элемента input=text id="BrendName"
		$('body').on("click", "#AddBrendName", function() {
			if ( $('#BrendName').val() != '') {
				AddBrendName( $('#BrendName').val() );
			}
			else {
				alert("Введите название бренда!");
			}
		});

		//Отловить нажатие на динамическую кнопку с id = DeleteBrendName
		//Отправить AJAX DELETE-запрос, чтобы удалить выбранный бренд из таблицы
		//Передать по запросу выбранный <radio> элемент из таблицы
		$('body').on("click", "#DeleteBrendName", function() {
			//если <radio> не был выбран == undefined
			if ( $('input[name=Brend]:checked').val() == undefined)  {
				alert("Вы не выбрали бренд для удаления!");
				return;
			}
			//функция на отправку запроса на удаление бренда
			DeleteBrendName( $('input[name=Brend]:checked').val() );
		})

		//Отловить изменения input <radio> с name = Brend
		//Присвоить полю название бренда для редактирования из таблицы
		$('body').on("click", 'input[name=Brend]:checked', function() {
			$('#NameBrend').attr('value', $('#BrendName' + $('input[name=Brend]:checked').val()).text() );
		});

		//Отловить нажатие на динамическую кнопку с id = UpdateNameBrendButton
		//Отправить AJAX PUT-запрос, чтобы редактировать выбранный бренд из таблицы
		//Передать в запрос: идентификатор бренда и отредактированное название бренда
		$('body').on("click", "#UpdateNameBrendButton", function() {
			UpdateBrendName($('input[name=Brend]:checked').val(), $('#NameBrend').val());
		})

		//Отловить нажатие на динамическую кнопку с id = AddMaterialName
		//Отправить AJAX POST-запрос, чтобы добавить новый материал в БД
		//Передать по запросу значение элемента input=text id="MaterialName"
		$('body').on("click", "#AddMaterialName", function() {
			if ( $('#MaterialName').val() == '' ) {
				alert("Введите название материала!");
				return;
			}
			AddMaterialName( $('#MaterialName').val() );
		});

		//Отловить нажатие на динамическую кнопку с id = DeleteMaterialName
		//Отправить AJAX DELETE-запрос, чтобы удалить выбранный материал из таблицы
		//Передать по запросу выбранный <radio> элемент из таблицы
		$('body').on("click", "#DeleteMaterialName", function() {
			//если <radio> не был выбран == undefined
			if ( $('input[name=Material]:checked').val() == undefined)  {
				alert("Вы не выбрали материал для удаления!");
				return;
			}
			//функция на отправку запроса на удаление бренда
			DeleteMaterialName( $('input[name=Material]:checked').val() );
		});

		//Отловить изменения input <radio> с name = Brend
		//Присвоить полю название материала для редактирования из таблицы
		$('body').on("click", 'input[name=Material]:checked', function() {
			$('#NameMaterial').attr('value', $('#MaterialName' + $('input[name=Material]:checked').val()).text() );
		});

		//Отловить нажатие на динамическую кнопку с id = UpdateNameMaterialButton
		//Отправить AJAX PUT-запрос, чтобы редактировать выбранный материал из таблицы
		//Передать в запрос: идентификатор материала и отредактированное название материала
		$('body').on("click", "#UpdateNameMaterialButton", function() {
			UpdateMaterialName($('input[name=Material]:checked').val(), $('#NameMaterial').val());
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

	//составить и отправить POST запрос
	//по адресу /admin/AddCategory 
	//данные, которые передаются по запросу: CSRF токен, название категории
	function AddCategory(CategoryName) {
		//получить защитный токен, чтобы можно было отправить запрос
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
		$.ajax({
			type: "POST",
			url: "/admin/AddCategory",
			data: {_token: CSRF_TOKEN, name: CategoryName},
			dataType: 'JSON',
			success: function(data) {
				alert("Новая категория добавлена!");
			},
			error: function(data) {
				alert('Ошибка при передаче запроса на сервер!');
			}
		});
	}


	//составить и отправить POST запрос
	//по адресу /admin/AddSubCategory 
	//данные, которые передаются по запросу: CSRF токен, название категории, 
	//										ID категории, тип подкатегории
	function AddSubCategory(CategoryName, ID_Category, CategoryType) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: "/admin/AddSubCategory",
			data: {_token: CSRF_TOKEN, name: CategoryName, 
					id_category: ID_Category, type: CategoryType},
			dataType: 'JSON',
			success: function(data) {
				alert("Новая подкатегория добавлена!");
			},
			error: function(data) {
				alert('Ошибка при передаче запроса на сервер!');
			}
		});
	}

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

	//составить и отправить POST запрос
	//по адресу /admin/AddSubCatChar 
	//данные, которые передаются по запросу: CSRF токен, название характеристики, 
	//										ID категории, значение характеристики
	function AddCharacteristicsSub(CharName, ID_SubCategory, CharValue) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: "/admin/AddSubCatChar",
			data: {_token: CSRF_TOKEN, nameChar: CharName, 
					id_subCategory: ID_SubCategory, valueChar: CharValue},
			dataType: 'JSON',
			success: function(data) {
				alert("Новая характеристика добавлена!");
			},
			error: function(data) {
				alert('Ошибка при передаче запроса на сервер!');
			}
		});
	}

	//Функция, которая посылает AJAX PUT-запрос на сервер
	//Если респонс === 200, то выдает сообщение об успешных изменениях характеристики
	//Параметры, которые надо передать для запроса: Идентификатор в таблице ALLCHARACTERISTICS,
	//измененное название характеристики, изменное название значения характеристики
	function PutCharacteristicsSub(id_CharSub, nameChar, valueChar) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "PUT",
			url: "/admin/RedactSubCatChar",
			data: {_token: CSRF_TOKEN, id_CharSub: id_CharSub,
					nameChar: nameChar, valueChar: valueChar},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранная характеристика изменена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	};

	//Функция, которая посылает AJAX DELETE-запрос на сервер
	//Если респонс === 200, то выдает сообщение об успешных изменениях характеристики
	//Параметры, которые надо передать для запросы: идентификатор характертистики в таблице ALLCHARACTERISTICS.
	function DeleteCharacteristicsSub(id_CharSub) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "DELETE",
			url: "/admin/DeleteSubCatChar",
			data: {_token: CSRF_TOKEN, id_CharSub: id_CharSub},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранная характеристика удалена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		})
	}

	//Функция, которая отсылает AJAX GET-запрос на сервер
	//Если response === 200, то возвращает перечень всех брендов из БД, как массив объектов
	//Параметры массива: ID_BREND, Name
	function GetAllBrends(AllBrends) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetBrend",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllBrends(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	};

	//Функция, которгая отсылает AJAX POST-запрос на сервер
	//Если response === 200, то добавляет новый бренд в БД
	//Параметры, которые надо передать на сервер: Название бренда
	function AddBrendName(BrendName) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: "/admin/AddBrend",
			data: {_token: CSRF_TOKEN, BrandName: BrendName},
			dataType: 'JSON',
			success: function(data) {
				alert("Новый бренд успешно добавлен!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	};

	//Функция, которая посылает AJAX DELETE-запрос на сервер
	//Если response === 200, то удаляет выбранный ранее бренд из БД
	//Параметры, которые надо передать на сервер: Идентификатор бренда, который надо удалить
	function DeleteBrendName(id_Brend) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "DELETE",
			url: "/admin/DeleteBrend",
			data: {_token: CSRF_TOKEN, id_Brend: id_Brend},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранный бренд успешно удален!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	};

	//Функция, которая посылает AJAX PUT-запрос на сервер
	//Если response === 200, то изменяет выбранный ранее бренд в БД
	//Параметры, которые надо передать на сервер: Идентификатор бренда, новое название бренда
	function UpdateBrendName(id_Brend, BrendName) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "PUT",
			url: "/admin/UpdateBrend",
			data: {_token: CSRF_TOKEN, id_Brend: id_Brend, BrendName: BrendName},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранный бренд успешно изменен!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//функция, которая отправляет AJAX GET-запрос на сервер
	//Если response === 200, то возвращает перечень всех материалов из БД, как массив объектов
	//Параметры массива: ID_MATERIAL, Name
	function GetAllMaterials(AllMaterials) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetMaterial",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllMaterials(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которгая отсылает AJAX POST-запрос на сервер
	//Если response === 200, то добавляет новый материал в БД
	//Параметры, которые надо передать на сервер: Название материала
	function AddMaterialName(MaterialName) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: "/admin/AddMaterial",
			data: {_token: CSRF_TOKEN, MaterialName: MaterialName},
			dataType: 'JSON',
			success: function(data) {
				alert("Новый материал успешно добавлен!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX DELETE-запрос на сервер
	//Если response === 200, то удаляет выбранный ранее материал из БД
	//Параметры, которые надо передать на сервер: Идентификатор материала, который надо удалить
	function DeleteMaterialName(id_Material) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "DELETE",
			url: "/admin/DeleteMaterial",
			data: {_token: CSRF_TOKEN, id_Material: id_Material},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранный материал успешно удален!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX PUT-запрос на сервер
	//Если response === 200, то изменяет выбранный ранее материал в БД
	//Параметры, которые надо передать на сервер: Идентификатор материала, новое название материала
	function UpdateMaterialName(id_Material, MaterialName) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "PUT",
			url: "/admin/UpdateMaterial",
			data: {_token: CSRF_TOKEN, id_Material: id_Material, MaterialName: MaterialName},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранный материал успешно изменен!");
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

	//Функция для отображения тега <select> в Для вывода всех подкатегорий
	//На вход получить перечень всех подкатегорий
	function ResponeForChar(AllSubCategory) {
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
		};
	};

	//Функция для отображения таблицы при Редактировании и Удалении характеристики из подкатегории
	//На вход получить список характеристик
	//Поля характеристики: Characteristic (название), Value (значение), ID_SubChar(нормер характеристики для подкатегории)
	function ShowCharacteristicTable(SubCharacteristics) {
		$('#ResponseTable').append("<table width='700' border='1'></table>")
		$('#ResponseTable').find('table').append("<tr><td>Номер</td><td>Наименование характеристики</td>" +
														"<td>Значение характеристики</td></tr>");
		for (var i = 0; i < SubCharacteristics.length; i++) {
			$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" +
													"<td id='Name" + SubCharacteristics[i].ID_SubChar + "'>" + SubCharacteristics[i].Characteristic + "</td>" +
													"<td id='Value" + SubCharacteristics[i].ID_SubChar + "'>" + SubCharacteristics[i].Value + "</td>" + 
													"<td><input name='Characteristic' type='radio' value='" + 
																		SubCharacteristics[i].ID_SubChar + "'</td></tr>");
		}
	};

	//Дополнить форму для предоставления таблицы с полным перчнем характеристик выбранной подкатегории
	//Отправить GET-запрос на сервер (GetAllSubCategory), чтобы получить перечень подкатегорий
	function ShowSubCharacteristics() {
		GetAllSubCategory(function(AllSubCategory) {
			ResponeForChar(AllSubCategory);
			$('#Response').append("<button id='ShowSubCategoryTable'>Показать</button>");
		});
	};

	//Дополнить форму форму для добавления новой характеристики, для подкатегории
	//Отправить GET-запрос на сервер (GetAllSubCategory), чтобы получить перечень подкатегорий
	function AddCharFromSub() {
		GetAllSubCategory(function(AllSubCategory) {
			ResponeForChar(AllSubCategory);
			$('#Response').append("<label>Введите новую характеристику и значение подкатегории: </label>");
			$('#Response').append("<input type='text' id='NewCharForSub'/>  ");
			$('#Response').append("<input type='text' id='NewValueForCharSub'/>");
			$('#Response').append("<br><button id='InsertNewCharForSub'>Добавить</button>");
		});
	};

	//Дополнить форму для редактирования характеристик подкатегории
	//Отправить GET-запрос на сервер (GetAllSubCategory), чтобы получить перечень подкатегорий
	function RedactCharFromSub() {
		GetAllSubCategory(function(AllSubCategory) {
			ResponeForChar(AllSubCategory);
			$('#Response').append("<button id='ShowCharSubForRedact'>Отобразить характеристики</button>");
		});
	};

	//Дополнить форму для удаления характеристики подкатегории
	//Отправить GET-запрос на сервер (GetAllSubCategory), чтобы получить перечень категорий 
	function DeleteCharFromSub() {
		GetAllSubCategory(function(AllSubCategory) {
			ResponeForChar(AllSubCategory);
			$('#Response').append("<button id='ShowCharSubForDelete'>Отобразить характеристики</button>");
		});
	};

	//Функция для вывода таблицы брендов.
	//На вход посутпает массив брендов с полями: ID_BREND, Name.
	function BrendTable(AllBrends) {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#ResponseTable').append("<table width='700' border='1'></table>")
		$('#ResponseTable').find('table').append("<tr><td>№</td><td>Наименование бренда</td>");
		for (var i = 0; i < AllBrends.length; i++) {
			$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
														"<td id='BrendName" + AllBrends[i].ID_BREND + "'>" + 
																		AllBrends[i].Name + "</td>" + 
														"<td><input name='Brend' type='radio' value='" + 
																AllBrends[i].ID_BREND + "'</td></tr>");
		}
	}

	////Отобразить перечень брендов в виде таблицы
	//Вызвать функцию GetAllBrends и занести полученные данные в таблицу
	function ShowAllBrend() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllBrends(function(AllBrends) {
			$('#ResponseTable').append("<table width='700' border='1'></table>")
			$('#ResponseTable').find('table').append("<tr><td>№</td><td>Наименование бренда</td>");
			for (var i = 0; i < AllBrends.length; i++) {
				$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
															"<td>" + AllBrends[i].Name + "</td></tr>");
			}
		}); 
	};

	//Отобразить форму для добавления нового бренда
	function AddBrend() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#Response').append("<label>Введите название бренда: </label>");
		$('#Response').append("<input type='text' id='BrendName'/>");
		$('#Response').append("<br><button id='AddBrendName'>Добавить</button>")
	};

	//Отобразить форму для удаления бренда
	function DeleteBrend() {
		GetAllBrends(function(AllBrends) {
			BrendTable(AllBrends);
			$('#ResponseTable').append("<button id='DeleteBrendName'>Удалить</button>");
		});
	}

	//Отобразить форму для редактирования бренда
	function UpdateBrend() {
		GetAllBrends(function(AllBrends) {
			BrendTable(AllBrends);
			$('#ResponseTable').append("<label>Исправьте название бренда: </label>");
			$('#ResponseTable').append("<input type='text' id='NameBrend'/>  ");
			$('#ResponseTable').append("<br><button id='UpdateNameBrendButton'>Редактировать</button>")
		});
	};

	//Функция для вывода таблицы материалов.
	//На вход посутпает массив материалов с полями: ID_MATERIAL, Name.
	function MaterialsTable(AllMaterials) {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#ResponseTable').append("<table width='700' border='1'></table>")
		$('#ResponseTable').find('table').append("<tr><td>№</td><td>Наименование материала</td>");
		for (var i = 0; i < AllMaterials.length; i++) {
			$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
														"<td id='MaterialName" + AllMaterials[i].ID_MATERIAL + "'>" + 
																		AllMaterials[i].Name + "</td>" + 
														"<td><input name='Material' type='radio' value='" + 
																AllMaterials[i].ID_MATERIAL + "'</td></tr>");
		}
	}

	//Отобразить перечень материалов в виде таблицы
	//Вызвать функцию GetAllMaterials и занести полученные данные в таблицу
	function ShowAllMaterials() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllMaterials(function(AllMaterials) {
			$('#ResponseTable').append("<table width='700' border='1'></table>")
			$('#ResponseTable').find('table').append("<tr><td>№</td><td>Наименование материала</td>");
			for (var i = 0; i < AllMaterials.length; i++) {
				$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
															"<td>" + AllMaterials[i].Name + "</td></tr>");
			}
		});
	};



	//Отобразить форму для добавления нового материала
	function AddMaterial() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#Response').append("<label>Введите название материала: </label>");
		$('#Response').append("<input type='text' id='MaterialName'/>");
		$('#Response').append("<br><button id='AddMaterialName'>Добавить</button>")
	}

	//Отобразить форму для удаления выбранного из таблицы материала
	function DeleteMaterial() {
		GetAllMaterials(function(AllMaterials) {
			MaterialsTable(AllMaterials);
			$('#ResponseTable').append("<button id='DeleteMaterialName'>Удалить</button>");
		});
	};

	//Отобразить форму для редактирования выбранного из таблицы материала
	function UpdateMaterial() {
		GetAllMaterials(function(AllMaterials) {
			MaterialsTable(AllMaterials);
			$('#ResponseTable').append("<label>Исправьте название материала: </label>");
			$('#ResponseTable').append("<input type='text' id='NameMaterial'/>  ");
			$('#ResponseTable').append("<br><button id='UpdateNameMaterialButton'>Редактировать</button>")
		});
	}
</script>


@endsection()