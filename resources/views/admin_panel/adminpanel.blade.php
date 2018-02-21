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
		width: 30%;
		float: left;
	}

	#RightBlock {
		width: 70%;
		float: right;
	}

	td {
		text-align: center;
	}

	table {
		width: 100%;
		table-layout: fixed;
		word-wrap: break-word;
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
					<dd><a onclick="ShowAllProducts()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddProduct()" href="#" role="button">Добавить</a></dd>
					<dd><a onclick="DeleteProduct()" href="#" role="button">Удалить</a></dd>
					<dd><a onclick="RedactProduct()" href="#" role="button">Редактировать</a></dd>
					<dd><a onclick="AddSecondPhoto()" href="#" role="button">Добавить изображение для карточки товара</a></dd>
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
					<dd><a onclick="ShowAllModels()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddModel()" href="#" role="button">Добавить</dd>
					<dd><a onclick="DeleteModel()" href="#" role="button">Удалить</a></dd>
					<dd><a onclick="UpdateModel()" href="#" role="button">Редактировать</a></dd>
				</span>
			<dt><a onclick="hidetext('List8')" href="#" role="button">Страны</a></dt>
				<span id="List8">
					<dd><a onclick="ShowAllCountrys()" href="#" role="button">Просмотреть</a></dd>
					<dd><a onclick="AddCountry()" href="#" role="button">Добавить</a></dd>
					<dd><a onclick="DeleteCountry()" href="#" role="button">Удалить</a></dd>
					<dd><a onclick="UpdateCountry()" href="#" role="button">Редактировать</a></dd>
				</span>
			<dt><a onclick="hidetext('List9')" href="#" role="button">Заказы</a></dt>
				<span id="List9">
					<dd><a onclick="ShowAllOrders()" href="#" role="button">Просмотреть статус заказа</a></dd>
					<dd><a onclick="ShowAllOrdersProducts()" href="#" role="button">Просмотреть товары заказа</a></dd>
					<dd><a onclick="ShangeStatusOrder()" href="#" role="button">Изменить статус заказа</a></dd>
				</span>
			<dt><a onclick="hidetext('List10')" href="#" role="button">Количество товара</a></dt>
				<span id="List10">
					<dd><a onclick="ShowCountProduct()" href="#" role="button">Просмотреть и редактировать</a></dd>
				</span>
			<dt><a onclick="hidetext('List11')" href="#" role="button">Почта</a></dt>
				<span id="List11">
					<dd><a onclick="ShowAllMessages()" href="#" role="button">Просмотреть письма</a></dd>
				</span>
			<dt><a onclick="hidetext('List12')" href="#" role="button">Почты для рассылки</a></dt>
				<span id="List12">
					<dd><a onclick="ShowAllEmails()" href="#" role="button">Просмотреть список</a></dd>
				</span>
			<dt><a onclick="hidetext('List13')" href="#" role="button">Новости</a></dt>
				<span id="List13">
					<dd><a onclick="ShowAllNews()" href="#" role="button">Просмотреть новости</a></dd>
					<dd><a onclick="AddNews()" href="#" role="button">Добавить новость</a></dd>
					<dd><a onclick="DeleteNews()" href="#" role="button">Удалить новость</a></dd>
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

	function AddNews() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#Response').append("<label>Введите название новости: </label>");
		$('#Response').append("<input type='text' id='LabelNews'/>");

		$('#Response').append("<br><label>Введите краткое описание новости: </label>");
		$('#Response').append("<textarea rows='5' cols='70' name='text' id='SmallDescrNews'></textarea>");

		$('#Response').append("<br><label>Введите описание новости: </label>");
		$('#Response').append("<textarea rows='15' cols='70' name='text' id='DescriptionProduct'></textarea>");
		$('#ResponseTable').append("<button id='ButtonAddNews'>Добавить</button>");
	};

	$('body').on('click', '#ButtonAddNews', function() {
		AddNewNews( $('#LabelNews').val(), $('#SmallDescrNews').val(), $('#DescriptionProduct').val() );
	});

	function DeleteNews() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllNews(function(AllNews) {
			$('#Response').append("<table width='1000' border='1'></table>")
			$('#Response').find('table').append("<tr><td>№</td><td>Название</td>" + 
														"<td>Краткое описание</td><td>Описание</td><td>Дата</td></tr>");
			for (var i = 0; i < AllNews.length; i++) {
				$('#Response').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
													"<td>" + AllNews[i]['Label'] + "</td>" +
													"<td>" + AllNews[i]['ShortText'] + "</td>" +  
													"<td>" + AllNews[i]['Text'] + 
													"<td>" + AllNews[i]['Date'] + 
													"<td><input name='NewsId' type='radio' value='" +
																	AllNews[i]['id'] + "'</td></tr>");
			}
			$('#ResponseTable').append("<button id='ButtonDeleteNews'>Удалить выбранную новость</button>");
		});
	};

	$('body').on('click', '#ButtonDeleteNews', function() {
		DeleteCurrentNews( $('input[name="NewsId"]:checked').val() );
	});


	function ShowAllNews() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllNews(function(AllNews) {
			$('#Response').append("<table width='1000' border='1'></table>")
			$('#Response').find('table').append("<tr><td>№</td><td>Название</td>" + 
														"<td>Краткое описание</td><td>Описание</td><td>Дата</td></tr>");
			for (var i = 0; i < AllNews.length; i++) {
				$('#Response').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
													"<td>" + AllNews[i]['Label'] + "</td>" +
													"<td>" + AllNews[i]['ShortText'] + "</td>" +  
													"<td>" + AllNews[i]['Text'] + 
													"<td>" + AllNews[i]['Date'] + "</td></tr>");
			}
		});

	}


	function ShowAllMessages() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllMessages(function(AllMessages) {
			$('#Response').append("<table width='1000' border='1'></table>")
			$('#Response').find('table').append("<tr><td>№</td><td>От кого</td>" + 
														"<td>Почта</td><td>Сообщение</td></tr>");
			for (var i = 0; i < AllMessages.length; i++) {
				$('#Response').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
													"<td>" + AllMessages[i]['From'] + "</td>" +
													"<td>" + AllMessages[i]['Email From'] + "</td>" +  
													"<td>" + AllMessages[i]['Text'] + "</td></tr>");
			}
		});
	};

	function ShowAllEmails() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllEmails(function(AllEmails) {
			$('#Response').append("<table width='1000' border='1'></table>")
			$('#Response').find('table').append("<tr><td>№</td><td>Почта</td></tr>");
			for (var i = 0; i < AllEmails.length; i++) {
				$('#Response').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
													"<td>" + AllEmails[i]['Email'] + "'</td></tr>");
			}
		});
	}

	function AddFirstPhoto() {
		$("#ResponseTable").empty();
		$('#ResponseTable').append("<br><label>Выберите лицевое изображение товара: </label>");
				$('#ResponseTable').append("<form action='/admin/AddFirstPic' enctype='multipart/form-data' method='post'>" + 
											"<input name='_token' type='hidden' value='{{ csrf_token() }}'/>" + 
											"<div class='form-group'>" + 
											"<input type='file' name='img' accept='image/jpeg'/>" + 
											"<button type='submit' class='btn btn-default btn-block'>Занести в базу</button>" + 
											"</form>");
	};

	function RedactProduct() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllSubCategory(function(AllSubCategory) {
			$('#Response').append("<br><label id='labelSubCategoty'>Выберите подкатегорию товара: <label>");
			$('#Response').append("<br><select id='RedactCategoryProduct'></select>");
			$('#RedactCategoryProduct').append("<option selected='selected' disabled>Выберите подкатегорию</option>");
			for (var i = 0; i < AllSubCategory.length; i++) {
				for (var j = 0; j < AllSubCategory[i].SubCategoryArray.length; j++) {
					$('#RedactCategoryProduct').append("<option value=" + AllSubCategory[i].SubCategoryArray[j].ID_SUBCATEGORY + ">" + 
																		AllSubCategory[i].SubCategoryArray[j].Name + "</option>");

				}
			}
		});
	}


	$('body').on("change", '#RedactCategoryProduct', function() {
		$("#ResponseTable").empty();
		$("#labelProduct").remove()
		$("#SelectProduct").remove();		
		GetAllProducts(function(AllProducts) {
				$('#Response').append("<label id='labelProduct'><br>Выберите артикул товара: <label>");
				$('#Response').append("<select id='SelectProduct'></select>");
				$('#SelectProduct').append("<option selected='selected' disabled>Выберите артикул товара</option>")
				var Vendore;
				for (var i = 0; i < AllProducts.length; i++) {
					if (i == 0)
						Vendore = AllProducts[i].VendoreCode;
					$('#Response').find("#SelectProduct").append("<option value=" + AllProducts[i].VendoreCode + ">" + 
																			AllProducts[i].VendoreCode + "</option>");
				}
			},$('#RedactCategoryProduct').val());
	});



	$('body').on('click', '#SelectProduct', function() {
		GetOneProduct(function(CoutProduct) {
			$("#ResponseTable").empty();
			$('#ResponseTable').append("<form action='/admin/UpdateOneProduct' enctype='multipart/form-data' method='post'>" + 
											"<input name='_token' type='hidden' value='{{ csrf_token() }}'/>" +  
											"<div class='form-group'>" +

											"<label hidden='true'>Артикул продукта: </label>" +  "<input type='text' hidden='true' name='VendoreCode' id='VendoreCode' value='" + CoutProduct[0]['VENDOR_CODE'] + "'/>" +

											"<label>Артикул поставщика: </label>" + "<input type='text' name='VendoreCodeProvider' id='VendoreCodeProvider' value='" + CoutProduct[0]['VENDOR_CODE_PROVIDER']  + "'/>" +

											"<br><label>Изменить лицевое изображение: </label>" + "<input type='file' name='img' accept='image/jpeg'/>" + 
											
											"<br><label>Ширина продукта: </label>" + "<input type='text' name='WidthProduct' id='WidthProduct' value='" + CoutProduct[0]['Width'] + "'/>" + 

											"<br><label>Высота продукта: </label>" + "<input type='text' name='HeightProduct' id='HeightProduct' value='" + CoutProduct[0]['Height'] + "'/>" + 

											"<br><label>Длина продукта: </label>" + "<input type='text' name='LengthProduct' id='LengthProduct' value='" + CoutProduct[0]['length'] + "'/>" +

											"<br><label>Вес продукта: </label>" + "<input type='text' name='WeightProduct' id='WeightProduct' value='" + CoutProduct[0]['Weight'] + "'/>" +

											"<br><label>Категория: </label>" + 
											"<input id='checked1' name='CharacteristicProduct' type='radio' value='1'> Новинка" + 
											"<input id='checked2' name='CharacteristicProduct' type='radio' value='2'> Рекомендация" +
											"<input id='checked3' name='CharacteristicProduct' type='radio' value='3'> Лидер" + 
											"<input id='checked4' name='CharacteristicProduct' type='radio' value='4'> Ничего" +

											"<br><label>Цена продукта: </label>" + "<input type='text' name='PriceProduct' id='PriceProduct' value='" + CoutProduct[0]['Price'] + "'/>" +

											"<br><label>Бренд: </label>" + "<select name='BrendSelect' id='BrendSelect'></select>" +

											"<br><label>Модель: </label>" + "<select name='ModelSelect' id='ModelSelect'></select>" +

											"<br><label>Страна: </label>" + "<select name='CountrySelect' id='CountrySelect'></select>" +

											"<br><label>Материал: </label>" + "<select name='MaterialSelect' id='MaterialSelect'></select>" +

											"<br><label>Подкатегория: </label>" + "<select name='SubCategorySelect' id='SubCategorySelect'></select>" +

											"<br><label>Описание продукта: </label>" + "<textarea rows='15' cols='70' name='text' id='DescriptionProduct'>" + CoutProduct[0]['Description'] + "</textarea>" +

											"</div>" + 
											"<button type='submit' class='btn btn-default btn-block'>Редактировать</button>" +
											"</form>");

			GetAllBrends(function(AllBrends) {
			for (var i = 0; i < AllBrends.length; i++) {
				if (AllBrends[i].ID_BREND == CoutProduct[0]['ID_BREND'])
					$('#BrendSelect').append("<option selected='selected' value=" + AllBrends[i].ID_BREND + ">" + 
																		AllBrends[i].Name + "</option>");
				else
					$('#BrendSelect').append("<option value=" + AllBrends[i].ID_BREND + ">" + 
																		AllBrends[i].Name + "</option>");
			}
		});

		GetAllModels(function(AllModels) {
			for (var i = 0; i < AllModels.length; i++) {
				if (AllModels[i].ID_MODEL == CoutProduct[0]['ID_MODEL'])
					$('#ModelSelect').append("<option selected='selected' value=" + AllModels[i].ID_MODEL + ">" + 
																		AllModels[i].Name + "</option>");
				else
					$('#ModelSelect').append("<option value=" + AllModels[i].ID_MODEL + ">" + 
																		AllModels[i].Name + "</option>");
			}
		});

		GetAllCountrys(function(AllCountrys) {
			for (var i = 0; i < AllCountrys.length; i++) {
				if (AllCountrys[i].ID_COUNTRY == CoutProduct[0]['ID_COUNTRY'])
					$('#CountrySelect').append("<option selected='selected' value=" + AllCountrys[i].ID_COUNTRY + ">" + 
																		AllCountrys[i].Name + "</option>");
				else
					$('#CountrySelect').append("<option value=" + AllCountrys[i].ID_COUNTRY + ">" + 
																		AllCountrys[i].Name + "</option>");
			}
		});

		GetAllMaterials(function(AllMaterials) {
			for (var i = 0; i < AllMaterials.length; i++) {
				if (AllMaterials[i].ID_MATERIAL == CoutProduct[0]['ID_MATERIAL'])
					$('#MaterialSelect').append("<option selected='selected' value=" + AllMaterials[i].ID_MATERIAL + ">" + 
																		AllMaterials[i].Name + "</option>");
				else
					$('#MaterialSelect').append("<option value=" + AllMaterials[i].ID_MATERIAL + ">" + 
																		AllMaterials[i].Name + "</option>");
			}
		});

		GetAllSubCategory(function(AllSubCategory) {
			for (var i = 0; i < AllSubCategory.length; i++) {
				for (var j = 0; j < AllSubCategory[i].SubCategoryArray.length; j++) {
					if (AllSubCategory[i].ID_SUBCATEGORY == CoutProduct[0]['ID_SUBCATEGORY'])
						$('#SubCategorySelect').append("<option selected='selected' value=" + AllSubCategory[i].SubCategoryArray[j].ID_SUBCATEGORY + ">" + 
																		AllSubCategory[i].SubCategoryArray[j].Name + "</option>");
					else
						$('#SubCategorySelect').append("<option value=" + AllSubCategory[i].SubCategoryArray[j].ID_SUBCATEGORY + ">" + 
																		AllSubCategory[i].SubCategoryArray[j].Name + "</option>");

				}
			}
		});

		if (CoutProduct[0]['IsNew'] != '0')
			$('#checked1').attr('checked', true);
		else if (CoutProduct[0]['IsLeader'] != '0')
			$('#checked3').attr('checked', true);
		else if (CoutProduct[0]['IsRecomend'] != '0')
			$('#checked2').attr('checked', true);
		else
			$('#checked4').attr('checked', true);

		}, $('#SelectProduct').val());
	});

	function AddSecondPhoto() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllSubCategory(function(AllSubCategory) {
			$('#Response').append("<br><select id='SubCategoryProduct'></select>");
			$('#SubCategoryProduct').append("<option selected='selected' disabled>Выберите подкатегорию</option>");
			for (var i = 0; i < AllSubCategory.length; i++) {
				for (var j = 0; j < AllSubCategory[i].SubCategoryArray.length; j++) {
					$('#SubCategoryProduct').append("<option value=" + AllSubCategory[i].SubCategoryArray[j].ID_SUBCATEGORY + ">" + 
																		AllSubCategory[i].SubCategoryArray[j].Name + "</option>");

				}
			}
		});
	};

	$('body').on("change", '#SubCategoryProduct', function() {
		$("#ResponseTable").empty();
		GetAllProducts(function(AllProducts) {
				$('#ResponseTable').append("<label id='labelProduct'>Выберите артикул товара: <label>");
				$('#ResponseTable').append("<select id='NewProducts'></select>");
				var Vendore;
				for (var i = 0; i < AllProducts.length; i++) {
					if (i == 0)
						Vendore = AllProducts[i].VendoreCode;
					$('#ResponseTable').find("select").append("<option value=" + AllProducts[i].VendoreCode + ">" + 
																			AllProducts[i].VendoreCode + "</option>");
				}
				$('#ResponseTable').append("<br><label>Выберите второстепенное изображение товара: </label>");
				$('#ResponseTable').append("<form action='/admin/AddSecondPic' enctype='multipart/form-data' method='post'>" + 
											"<input name='_token' type='hidden' value='{{ csrf_token() }}'/>" + 
											"<div class='form-group'>" + 
											"<input type='file' name='img' accept='image/jpeg'/>" +
											"<input hidden='true' type='text' name='vendore' value='" + Vendore + "'" + 
											"</div>" + 
											"<button type='submit' class='btn btn-default btn-block'>Добавить</button>" + 
											"</form>");
			},$('#SubCategoryProduct').val());
	});

	$('body').on('change', '#NewProducts', function() {
		$('input[name="vendore"]').val( $('#NewProducts').val() );
	})

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
			alert("kek");
			$('#ResponseTable').empty();
			GetAllProducts(function(AllProducts) {
				$('#ResponseTable').append("<label>Выберите артикул товара: <label>");
				$('#ResponseTable').append("<select id='NewProducts'></select><br>");
				for (var i = 0; i < AllProducts.length; i++) {
					$('#ResponseTable').find("select").append("<option value=" + AllProducts[i].VendoreCode + ">" + 
																			AllProducts[i].VendoreCode + "</option>");
				}
				$('#ResponseTable').append("<button id='ShowCharacteristicsProduct'>Просмотреть характеристики продукта</button>");
			}, $('#SubCategoryForChar').val());
			
		});

		$('body').on("click", '#ShowCharacteristicsProduct', function() {
			GetSubCharacteristics(function(SubCharacteristics) {
				$('#ResponseTable').find("table").remove();
				$('#ResponseTable').append("<table width='1000' border='1'></table>")
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
			},$("#NewProducts").val())
						// $('#ResponseTable').empty();
		});

		//Отловить нажатие на динамическую кнопку с id = InsertNewCharForSub
		//Отправляет POST-запрос на сервер
		//Записывает новую характеристику для подкатегории в таблицу
		$('body').on("click", "#InsertNewCharForSub", function() {
			//проверка на ввод названия новой характеристики
			if ( $('#NewCharForSub').val() != '' ) {
				//проверка на ввод значения новой характеристики для подкатегории в форму
				if ( $("#NewValueForCharSub").val() != '' )
					AddCharacteristicsSub($('#NewCharForSub').val(), $('#SubCategoryForChar').val());
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
			GetAllProducts(function(AllProducts) {
				if (AllProducts.length == 0) {
					alert("Данная подкатегория не имеет характеристик");
					return;
				}
				$('#ResponseTable').append("<label>Выберите артикул товара: <label>");
				$('#ResponseTable').append("<select id='NewProducts'></select><br>");
				for (var i = 0; i < AllProducts.length; i++) {
					$('#ResponseTable').find("select").append("<option value=" + AllProducts[i].VendoreCode + ">" + 
																			AllProducts[i].VendoreCode + "</option>");
				}
				$('#ResponseTable').append("<button id='ShowCharForRed'>Просмотреть характеристики продукта</button>");
			}, $('#SubCategoryForChar').val());
		});

		$('body').on("click", "#ShowCharForRed", function() {
			GetSubCharacteristics(function(SubCharacteristics) {
				$('#ResponseTable').find("table").remove();
				$("#NameCharEdit").remove();
				$("#ValueCharEdit").remove();
				$("#ReductCharForSubButton").remove();
				$('#labelRed').remove();
				$('#ResponseTable').append("<table width='1000' border='1'></table>")
				$('#ResponseTable').find('table').append("<tr><td>Номер</td><td>Наименование характеристики</td>" +
														"<td>Значение характеристики</td></tr>");

				//если у подхарактеристики имеется хоть 1 значение, то вывести его
				if (SubCharacteristics.length > 0) {
					for (var i = 0; i < SubCharacteristics.length; i++) {
						$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" +
																"<td id=CharName" + SubCharacteristics[i].ID_SubChar + ">" + SubCharacteristics[i].Characteristic + "</td>" + 
																"<td id=CharVal" + SubCharacteristics[i].ID_SubChar + ">" + SubCharacteristics[i].Value + "</td>" + 
																"<td><input name='CharProduct' type='radio' value='" +
																	SubCharacteristics[i].ID_SubChar + "'</td></tr>");
					}
					$('#ResponseTable').append("<label  id='labelRed'>Отредактируйте выбранную характеристику: </label>");
					$('#ResponseTable').append("<input type='text' id='NameCharEdit'/>  ");
					$('#ResponseTable').append("<input type='text' id='ValueCharEdit'/>");
					$('#ResponseTable').append("<button id='ReductCharForSubButton'>Редактировать</button>");
				}
				else {
					alert("Данная подкатегория не имеет характеристик");
					return;
				}
			},$("#NewProducts").val())
						// $('#ResponseTable').empty();
		});

		$('body').on("click", "input[name=CharProduct]", function() {
			$('#NameCharEdit').attr('value', $('#CharName' + $('input[name=CharProduct]:checked').val()).text() );
			$('#ValueCharEdit').attr('value', $('#CharVal' + $('input[name=CharProduct]:checked').val()).text() );
		});

		//Отлавливает нажатие на динамическую кнопку с id = ReductCharForSubButton
		//Отправляет AJAX PUT-запрос, чтобы редактировать выбранную характеристику подкатегории
		$('body').on("click", '#ReductCharForSubButton', function() {
			if ($('#CharName' + $('input[name=CharProduct]:checked').val()).text() == '') {
				alert("Вы не выбрали характеристику для изменения!");
				return;
			}
			else 
				PutCharacteristicsSub( $('input[name=CharProduct]:checked').val(), $('#NameCharEdit').val(), $('#ValueCharEdit').val() );
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
			GetAllProducts(function(AllProducts) {
				if (AllProducts.length == 0) {
					alert("Данная подкатегория не имеет характеристик");
					return;
				}
				$('#ResponseTable').append("<label>Выберите артикул товара: <label>");
				$('#ResponseTable').append("<select id='NewProducts'></select><br>");
				for (var i = 0; i < AllProducts.length; i++) {
					$('#ResponseTable').find("select").append("<option value=" + AllProducts[i].VendoreCode + ">" + 
																			AllProducts[i].VendoreCode + "</option>");
				}
				$('#ResponseTable').append("<button id='ButtonCharForDelete'>Просмотреть характеристики продукта</button>");
			}, $('#SubCategoryForChar').val());
		});

		$('body').on("click", "#ButtonCharForDelete" ,function() {
			GetSubCharacteristics(function(SubCharacteristics) {
				$('#ResponseTable').find("table").remove();
				$("#NameCharEdit").remove();
				$("#ValueCharEdit").remove();
				$("#DeleteCorrectCharProd").remove();
				$('#labelRed').remove();
				$('#ResponseTable').append("<table width='1000' border='1'></table>")
				$('#ResponseTable').find('table').append("<tr><td>Номер</td><td>Наименование характеристики</td>" +
														"<td>Значение характеристики</td></tr>");

				//если у подхарактеристики имеется хоть 1 значение, то вывести его
				if (SubCharacteristics.length > 0) {
					for (var i = 0; i < SubCharacteristics.length; i++) {
						$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" +
																"<td id=CharName" + SubCharacteristics[i].ID_SubChar + ">" + SubCharacteristics[i].Characteristic + "</td>" + 
																"<td id=CharVal" + SubCharacteristics[i].ID_SubChar + ">" + SubCharacteristics[i].Value + "</td>" + 
																"<td><input name='CharProduct' type='radio' value='" +
																	SubCharacteristics[i].ID_SubChar + "'</td></tr>");
					}
					$('#ResponseTable').append("<button id='DeleteCorrectCharProd'>Удалить</button>");
				}
				else {
					alert("Данная подкатегория не имеет характеристик");
					return;
				}
			},$("#NewProducts").val())
		})

		//Отловить нажатие на динамическую кнопку с id = DeleteCharForSubButton
		//Отправить AJAX DELTE-запрос, чтобы удалить выбранную характеристику у подкатегории
		//Передать на запрос значение из <radio>, который хранит идентификатор характеристики
		$('body').on("click", "#DeleteCorrectCharProd", function() {
			if ( $('#CharName' + $('input[name=CharProduct]:checked').val()).text() == '') {
				alert("Вы не выбрали характеристику для удаления!");
				return;
			}
			else 
				DeleteCharacteristicsSub( $('input[name=CharProduct]:checked').val() );
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

		//Отловить нажатие на динамическую кнопку с id = AddMaterialName
		//Отправить AJAX POST-запрос, чтобы добавить новый материал в БД
		//Передать по запросу значение элемента input=text id="MaterialName"
		$('body').on("click", "#AddCountryName", function() {
			if ( $('#CountryName').val() == '' ) {
				alert("Введите название страны!");
				return;
			}
			AddCountryName( $('#CountryName').val() );
		});

		//Отловить нажатие на динамическую кнопку с id = DeleteMaterialName
		//Отправить AJAX DELETE-запрос, чтобы удалить выбранный материал из таблицы
		//Передать по запросу выбранный <radio> элемент из таблицы
		$('body').on("click", "#DeleteCountryName", function() {
			//если <radio> не был выбран == undefined
			if ( $('input[name=Country]:checked').val() == undefined)  {
				alert("Вы не выбрали страну для удаления!");
				return;
			}
			//функция на отправку запроса на удаление бренда
			DeleteCountryName( $('input[name=Country]:checked').val() );
		});

		//Отловить изменения input <radio> с name = Country
		//Присвоить полю название страны для редактирования из таблицы
		$('body').on("click", 'input[name=Country]:checked', function() {
			$('#NameCountry').attr('value', $('#CountryName' + $('input[name=Country]:checked').val()).text() );
		});

		//Отловить нажатие на динамическую кнопку с id = UpdateNameCountryButton
		//Отправить AJAX PUT-запрос, чтобы редактировать выбранную страну из таблицы
		//Передать в запрос: идентификатор страны и отредактированное название страны
		$('body').on("click", "#UpdateNameCountryButton", function() {
			UpdateCountryName($('input[name=Country]:checked').val(), $('#NameCountry').val());
		});

		//Отловить нажатие на динамическую кнопку с id = AddModelName
		//Отправить AJAX POST-запрос, чтобы добавить новую модель в БД
		//Передать по запросу значение элемента input=text id="ModelName"
		$('body').on("click", "#AddModelName", function() {
			if ( $('#ModelName').val() == '' ) {
				alert("Введите название модели!");
				return;
			}
			AddModelName( $('#ModelName').val() );
		});

		//Отловить нажатие на динамическую кнопку с id = DeleteModelName
		//Отправить AJAX DELETE-запрос, чтобы удалить выбранную модель из таблицы
		//Передать по запросу выбранный <radio> элемент из таблицы
		$('body').on("click", "#DeleteModelName", function() {
			//если <radio> не был выбран == undefined
			if ( $('input[name=Model]:checked').val() == undefined)  {
				alert("Вы не выбрали модель для удаления!");
				return;
			}
			//функция на отправку запроса на удаление бренда
			DeleteModelName( $('input[name=Model]:checked').val() );
		});

		//Отловить изменения input <radio> с name = Model
		//Присвоить полю название модели для редактирования из таблицы
		$('body').on("click", 'input[name=Model]:checked', function() {
			$('#NameModel').attr('value', $('#ModelName' + $('input[name=Model]:checked').val()).text() );
		});

		//Отловить нажатие на динамическую кнопку с id = UpdateNameModelButton
		//Отправить AJAX PUT-запрос, чтобы редактировать выбранную модель из таблицы
		//Передать в запрос: идентификатор модели и отредактированное название модели
		$('body').on("click", "#UpdateNameModelButton", function() {
			UpdateModelName($('input[name=Model]:checked').val(), $('#NameModel').val());
		});

		//Отловить нажатие на динамическу кнопку с id = ShowProductsTable
		//Отправить AJAX GET-запрос, чтобы отобразить таблицу продуктов выбранной подкатегории
		//Передать в запрос: идентификатор подкатегории
		$('body').on('click', "#ShowProductsTable", function() {
			$('#ResponseTable').empty();
			// alert($('#SubCategoryForChar').val());
			GetAllProducts(function(AllProducts) {
				$('#ResponseTable').append("<table border='1' ></table>")
				$('#ResponseTable').find('table').append("<tr><td>№</td><td>Артикул товара</td>" + 
														"<td>Артикул поставщика</td><td>Подкатегория</td>" + 
														"<td>Наименование бренда</td><td>Наименование модели</td>" + 
														"<td>Наименование страны</td>" + "<td>Наименвоание материала</td>"+ 
														"<td>Наименование изображения</td>" + 
														"<td>Ширина</td><td>Всоты</td><td>Длина</td><td>Вес</td>" + 
														"<td>Статус</td><td>Цена</td></tr>");
				for (var i = 0; i < AllProducts.length; i++) {
					$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" +
																"<td>" + AllProducts[i]['VendoreCode'] + "</td>" +
																"<td>" + AllProducts[i]['VendoreCodeProvider'] + "</td>" +
																"<td>" + AllProducts[i]['SubName'] + "</td>" + 
																"<td>" + AllProducts[i]['BrendName'] + "</td>" +
																"<td>" + AllProducts[i]['ModelName'] + "</td>" +
																"<td>" + AllProducts[i]['CountryName'] + "</td>" +
																"<td>" + AllProducts[i]['MaterialName'] + "</td>" +
																"<td>" + AllProducts[i]['GeneralPic'] + "</td>" +
																"<td>" + AllProducts[i]['Weight'] + "</td>" +
																"<td>" + AllProducts[i]['Height'] + "</td>" +
																"<td>" + AllProducts[i]['Length'] + "</td>" +
																"<td>" + AllProducts[i]['Width'] + "</td>" +
																"<td>" + AllProducts[i]['Status'] + "</td>" + 
																"<td>" + AllProducts[i]['Price'] + "</td></tr>" +
																"<tr><td colspan='2'>Описание: </td><td colspan='13'>" + AllProducts[i]['Description'] + "</td></tr>");
				}
			}, $('#SubCategoryForChar').val());
		});

		//Вывести перечень продукторв в таблице с radio batton отправив для этого 
		//AJAX GET-запрос на получение перечня подкатегорий
		$('body').on("click", "#ShowProductsTableForDelete", function() {
			$('#ResponseTable').empty();
			// alert($('#SubCategoryForChar').val());
			GetAllProducts(function(AllProducts) {
				$('#ResponseTable').append("<table width='1000' border='1'></table>")
				$('#ResponseTable').find('table').append("<tr><td>№</td><td>Артикул товара</td>" + 
														"<td>Артикул поставщика</td><td>Подкатегория</td>" + 
														"<td>Наименование бренда</td><td>Наименование модели</td>" + 
														"<td>Наименование страны</td>" + "<td>Наименование материала</td>" +
														"<td>Наименование изображения</td>" + 
														"<td>Ширина</td><td>Всоты</td><td>Длина</td><td>Вес</td>" + 
														"<td>Статус</td><td>Цена</td></tr>");
				for (var i = 0; i < AllProducts.length; i++) {
					$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" +
																"<td>" + AllProducts[i]['VendoreCode'] + "</td>" +
																"<td>" + AllProducts[i]['VendoreCodeProvider'] + "</td>" +
																"<td>" + AllProducts[i]['SubName'] + "</td>" + 
																"<td>" + AllProducts[i]['BrendName'] + "</td>" +
																"<td>" + AllProducts[i]['ModelName'] + "</td>" +
																"<td>" + AllProducts[i]['CountryName'] + "</td>" +
																"<td>" + AllProducts[i]['MaterialName'] + "</td>" +
																"<td>" + AllProducts[i]['GeneralPic'] + "</td>" +
																"<td>" + AllProducts[i]['Weight'] + "</td>" +
																"<td>" + AllProducts[i]['Height'] + "</td>" +
																"<td>" + AllProducts[i]['Length'] + "</td>" +
																"<td>" + AllProducts[i]['Width'] + "</td>" +
																"<td>" + AllProducts[i]['Status'] + "</td>" +
																"<td>" + AllProducts[i]['Price'] + "</td>" +
																"<td><input name='VendorProduct' type='radio' value='" +
																	AllProducts[i]['VendoreCode'] + "'</td></tr>" + 
																"<tr><td></td><td>Описание: </td><td colspan='14'>" + AllProducts[i]['Description'] + "</td></tr>");
				}
				$('#ResponseTable').append("<button id='DeleteCurrentProduct'>Удалить</button>");
			}, $('#SubCategoryForChar').val());

		});

		//Отловить нажатие на динамическую кнопку с id = AddProduct
		//Отправить AJAX POST-запрос, чтобы добавить новый продукт в БД
		//Передать по запросу значение: 
		$('body').on("click", "#AddProduct", function() {
			if ( $('#DescriptionProduct').val() != '' ) {
			if ( $('#VendoreCode').val() != '' ) {
				if ( $('#VendoreCodeProvider').val() != '' ) {
					if ( $('#WeightProduct').val() != '' ) {
						if ( $('#WeightProduct').val() >= 0 ) {
							if ( $('#HeightProduct').val() != '' ) {
								if ( $('#HeightProduct').val() >= 0 ) {
									if ( $('#LengthProduct').val() != '' ) {
										if ( $('#LengthProduct').val() >= 0 ) {
											if ( $('#PriceProduct').val() != '' ) {
												if ( $('#PriceProduct').val() >= 0 ) {
													if (($('#BrendSelect').val() != null) && 
														($('#ModelSelect').val() != null) && 
														($('#CountrySelect').val() != null) && 
														($('#MaterialSelect').val() != null) &&
														($('#SubCategorySelect').val() != null)) {
															if ( $('#WidthProduct').val() != '' ) {
																if ( $('#WidthProduct').val() >= 0 ) {
																	AddNewProduct( 
																		$('#VendoreCode').val(),
																		$('#VendoreCodeProvider').val(),
																		$('input[name=NameFile]').val(),
																		$('#WeightProduct').val(),
																		$('#HeightProduct').val(),
																		$('#LengthProduct').val(),
																		$('#WidthProduct').val(),
																		$('input[name=CharacteristicProduct]:checked').val(),
																		$('#PriceProduct').val(),
																		$('#ModelSelect').val(),
																		$('#BrendSelect').val(),
																		$('#CountrySelect').val(),
																		$('#SubCategorySelect').val(),
																		$('#MaterialSelect').val(),
																		$('#DescriptionProduct').val()
																	);
																}
																else
																	alert("Ввееден не корректный вес товара");
															}
															else
																alert("Введие вес продукта");
														}
														else
															alert("Выберите все характеристики товара!");
												}
												else
													alert("Введена не корректная цена");
											}
											else
												alert("Введите цену продукта");
										}
										else
											alert("Введено не корректное значение длины");
									}
									else
										alert("Введите длину продукта");
								}
								else 
									alert("Введено не корректное значение высоты");
							}
							else
								alert("Введите высоту продукта");
						}
						else
							alert("Введено не корректное значение ширины");
					}
					else
						alert("Введите ширину продукта");
				}
				else
					alert("Введите артикул поставщика")
			}
			else
				alert("Введите артикул продукта");
		}
		else
			alert("Введите описание продукта");
		});

		//Отловить нажатие на динамическую кнопку с id = DeleteCurrentProduct
		//Отправить AJAX DELETE-запрос, чтобы удалить выбранный продукт из таблицы
		//Передать по запросу выбранный <radio> элемент из таблицы
		$('body').on("click", "#DeleteCurrentProduct", function() {
			DeleteCurentProduct( $('input[name=VendorProduct]:checked').val() );
		});

		//Отловить нажатие на динамическу кнопку с id = ShowProductTableWithCount
		//Отправить AJAX GET-запрос, чтобы отобразить таблицу артикула и количества продуктов выбранной подкатегории
		//Передать в запрос: идентификатор подкатегории
		$('body').on("click", "#ShowProductTableWithCount", function() {
			$('#ResponseTable').empty();
			GetAllProductsWithCount(function(AllProducts) {
				$('#ResponseTable').append("<table width='1000' border='1'></table>")
				$('#ResponseTable').find('table').append("<tr><td>№</td><td>Артикул товара</td>" + 
														"<td>Количество товара</td></tr>");
				for (var i = 0; i < AllProducts.length; i++) {
					$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" +
																"<td>" + AllProducts[i]['VendoreCode'] + "</td>" +
																"<td id='Count" + AllProducts[i]['VendoreCode'] + "'>" +
																 			AllProducts[i]['Count']  + "</td>" +
																"<td><input name='VendorProduct' type='radio' value='" +
																	AllProducts[i]['VendoreCode'] + "'</td></tr>");
				}
				$('#ResponseTable').append("<label>Отредактировать количество товара: </label>");
				$('#ResponseTable').append("<input type='text' id='CountProductLabel'/>  ");
				$('#ResponseTable').append("<button id='CountProductButton'>Редактировать</button>");
			}, $('#SubCategoryForChar').val());
		});

		//Отловить изменения input <radio> с name = VendorProduct
		//Присвоить полю количество товара для редактирования из таблицы
		$('body').on("click", 'input[name=VendorProduct]:checked', function() {
			$('#CountProductLabel').attr('value', $('#Count' + $('input[name=VendorProduct]:checked').val()).text() );
		});

		//Отловить нажатие на кнопку с id = CountProductButton
		//Вызвать запрос на обновление количества товара в таблеце БД
		//Параметры которые передаются с запросом: Артикул товара, новое количество товара
		$('body').on("click", "#CountProductButton", function() {
			UpdateCountProduct($('input[name=VendorProduct]:checked').val(), $('#CountProductLabel').val());
		});

		//Отловить нажатие на кнопку с id = ShowOrderDetails
		//Вызвать запрос для отображения таблицы с перечнем продуктов выбранного заказа из таблецы БД
		//Параметры которые передаются с запросом: Номер заказа
		$('body').on("click", "#ShowOrderDetails", function() {
			$('#ResponseTable').empty();
			if ($('input[name=OrderNumber]:checked').val() == undefined)
				alert("Вы не выбрали заказ!");
			else {
				GetALlOrdersWithProducts(function(AllOrders) {
					$('#ResponseTable').append("<br><br>Заказ №" + $('input[name=OrderNumber]:checked').val());
					$('#ResponseTable').append("<table id='TableOrder' width='700' border='1'></table>")
					$('#TableOrder').append("<tr><td>Артикул товара</td><td>Подкатегория товара</td>" +
															"<td>Количество</td></tr>");
					if (AllOrders.length > 0) {
						for (var i = 0; i < AllOrders.length; i++) {
							$('#TableOrder').append("<tr><td>" + AllOrders[i]['VendoreCode'] + "</td>" +
															"<td>" + AllOrders[i]['SubCategoryName'] + 
															"<td>" + AllOrders[i]['Count'] + "</td></tr>");
						}
					}
					else
						$('#ResponseTable').append("У данного заказа нет товаров!");
				}, $('input[name=OrderNumber]:checked').val());
			}
		});

		//Отловить нажатие на кнопку с id = ChangeStatusOrderButton
		//Вызвать запрос для изменения статуса заказа в таблице БД
		//Параметры которые передаются с запросом: Номер заказа, номер статуса заказа
		$('body').on("click", "#ChangeStatusOrderButton", function() {
			if ($('input[name=OrderNumber]:checked').val() == undefined)
				alert("Вы не выбрали заказ!");
			else {
				UpdateStatusOrder($('input[name=OrderNumber]:checked').val(), $("#NewStatusOrder").val());
			}
		});

		// GetAllSubCategory(function(AllSubCategory) {
		// 	ResponeForChar(AllSubCategory);
		// 	$('#Response').append("<button id='ShowProductsTableForDeleteUpdate'>Показать</button>");
		// });
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
	//Параметры массива: Characteristics, Value, id_subchar
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
	function AddCharacteristicsSub(CharName, ID_SubCategory) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: "/admin/AddSubCatChar",
			data: {_token: CSRF_TOKEN, nameChar: CharName, 
					id_subCategory: ID_SubCategory},
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

	//функция, которая отправляет AJAX GET-запрос на сервер
	//Если response === 200, то возвращает перечень всех стран из БД, как массив объектов
	//Параметры массива: ID_COUNTRY, Name
	function GetAllCountrys(AllCountrys) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetCountry",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllCountrys(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	};

	//Функция, которгая отсылает AJAX POST-запрос на сервер
	//Если response === 200, то добавляет новый материал в БД
	//Параметры, которые надо передать на сервер: Название материала
	function AddCountryName(CountryName) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: "/admin/AddCountry",
			data: {_token: CSRF_TOKEN, CountryName: CountryName},
			success: function(data) {
				alert("Новая страна успешно добавлена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX DELETE-запрос на сервер
	//Если response === 200, то удаляет выбранную ранее страну из БД
	//Параметры, которые надо передать на сервер: Идентификатор страны, которую надо удалить
	function DeleteCountryName(id_Country) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "DELETE",
			url: "/admin/DeleteCountry",
			data: {_token: CSRF_TOKEN, id_Country: id_Country},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранная страна успешно удалена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX PUT-запрос на сервер
	//Если response === 200, то изменяет выбранную ранее страну в БД
	//Параметры, которые надо передать на сервер: Идентификатор страны, новое название страны
	function UpdateCountryName(id_Country, CountryName) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "PUT",
			url: "/admin/UpdateCountry",
			data: {_token: CSRF_TOKEN, id_Country: id_Country, CountryName: CountryName},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранная страна успешно изменена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//функция, которая отправляет AJAX GET-запрос на сервер
	//Если response === 200, то возвращает перечень всех моделей из БД, как массив объектов
	//Параметры массива: ID_MODEL, Name
	function GetAllModels(AllModels) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetModel",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllModels(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	};

	//Функция, которгая отсылает AJAX POST-запрос на сервер
	//Если response === 200, то добавляет новую модель в БД
	//Параметры, которые надо передать на сервер: Название модели
	function AddModelName(ModelName) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: "/admin/AddModel",
			data: {_token: CSRF_TOKEN, ModelName: ModelName},
			success: function(data) {
				alert("Новая модель успешно добавлена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX DELETE-запрос на сервер
	//Если response === 200, то удаляет выбранную ранее модель из БД
	//Параметры, которые надо передать на сервер: Идентификатор модели, которую надо удалить
	function DeleteModelName(id_Model) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "DELETE",
			url: "/admin/DeleteModel",
			data: {_token: CSRF_TOKEN, id_Model: id_Model},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранная модель успешно удалена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX PUT-запрос на сервер
	//Если response === 200, то изменяет выбранную ранее модель в БД
	//Параметры, которые надо передать на сервер: Идентификатор модели, новое название модели
	function UpdateModelName(id_Model, ModelName) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "PUT",
			url: "/admin/UpdateModel",
			data: {_token: CSRF_TOKEN, id_Model: id_Model, ModelName: ModelName},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранная модель успешно изменена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX GET-запрос на север
	//Если response === 200, то возвращает перечень всех продуктов в БД,как массив объектов
	//Параметры массива: VendoreCode, Count
	function GetAllProductsWithCount(AllProducts, id_SubCategory) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/CountProduct",
			data: {_token: CSRF_TOKEN, id_SubCategory: id_SubCategory},
			success: function(data) {
				AllProducts(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которгая отсылает AJAX POST-запрос на сервер
	//Если response === 200, то добавляет новую модель в БД
	//Параметры, которые надо передать на сервер: Артикул продукта, Артикул поставщика, путь главной картинки,
													// ширину продукта, высоту продукта, длину продукта, вес продукта,
													// категорию, цену продукта, идентификатор модели, идентификатор бренда,
													// идентификатор страны, идентификатор подкатегории, идентификатор материала
	function AddNewProduct(VendoreCode, VendoreProvider, FileName, Weight, Height, Length, Width, CategoryNumber, Price,
						id_Model, id_Brend, id_Country, id_SubCategory, id_Material, Description) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: "/admin/AddProduct",
			data: {_token: CSRF_TOKEN, VendoreCode: VendoreCode, VendoreProvider: VendoreProvider,
										FileName: FileName, Weight: Weight, Height: Height, Length: Length,
										Width: Width, CategoryNumber: CategoryNumber, Price: Price,
										id_Model: id_Model, id_Brend: id_Brend, id_Country: id_Country, 
										id_SubCategory: id_SubCategory, id_Material: id_Material, Description: Description},
			dataType: 'JSON',
			success: function(data) {
				alert("Новый товар успешно добавлен!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX DELETE-запрос на сервер
	//Если response === 200, то удаляет выйбранный товар  из БД
	//Параметры, которые надо передать на сервер: Артикул товара
	function DeleteCurentProduct(VendoreCode) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "DELETE",
			url: "/admin/DeleteProduct",
			data: {_token: CSRF_TOKEN, VendoreCode: VendoreCode},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранный товар успешно удален!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX GET-запрос на север
	//Если response === 200, то возвращает перечень всех продуктов и их кол-во в магазине из БД,как массив объектов
	//Параметры массива: VENDORE_CODE, Count
	function GetAllProductsCount(AllProducts, id_SubCategory) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/CountProduct",
			data: {_token: CSRF_TOKEN, id_SubCategory: id_SubCategory},
			success: function(data) {
				AllProducts(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX GET-запрос на север
	//Если response === 200, то возвращает перечень всех продуктов из БД,как массив объектов
	//Параметры массива: VENDORE_CODE, SubName, BrendName, ModelName, CountryName, PictureName, VendoreCodeProvide,
	//					Width, Length, Height, Weight, Status, Price, MaterialName, SecondPicArray
	function GetAllProducts(AllProducts, id_SubCategory) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetProduct",
			data: {_token: CSRF_TOKEN, id_SubCategory: id_SubCategory},
			success: function(data) {
				AllProducts(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	//Функция, которая посылает AJAX PUT-запрос на сервер
	//Если response === 200, то изменяет количество выбранного товара в БД
	//Параметры, которые надо передать на сервер: Артикул товара, новое колиество товара
	function UpdateCountProduct(VendoreCode, Count) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "PUT",
			url: "/admin/UpdateCountProduct",
			data: {_token: CSRF_TOKEN, VendoreCode: VendoreCode, Count: Count},
			success: function(data) {
				alert("Количество товара успешно изменено!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}



	//Функция, которая посылает AJAX GET-запрос на север
	//Если response === 200, то возвращает перечень всех заказов и их статус из БД,как массив объектов
	//Параметры массива: id_Order, email, status
	function GetAllOrdersWithStatus(AllOrders) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetOrdersStatus",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllOrders(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});	
	}

	//Функция, которая посылает AJAX GET-запрос на север
	//Если response === 200, то возвращает перечень всех продукторв определенного заказа  из БД,как массив объектов
	//Параметры массива: VendoreCode, SubCategoryName
	function GetALlOrdersWithProducts(AllOrders, id_Order) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetOrdersProducts",
			data: {_token: CSRF_TOKEN, id_Order: id_Order},
			success: function(data) {
				AllOrders(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});	
	}

	//Функция, которая посылает AJAX GET-запрос на север
	//Если response === 200, то возвращает перечень всех статусов для заказа  из БД,как массив объектов
	//Параметры массива: ID_STATUSORDER, Name
	function GetAllStatus(AllStatuses) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetAllStatus",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllStatuses(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});	
	}

	//Функция, которая посылает AJAX PUT-запрос на сервер
	//Если response === 200, то изменяет статус выбранного заказа в БД
	//Параметры, которые надо передать на сервер: номер заказа, номер нового статуса
	function UpdateStatusOrder(id_Order, id_Status) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "PUT",
			url: "/admin/UpdateStatusOrder",
			data: {_token: CSRF_TOKEN, id_Order: id_Order, id_Status: id_Status},
			success: function(data) {
				alert("Статус выбранного заказа успешно изменен!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});	
	}

	function GetAllMessages(AllMessages) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetAllMessages",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllMessages(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});	
	}

	function GetAllMessages(AllMessages) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetAllMessages",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllMessages(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});	
	}

	function GetAllEmails(AllEmails) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/getAllEmail",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllEmails(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	function GetAllNews(AllNews) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetAllNews",
			data: {_token: CSRF_TOKEN},
			success: function(data) {
				AllNews(JSON.parse(data));
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	function DeleteCurrentNews(NewsId) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "DELETE",
			url: "/admin/DeleteNews",
			data: {_token: CSRF_TOKEN, NewsId: NewsId},
			dataType: 'JSON',
			success: function(data) {
				alert("Выбранная новость успешно удалена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	function AddNewNews(LabelNews, ShortDescNews, TextNews) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		var date = new Date();
          if (date.getMonth() < 9)
            var stringDate = date.getDate() + " 0" + (date.getMonth() + 1) + " " + date.getFullYear();
          else
            var stringDate = date.getDate() + " " + (date.getMonth() + 1) + " " + date.getFullYear();

		$.ajax({
			type: "POST",
			url: "/admin/AddNewNews",
			data: {_token: CSRF_TOKEN, Label: LabelNews, ShortDesct: ShortDescNews, Text: TextNews, Date: stringDate},
			dataType: 'JSON',
			success: function(data) {
				alert("Новость успешно добавлена!");
			},
			error: function(data) {
				alert("Ошибка при отправке запроса на сервер!");
			}
		});
	}

	function GetOneProduct(CoutProduct, VendoreCode) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "GET",
			url: "/admin/GetOneProduct",
			data: {_token: CSRF_TOKEN, VendoreCode: VendoreCode },
			success: function(data) {
				CoutProduct(JSON.parse(data));
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
			$('#ResponseTable').append("<table width='1000' border='1'></table");
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

			$('#ResponseTable').append("<table width='1000' border='1'></table>")
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
			$('#Response').append("<label>Введите название подкатегории в ед.ч. </label>");
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
		$('#ResponseTable').append("<table width='1000' border='1'></table>")
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
		$("#Response").empty();

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
			$('#Response').append("<label>Введите новую характеристику: </label>");
			$('#Response').append("<input type='text' id='NewCharForSub'/>  ");
			$('#Response').append("<br><button id='InsertNewCharForSub'>Добавить</button>");
		});
	};

	//Дополнить форму для редактирования характеристик подкатегории
	//Отправить GET-запрос на сервер (GetAllSubCategory), чтобы получить перечень подкатегорий
	function RedactCharFromSub() {
		GetAllSubCategory(function(AllSubCategory) {
			ResponeForChar(AllSubCategory);
			$('#Response').append("<button id='ShowCharSubForRedact'>Отобразить продукты</button>");
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
		$('#ResponseTable').append("<table width='1000' border='1'></table>")
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
			$('#ResponseTable').append("<table width='1000' border='1'></table>")
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
		$('#ResponseTable').append("<table width='1000' border='1'></table>")
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
			$('#ResponseTable').append("<table width='1000' border='1'></table>")
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

	//Отобразить форму для редактирования выбранного материала из таблицы
	function UpdateMaterial() {
		GetAllMaterials(function(AllMaterials) {
			MaterialsTable(AllMaterials);
			$('#ResponseTable').append("<label>Исправьте название материала: </label>");
			$('#ResponseTable').append("<input type='text' id='NameMaterial'/>  ");
			$('#ResponseTable').append("<br><button id='UpdateNameMaterialButton'>Редактировать</button>")
		});
	}

	//Функция для вывода таблицы стран.
	//На вход посутпает массив стран с полями: ID_COUNTRY, Name.
	function CountrysTable(AllCountrys) {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#ResponseTable').append("<table width='1000' border='1'></table>")
		$('#ResponseTable').find('table').append("<tr><td>№</td><td>Наименование страны</td>");
		for (var i = 0; i < AllCountrys.length; i++) {
			$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
														"<td id='CountryName" + AllCountrys[i].ID_COUNTRY + "'>" + 
																		AllCountrys[i].Name + "</td>" + 
														"<td><input name='Country' type='radio' value='" + 
																AllCountrys[i].ID_COUNTRY + "'</td></tr>");
		}
	}

	//Отобразить перечень стран в виде таблицы
	//Вызвать функцию GetAllCountrys и занести полученные данные в таблицу
	function ShowAllCountrys() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllCountrys(function(AllCountrys) {
			$('#ResponseTable').append("<table width='1000' border='1'></table>")
			$('#ResponseTable').find('table').append("<tr><td>№</td><td>Наименование страны</td>");
			for (var i = 0; i < AllCountrys.length; i++) {
				$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
															"<td>" + AllCountrys[i].Name + "</td></tr>");
			}
		});
	}

	//Отобразить форму для добавления новой страны
	function AddCountry() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#Response').append("<label>Введите название страны: </label>");
		$('#Response').append("<input type='text' id='CountryName'/>");
		$('#Response').append("<br><button id='AddCountryName'>Добавить</button>")
	}

	//Отобразить форму для удаления выбранной страны из таблицы
	function DeleteCountry() {
		GetAllCountrys(function(AllCountrys) {
			CountrysTable(AllCountrys);
			$('#ResponseTable').append("<button id='DeleteCountryName'>Удалить</button>");
		});
	}

	//Отобразить форму для редактирования выбранной страны из таблицы
	function UpdateCountry() {
		GetAllCountrys(function(AllCountrys) {
			CountrysTable(AllCountrys);
			$('#ResponseTable').append("<label>Исправьте название страны: </label>");
			$('#ResponseTable').append("<input type='text' id='NameCountry'/>  ");
			$('#ResponseTable').append("<br><button id='UpdateNameCountryButton'>Редактировать</button>")
		});
	}

	//Функция для вывода таблицы моделей.
	//На вход посутпает массив стран с полями: ID_MODEL, Name.
	function ModelsTable(AllModels) {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#ResponseTable').append("<table width='1000' border='1'></table>")
		$('#ResponseTable').find('table').append("<tr><td>№</td><td>Наименование модели</td>");
		for (var i = 0; i < AllModels.length; i++) {
			$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
														"<td id='ModelName" + AllModels[i].ID_MODEL + "'>" + 
																		AllModels[i].Name + "</td>" + 
														"<td><input name='Model' type='radio' value='" + 
																AllModels[i].ID_MODEL + "'</td></tr>");
		}
	}

	//Отобразить перечень моделей в виде таблицы
	//Вызвать функцию GetAllModels и занести полученные данные в таблицу
	function ShowAllModels() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllModels(function(AllModels) {
			$('#ResponseTable').append("<table width='1000' border='1'></table>")
			$('#ResponseTable').find('table').append("<tr><td>№</td><td>Наименование модели</td>");
			for (var i = 0; i < AllModels.length; i++) {
				$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
															"<td>" + AllModels[i].Name + "</td></tr>");
			}
		});
	}

	//Отобразить форму для добавления новой модели
	function AddModel() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		$('#Response').append("<label>Введите название модели: </label>");
		$('#Response').append("<input type='text' id='ModelName'/>");
		$('#Response').append("<br><button id='AddModelName'>Добавить</button>")
	}

	//Отобразить форму для удаления выбранной страны из таблицы
	function DeleteModel() {
		GetAllModels(function(AllModels) {
			ModelsTable(AllModels);
			$('#ResponseTable').append("<button id='DeleteModelName'>Удалить</button>");
		});
	}

	//Отобразить форму для редактирования выбранной страны из таблицы
	function UpdateModel() {
		GetAllModels(function(AllCountrys) {
			ModelsTable(AllCountrys);
			$('#ResponseTable').append("<label>Исправьте название модели: </label>");
			$('#ResponseTable').append("<input type='text' id='NameModel'/>  ");
			$('#ResponseTable').append("<br><button id='UpdateNameModelButton'>Редактировать</button>")
		});
	}

	//отобразить таблицу со всем товаром
	function ShowAllProducts() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllSubCategory(function(AllSubCategory) {
			ResponeForChar(AllSubCategory);
			$('#Response').append("<button id='ShowProductsTable'>Показать</button>");
		});
	}

// function AddFirstPhoto() {
// 		$("#ResponseTable").empty();
// 		$('#ResponseTable').append("<br><label>Выберите лицевое изображение товара: </label>");
// 				$('#ResponseTable').append("<form action='/admin/AddFirstPic' enctype='multipart/form-data' method='post'>" + 
// 											"<input name='_token' type='hidden' value='{{ csrf_token() }}'/>" + 
// 											"<div class='form-group'>" + 
// 											"<input type='file' name='img' accept='image/jpeg'/>" + 
// 											"<button type='submit' class='btn btn-default btn-block'>Занести в базу</button>" + 
// 											"</form>");
// 	};

	//отобразить форму добавления нового товара
	function AddProduct() {
		$("#Response").empty();
		$("#ResponseTable").empty();

		$('#ResponseTable').append("<form action='/admin/AddProduct' enctype='multipart/form-data' method='post'>" + 
											"<input name='_token' type='hidden' value='{{ csrf_token() }}'/>" + 
											"<div class='form-group'>" +

											"<label>Введите Артикул продукта: </label>" +  "<input type='text' name='VendoreCode' id='VendoreCode'/>" +

											"<br><label>Введите Артикул поставщика: </label>" + "<input type='text' name='VendoreCodeProvider' id='VendoreCodeProvider'/>" +

											"<br><label>Выберите лицевое изображение товара: </label>" + "<input type='file' name='img' accept='image/jpeg'/>" + 
											
											"<br><label>Введите ширину продукта: </label>" + "<input type='text' name='WidthProduct' id='WidthProduct'/>" + 

											"<br><label>Введите высоту продукта: </label>" + "<input type='text' name='HeightProduct' id='HeightProduct'/>" + 

											"<br><label>Введите длину продукта: </label>" + "<input type='text' name='LengthProduct' id='LengthProduct'/>" +

											"<br><label>Введите вес продукта: </label>" + "<input type='text' name='WeightProduct' id='WeightProduct'/>" +

											"<br><label>Выберите категорию: </label>" + 
											"<input name='CharacteristicProduct' type='radio' value='1'> Новинка" + 
											"<input name='CharacteristicProduct' type='radio' value='2'> Рекомендация" +
											"<input name='CharacteristicProduct' type='radio' value='3'> Лидер" + 
											"<input name='CharacteristicProduct' type='radio' value='4' checked> Ничего" +

											"<br><label>Введите цену продукта: </label>" + "<input type='text' name='PriceProduct' id='PriceProduct'/>" +

											"<br><label>Выберите бренд: </label>" + "<select name='BrendSelect' id='BrendSelect'></select>" +

											"<br><label>Выберите модель: </label>" + "<select name='ModelSelect' id='ModelSelect'></select>" +

											"<br><label>Выберите страну: </label>" + "<select name='CountrySelect' id='CountrySelect'></select>" +

											"<br><label>Выберите материал: </label>" + "<select name='MaterialSelect' id='MaterialSelect'></select>" +

											"<br><label>Выберите подкатегорию: </label>" + "<select name='SubCategorySelect' id='SubCategorySelect'></select>" +

											"<br><label>Введите описание продукта: </label>" + "<textarea rows='15' cols='70' name='text' id='DescriptionProduct'></textarea>" +

											"</div>" + 
											"<button type='submit' class='btn btn-default btn-block'>Занести в базу</button>" +
											"</form>");		


		GetAllBrends(function(AllBrends) {
			// $('#Response').append("<br><select id='BrendSelect'></select>");
			$('#BrendSelect').append("<option selected='selected' disabled>Выберите бренд</option>");
			for (var i = 0; i < AllBrends.length; i++) {
				$('#BrendSelect').append("<option value=" + AllBrends[i].ID_BREND + ">" + 
																		AllBrends[i].Name + "</option>");
			}
		});

		GetAllModels(function(AllModels) {
			// $('#Response').append("<br><select id='ModelSelect'></select>");
			$('#ModelSelect').append("<option selected='selected' disabled>Выберите модель</option>");
			for (var i = 0; i < AllModels.length; i++) {
				$('#ModelSelect').append("<option value=" + AllModels[i].ID_MODEL + ">" + 
																		AllModels[i].Name + "</option>");
			}
		});

		GetAllCountrys(function(AllCountrys) {
			// $('#Response').append("<br><select id='CountrySelect'></select>");
			$('#CountrySelect').append("<option selected='selected' disabled>Выберите страну</option>");
			for (var i = 0; i < AllCountrys.length; i++) {
				$('#CountrySelect').append("<option value=" + AllCountrys[i].ID_COUNTRY + ">" + 
																		AllCountrys[i].Name + "</option>");
			}
		});

		GetAllMaterials(function(AllMaterials) {
			// $('#Response').append("<br><select id='MaterialSelect'></select>");
			$('#MaterialSelect').append("<option selected='selected' disabled>Выберите материал</option>");
			for (var i = 0; i < AllMaterials.length; i++) {
				$('#MaterialSelect').append("<option value=" + AllMaterials[i].ID_MATERIAL + ">" + 
																		AllMaterials[i].Name + "</option>");
			}
		});

		GetAllSubCategory(function(AllSubCategory) {
			// $('#Response').append("<br><select id='SubCategorySelect'></select>");
			$('#SubCategorySelect').append("<option selected='selected' disabled>Выберите подкатегорию</option>");
			for (var i = 0; i < AllSubCategory.length; i++) {
				for (var j = 0; j < AllSubCategory[i].SubCategoryArray.length; j++) {
					$('#SubCategorySelect').append("<option value=" + AllSubCategory[i].SubCategoryArray[j].ID_SUBCATEGORY + ">" + 
																		AllSubCategory[i].SubCategoryArray[j].Name + "</option>");

				}
			}
		});

		// $('#ResponseTable').append("<button id='AddProduct'>Добавить</button>");
	}

	//отобразить форму удаления выбранного товара
	function DeleteProduct() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllSubCategory(function(AllSubCategory) {
			ResponeForChar(AllSubCategory);
			$('#Response').append("<button id='ShowProductsTableForDelete'>Показать</button>");
		});
	}

	//отобразить форму для представления количества товара продукции
	function ShowCountProduct() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllSubCategory(function(AllSubCategory) {
			ResponeForChar(AllSubCategory);
			$('#Response').append("<button id='ShowProductTableWithCount'>Показать</button>");
		});
	}

	//отобразить форму для представления заказов и их статуса
	function ShowAllOrders() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllOrdersWithStatus(function(AllOrders) {
			$('#ResponseTable').append("<table width='1000' border='1'></table>")
			$('#ResponseTable').find('table').append("<tr><td>№</td><td>Номер заказа</td>" +
														"<td>ФИО заказчика</td>" +
														"<td>Адрес заказчика</td>" + 
														"<td>Почта заказчика</td><td>Телефон заказчика</td>" +
														"<td>Дата заказа</td><td>Общая сумма заказа (Руб.)</td>" + 
														"<td>Статус заказа</td><td>Оплата</td><td>Доставка</td></tr>");
			for (var i = 0; i < AllOrders.length; i++) {
				$('#ResponseTable').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
															"<td>" + AllOrders[i]['id_Order'] + "</td>" +
															"<td>" + AllOrders[i]['name'] + "</td>" +
															"<td>" + AllOrders[i]['adress'] + "</td>" +
															"<td>" + AllOrders[i]['email'] + "</td>" + 
															"<td>" + AllOrders[i]['telephone'] + "</td>" +
															"<td>" + AllOrders[i]['date'] + "</td>" +
															"<td>" + AllOrders[i]['price'] + "</td>" +
															"<td>" + AllOrders[i]['status'] + "</td>" + 
															"<td>" + AllOrders[i]['payment'] + "</td>" + 
															"<td>" + AllOrders[i]['delivery'] + "</td></tr>");
			}
		});
	}

	//отобразить форму для представления заказов и товаров к заказу
	function ShowAllOrdersProducts() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllOrdersWithStatus(function(AllOrders) {
			$('#Response').append("<table width='1000' border='1'></table>")
			$('#Response').find('table').append("<tr><td>№</td><td>Номер заказа</td>" + 
														"<td>Статус заказа</td></tr>");
			for (var i = 0; i < AllOrders.length; i++) {
				$('#Response').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
															"<td>" + AllOrders[i]['id_Order'] + "</td>" +
															"<td>" + AllOrders[i]['status'] + "</td>" + 
															"<td><input name='OrderNumber' type='radio' value='" + 
															AllOrders[i]['id_Order'] + "'</td></tr>");
			}
			$('#Response').append("<button id='ShowOrderDetails'>Показать подробности</button>");
		});
	}

	//отобразить форму для изменения статуса заказа
	function ShangeStatusOrder() {
		$("#Response").empty();
		$("#ResponseTable").empty();
		GetAllOrdersWithStatus(function(AllOrders) {
			$('#Response').append("<table width='1000' border='1'></table>")
			$('#Response').find('table').append("<tr><td>№</td><td>Номер заказа</td>" + 
														"<td>Статус заказа</td></tr>");
			for (var i = 0; i < AllOrders.length; i++) {
				$('#Response').find('table').append("<tr><td>" + (i + 1) + "</td>" + 
															"<td>" + AllOrders[i]['id_Order'] + "</td>" +
															"<td>" + AllOrders[i]['status'] + "</td>" + 
															"<td><input name='OrderNumber' type='radio' value='" + 
															AllOrders[i]['id_Order'] + "'</td></tr>");
			}
			// $('#Response').append("<button id='ShowOrderDetails'>Показать подробности</button>");
		});
		GetAllStatus(function(AllStatuses) {
			$('#ResponseTable').append("<label>Выберите статус заказа: <label>");
			$('#ResponseTable').append("<select id='NewStatusOrder'></select><br>");
			for (var i = 0; i < AllStatuses.length; i++) {
				$('#ResponseTable').find("select").append("<option value=" + AllStatuses[i].ID_STATUSORDER + ">" + 
																		AllStatuses[i].Name + "</option>");
			}
			$('#ResponseTable').append("<button id='ChangeStatusOrderButton'>Изменить статус заказа</button>");
		});
	}
</script>


@endsection()