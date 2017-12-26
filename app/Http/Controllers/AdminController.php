<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Auth;

    use Illuminate\Support\Facades\DB;

    class AdminController extends Controller
    {
        /**
        * Create a new controller instance.
        *
        * @return void
        */
        public function __construct()
        {
            $this->middleware('isAdmin');
        }
       /**
       * Show the application dashboard.
       *
       * @return \Illuminate\Http\Response
       */
       public function adminpanel()
       {
           return view('admin_panel.adminpanel');
       }


       /**
       *  Получить список категорий
       *  и передать как ответ на запрос
       *  На вход: ничего
       *  На выход: JSON файл с категориями
       *  со всем категориями из таблицы CAREGORY 
       **/
      public function GetCategory() {
        $Category = DB::table('CATEGORY')->get();
        return json_encode($Category);
      }

      /**
      * Добавить новую категорию в таблицу
      * На вход: данные отправляющиеся по запросу
      * На выходе: ответ на успешный, обработанный запрос.
      * Добавляется запись в таблицу Категория
      **/
      public function AddCategory(Request $request) {

        //добавить новую запись в таблицу CATEGORY
        DB::table('CATEGORY')->insert(
          ['name' => $request->name]
        );

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить список список подкатегория
      * На вход: ничего
      * На выходе: JSON файл с категориями и подкатегориями
      * из таблица CATEGORY, SUBCATEGORY
      **/
      public function GetSubCategory() {
        $Response = []; //ответ на запорс, который вернется клиенту

        //получить все названия категорий из таблицы CATEGORY
        $Category = DB::table('CATEGORY')->get();
        //представить каждую категорию как ассоциативный массив:
        //'CategoryName' - название категории
        //'SubCategoryArray' - хранит n элементов подкатегорий, которые имеют одинакову категорию
        for ($i = 0; $i < sizeof($Category); $i++) {
          $ElementResponse = ['CategoryName' => $Category[$i]->Name, 'SubCategoryArray' => []]; 
          array_push($Response, $ElementResponse);
        }

        //получить все подкатегории из таблицы SUBCATEGORY
        $SubCategory = DB::table('SUBCATEGORY')->get();
        
        // Записать каждую подкатегорию в массив Response c совпадающими
        // названиями категорий
        for ($i = 0; $i < sizeof($SubCategory); $i++) {
          //получить название категории по ID_CATEGORY у подкатегории
          $SubCategory[$i]->NameCategory = DB::table('CATEGORY')->where('ID_CATEGORY', $SubCategory[$i]->ID_CATEGORY)->first()->Name;
          //цикл для прохода по каждой категории
          for ($j = 0; $j < sizeof($Response); $j++) { 
            //сравнить название категории у подкатегории с имеющимися категориями
            //и положить ее в нужный массив категории 
            if ($Response[$j]['CategoryName'] == $SubCategory[$i]->NameCategory)
              array_push($Response[$j]['SubCategoryArray'], $SubCategory[$i]);
          }
        }
        return json_encode($Response); //вернуть ответ на запрос в виде JSON
      }


      /**
      * Добавить новую подкатегорию в таблицу
      * На вход: данные отправляющиеся по запросу
      * На выходе: ответ на успешный и обработанный запрос.
      * Добавляется запись в таблицу Подкатегория
      **/
      public function AddSubCategory(Request $request) {

        //добавить новую запись в таблицу Подкатегории
        DB::table('SUBCATEGORY')->insert(
          [
            'ID_CATEGORY' => $request->id_category,
            'Name' => $request->name,
            'Type' => $request->type
          ]
        );

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить список характеристик подкатегории
      * На вход: ничего
      * На выходе: JSON файл с характеристиками подкатегорий
      * из таблица ALLCHARACTERISTICS, CHARACTERISTICSUBC, VALUESUBC
      **/
      public function GetSubCatChar(Request $request) {
        $Response = []; //ответ на запрос

        $AllCharacteristicsSub = DB::table('ALLCHARACTERISTICS')->where('ID_SUBCATEGORY', $request->id_SubCategory)->get();

        //пройтись по каждой характеристике, и разобрать ее
        for ($i = 0; $i < sizeof($AllCharacteristicsSub); $i++) {
          //получить название характеристики 
          $Characteristic = DB::table('CHARACTERISTICSUBC')
                            ->where('ID_CHARACTERISTICSUBC', $AllCharacteristicsSub[$i]->ID_CHARACTERISTICSUBC)->first()->Name;

          //получить значение характеристики
          $Value = DB::table('VALUESUBC')->where('ID_VALUESUBC', $AllCharacteristicsSub[$i]->ID_VALUESUBC)->first()->Name;

          //занести данных о характеристике в ассоциативный массив
          $OneCharacteristic = ['Characteristic' => $Characteristic, 'Value' => $Value, 'ID_SubChar' => $AllCharacteristicsSub[$i]->ID_ALLCHARACTERISTICS];
          //Занести массив с характеристикой в ответ на запрос
          array_push($Response, $OneCharacteristic);
        }

        return json_encode($Response); //вернуть ответ на запрос в виде JSON
      }

      /**
      * Добавить новую характеристику для подкатегории в таблицу
      * На вход: данные отправляющиеся по POST-запросу
      * На выходе: ответ на успешный и обработанный POST-запрос.
      * Добавляется запись в таблицу Характерисики для подкатегорий
      **/
      public function AddSubCatChar(Request $request) {

        //проверить если ли введенная характертистика уже в таблице, если нет то добавить
        $AllCharacteristics = DB::table('CHARACTERISTICSUBC')->get();
        $ID_Characteristic = NULL;
        for ($i = 0; $i < sizeof($AllCharacteristics); $i++) { 
          if ($AllCharacteristics[$i]->Name == $request->nameChar)
            $ID_Characteristic = $AllCharacteristics[$i]->ID_CHARACTERISTICSUBC;
        }

        //если веденная характеристика не встречалась ранее добавить
        //и получить идентификатор
        if (is_null($ID_Characteristic) == true) {
          DB::table('CHARACTERISTICSUBC')->insert(
            ['Name' => $request->nameChar]);
          $ID_Characteristic = DB::table('CHARACTERISTICSUBC')->where('Name', $request->nameChar)->first()->ID_CHARACTERISTICSUBC;

        }
        
        //проверить есть ли введенное значение характеристики уже в таблице, если нет то добавить
        //и получить идентификатор
        $AllValuesChar = DB::table('VALUESUBC')->get();
        $ID_ValueChar = NULL;
        for ($i = 0; $i < sizeof($AllValuesChar); $i++) { 
          if ($AllValuesChar[$i]->Name == $request->valueChar)
            $ID_ValueChar = $AllValuesChar[$i]->ID_VALUESUBC;
        }

        //если введенное значение характеристики не встречалось ранее
        if (is_null($ID_ValueChar) == true) {
          DB::table('VALUESUBC')->insert(
            ['Name' => $request->valueChar]);
          $ID_ValueChar = DB::table('VALUESUBC')->where('Name', $request->valueChar)->first()->ID_VALUESUBC;
        }

        //добавить новую запись в таблицу Характеристики для Подкатегорий
        DB::table('ALLCHARACTERISTICS')->insert(
          [
            'ID_SUBCATEGORY' => $request->id_subCategory,
            'ID_CHARACTERISTICSUBC' => $ID_Characteristic,
            'ID_VALUESUBC' => $ID_ValueChar
          ]
        );

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить список любых характеристик
      * На вход: ничего
      * На выходе: JSON файл с любыми характеристиками
      * из таблица CHARACTERISTICSUBC
      **/
      public function GetCharacteristic() {
        $Characteristics = DB::table('CHARACTERISTICSUBC')->get();
        return json_encode($Characteristics);
      }

      /**
      * Редактировать выбранную характеристику подкатегории
      * На вход: request с ID_характеристики и новые значения для замены
      * На выходе: ответ на успешный и обработанный PUT-запрос.
      **/
      public function RedactSubCatChar(Request $request) {

        //Найти по идентификатору поля всех характеристик ключи характеристики и значения
        $Characteristic = DB::table('ALLCHARACTERISTICS')->where('ID_ALLCHARACTERISTICS', $request->id_CharSub)->first();

        //Поменять по ключу название характеристики
        DB::table('CHARACTERISTICSUBC')
                            ->where('ID_CHARACTERISTICSUBC', $Characteristic->ID_CHARACTERISTICSUBC)
                            ->update(['Name' => $request->nameChar]);

        //Поменять по ключу название значения характеристики
        DB::table('VALUESUBC')
                      ->where('ID_VALUESUBC', $Characteristic->ID_VALUESUBC)
                      ->update(['Name' => $request->valueChar]);

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Удалить выбранную характеристику покдатегории
      * На вход: request с ID_характеристики для удаления
      * На выходе: ответ на успешный и обработанный DELETE-запрос.
      **/
      public function DeleteSubCatChar(Request $request) {

        //Удалить из таблицы ALLCHARACTERISTICS запись с совпавшим идентификатором
        DB::table('ALLCHARACTERISTICS')
                          ->where('ID_ALLCHARACTERISTICS', $request->id_CharSub)
                          ->delete();

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить весь спиков брендов из БД
      * На вход: ничего
      * На выход: JSON файл с перчнем брендов из таблицы BREND
      **/
      public function GetBrend(Request $request) {
        $AllBrend = DB::table('BREND')->get();
        return json_encode($AllBrend);
      }

      /**
      * Добавить новый брен в БД
      * На вход: название бренда
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddBrend(Request $request) {

        //Добавить новый бренд в таблицу
        DB::table('BREND')->insert(
          ['Name' => $request->BrandName]
        );

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response); 
      }

      /**
      * Удалить выбранный бренд из БД
      * На вход: идентификатор бренда
      * На выход: ответ на успешный и обработанный DELETE-запрос.
      **/
      public function DeleteBrend(Request $request) {

        DB::table('BREND')
                          ->where('ID_BREND', $request->id_Brend)
                          ->delete();

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response); 
      }

      /**
      * Обновить выбранный бренд в БД
      * На вход: идентификатор и название бренда
      * На выходе: ответ на успешлый и обработанный PUT-запрос
      **/
      public function UpdateBrend(Request $request) {

        //обновить поле в таблице по идентификатору
        DB::table('BREND')
                      ->where('ID_BREND', $request->id_Brend)
                      ->update(['Name' => $request->BrendName]);

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить весь спиков материалов из БД
      * На вход: ничего
      * На выход: JSON файл с перчнем материалов из таблицы MATERIAL
      **/
      public function GetMaterial(Request $request) {
        $AllMaterials = DB::table('MATERIAL')->get();
        return json_encode($AllMaterials);
      }

      /**
      * Добавить новый материал в БД
      * На вход: название материала
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddMaterial(Request $request) {
        //Добавить новый материал в таблицу
        DB::table('MATERIAL')->insert(
          ['Name' => $request->MaterialName]
        );

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Удалить выбранный материал из БД
      * На вход: идентификатор материала
      * На выход: ответ на успешный и обработанный DELETE-запрос.
      **/
      public function DeleteMaterial(Request $request) {

        //удалить из таблицы MATERIAL строку по идентификатору
        DB::table('MATERIAL')
                          ->where('ID_MATERIAL', $request->id_Material)
                          ->delete();

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Обновить выбранный материал в БД
      * На вход: идентификатор и название материала
      * На выходе: ответ на успешлый и обработанный PUT-запрос
      **/
      public function UpdateMaterial(Request $request) {

        //обновить поле в таблице по идентификатору
        DB::table('MATERIAL')
                      ->where('ID_MATERIAL', $request->id_Material)
                      ->update(['Name' => $request->MaterialName]);

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить весь спиков стран из БД
      * На вход: ничего
      * На выход: JSON файл с перчнем стран из таблицы COUNTRY
      **/
      public function GetCountry(Request $request) {
        $AllCountrys = DB::table('COUNTRY')->get();
        return json_encode($AllCountrys);
      }

      /**
      * Добавить новую страну в БД
      * На вход: название страны
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddCountry(Request $request) {
        //Добавить новый материал в таблицу
        DB::table('COUNTRY')->insert(
          ['Name' => $request->CountryName]
        );

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Удалить выбранную страну из БД
      * На вход: идентификатор страны
      * На выход: ответ на успешный и обработанный DELETE-запрос.
      **/
      public function DeleteCountry(Request $request) {
        //удалить из таблицы MATERIAL строку по идентификатору
        DB::table('COUNTRY')
                          ->where('ID_COUNTRY', $request->id_Country)
                          ->delete();

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Обновить выбранную страну в БД
      * На вход: идентификатор и название страны
      * На выходе: ответ на успешлый и обработанный PUT-запрос
      **/
      public function UpdateCountry(Request $request) {
        //обновить поле в таблице по идентификатору
        DB::table('COUNTRY')
                      ->where('ID_COUNTRY', $request->id_Country)
                      ->update(['Name' => $request->CountryName]);

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить весь спиков моделей из БД
      * На вход: ничего
      * На выход: JSON файл с перчнем моделей из таблицы MODEL
      **/
      public function GetModel(Request $request) {
        $AllModels = DB::table('MODEL')->get();
        return json_encode($AllModels);
      }

      /**
      * Добавить новую модель в БД
      * На вход: название модели
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddModel(Request $request) {
        //Добавить новый материал в таблицу
        DB::table('MODEL')->insert(
          ['Name' => $request->ModelName]
        );

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Удалить выбранную модель из БД
      * На вход: идентификатор модели
      * На выход: ответ на успешный и обработанный DELETE-запрос.
      **/
      public function DeleteModel(Request $request) {
        //удалить из таблицы MODEL строку по идентификатору
        DB::table('MODEL')
                          ->where('ID_MODEL', $request->id_Model)
                          ->delete();

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Обновить выбранную модель в БД
      * На вход: идентификатор и название модели
      * На выходе: ответ на успешлый и обработанный PUT-запрос
      **/
      public function UpdateModel(Request $request) {
        //обновить поле в таблице по идентификатору
        DB::table('MODEL')
                      ->where('ID_MODEL', $request->id_Model)
                      ->update(['Name' => $request->ModelName]);

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить весь спиков моделей из БД
      * На вход: ничего
      * На выход: JSON файл с перчнем товаров из таблицы PRODUCT
      **/
      public function GetProduct(Request $request) {
        /*Ответ будет выглядеть следующим образом:
        [
          'Product' => ...,
          'ArraySecondPic' => ...
        ]*/
        $Response = [];

        $AllProducts = DB::table('PRODUCT')->where('ID_SUBCATEGORY', $request->id_SubCategory)->get();
        //пройтись по каждому продукту в таблице
        for ($i = 0; $i < sizeof($AllProducts); $i++) {
          
          $Status = ($AllProducts[$i]->IsNew === $AllProducts[$i]->IsLeader ? 'Рекомендация' : ($AllProducts[$i]->IsNew > $AllProducts[$i]->IsLeader ? 'Новинка' : 'Лидер')); 

          $OneProduct = [
            'VendoreCode' => $AllProducts[$i]->VENDOR_CODE,
            'SubName' => DB::table('SUBCATEGORY')->where('ID_SUBCATEGORY', $AllProducts[$i]->ID_SUBCATEGORY)->first()->Name,
            'BrendName' => DB::table('BREND')->where('ID_BREND', $AllProducts[$i]->ID_BREND)->first()->Name,
            'ModelName' => DB::table('MODEL')->where('ID_MODEL', $AllProducts[$i]->ID_MODEL)->first()->Name,
            'CountryName' => DB::table('COUNTRY')->where('ID_COUNTRY', $AllProducts[$i]->ID_COUNTRY)->first()->Name,
            'MaterialName' => DB::table('MATERIAL')->where('ID_MATERIAL', $AllProducts[$i]->ID_MATERIAL)->first()->Name,
            'GeneralPic' => DB::table('PICTURE')->where('ID_PICTURE', $AllProducts[$i]->ID_PICTURE)->first()->Name,
            'VendoreCodeProvider' => $AllProducts[$i]->VENDOR_CODE_PROVIDER,
            'Weight' => $AllProducts[$i]->Weight,
            'Height' => $AllProducts[$i]->Height,
            'Length' => $AllProducts[$i]->length,
            'Width' => $AllProducts[$i]->Width,
            'Status' => $Status,
            'Price' => $AllProducts[$i]->Price,
          ];

          array_push($Response, $OneProduct);
        }

        return json_encode($Response);
      }


      /**
      * Добавить новый товар в БД
      * На вход: Артикул продукта(VendoreCode), Артикул поставщика(VendoreProvider), Путь изображения (FileName),
      *           Ширина (Weight), Высота (Height), Длина (Length), Вес (Weight), Номер категории (CategoryNumber),
                  Цена (Price), Идентификатор модели (id_Model), Идентификатор бренда (id_Brend),
                  Идентификатор страны (id_Country), Идентификатор подкатегории (id_SubCategory), 
                  Идентификатор материала (id_Material).
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddProduct(Request $request) {

        $AllPictures = DB::table('PICTURE')->get();
        $FileName = $this->CutFileName($request->FileName);
        $isFile = NULL;

        //проверка на наличие подобного названия в таблице PICTURE
        for ($i = 0; $i < sizeof($AllPictures); $i++) { 
          if ($AllPictures[$i]->Name == $FileName) {
            $isFile = true;
            break;
          }
        }

        //если совпадений не нашлось, то добавить запись
        if (is_null($isFile) == true) {
          DB::table('PICTURE')->insert(
            ['Name' => $FileName]
          );
        }

        $id_FilePicture = DB::table('PICTURE')->where('Name', $FileName)->first()->ID_PICTURE;

        // если новинка
        if ($request->CategoryNumber == 1) {
          DB::table('PRODUCT')->insert(
              [
                'VENDOR_CODE' => $request->VendoreCode,
                'ID_SUBCATEGORY' => $request->id_SubCategory,
                'ID_BREND' => $request->id_Brend,
                'ID_MODEL' => $request->id_Model,
                'ID_COUNTRY' => $request->id_Country,
                'ID_PICTURE' => $id_FilePicture,
                'VENDOR_CODE_PROVIDER' => $request->VendoreProvider,
                'Width' => $request->Width,
                'Height' => $request->Height,
                'length' => $request->Length,
                'Weight' => $request->Weight,
                'IsNew' => 1,
                'IsLeader' => 0,
                'IsRecomend' => 0,
                'Price' => $request->Price,
                'ID_MATERIAL' => $request->id_Material,
                'Count' => 0
              ]
            );   
        }
        //если рекоминдация магазина
        else if ($request->CategoryNumber == 2) {
          DB::table('PRODUCT')->insert(
            [
              'VENDOR_CODE' => $request->VendoreCode,
              'ID_SUBCATEGORY' => $request->id_SubCategory,
              'ID_BREND' => $request->id_Brend,
              'ID_MODEL' => $request->id_Model,
              'ID_COUNTRY' => $request->id_Country,
              'ID_PICTURE' => $id_FilePicture,
              'VENDOR_CODE_PROVIDER' => $request->VendoreProvider,
              'Width' => $request->Width,
              'Height' => $request->Height,
              'length' => $request->Length,
              'Weight' => $request->Weight,
              'IsNew' => 0,
              'IsLeader' => 0,
              'IsRecomend' => 1,
              'Price' => $request->Price,
              'ID_MATERIAL' => $request->id_Material,
              'Count' => 0
            ]
          );
        }
        //если лидер
        else if ($request->CategoryNumber == 3) {
          DB::table('PRODUCT')->insert(
            [
              'VENDOR_CODE' => $request->VendoreCode,
              'ID_SUBCATEGORY' => $request->id_SubCategory,
              'ID_BREND' => $request->id_Brend,
              'ID_MODEL' => $request->id_Model,
              'ID_COUNTRY' => $request->id_Country,
              'ID_PICTURE' => $id_FilePicture,
              'VENDOR_CODE_PROVIDER' => $request->VendoreProvider,
              'Width' => $request->Width,
              'Height' => $request->Height,
              'length' => $request->Length,
              'Weight' => $request->Weight,
              'IsNew' => 0,
              'IsLeader' => 1,
              'IsRecomend' => 0,
              'Price' => $request->Price,
              'ID_MATERIAL' => $request->id_Material,
              'Count' => 0
            ]
         );
        }
        //иначе просто товар
        else {
          DB::table('PRODUCT')->insert(
            [
              'VENDOR_CODE' => $request->VendoreCode,
              'ID_SUBCATEGORY' => $request->id_SubCategory,
              'ID_BREND' => $request->id_Brend,
              'ID_MODEL' => $request->id_Model,
              'ID_COUNTRY' => $request->id_Country,
              'ID_PICTURE' => $id_FilePicture,
              'VENDOR_CODE_PROVIDER' => $request->VendoreProvider,
              'Width' => $request->Width,
              'Height' => $request->Height,
              'length' => $request->Length,
              'Weight' => $request->Weight,
              'IsNew' => 0,
              'IsLeader' => 0,
              'IsRecomend' => 0,
              'Price' => $request->Price,
              'ID_MATERIAL' => $request->id_Material,
              'Count' => 0
            ]
          );
        }

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Функция, которая оставляет только название файла удаляя его путь
      * На вход: Название файла с его дирректорией
      * На выходе: Название файла
      **/
      public function CutFileName($FileName) {
        $answer = "";
        for ($i = strlen($FileName) - 1; $i >= 0; $i--) {
          if (($FileName[$i] == '/') || ($FileName[$i] == '\\'))
            return strrev($answer);
          $answer .= $FileName[$i];
        }
      }

      /**
      * Удалить выбранный продукт из БД
      * На вход: артикул продукта
      * На выход: ответ на успешный и обработанный DELETE-запрос.
      **/
      public function DeleteProduct(Request $request) {

        DB::table('PRODUCT')
                            ->where('VENDOR_CODE', $request->VendoreCode)
                            ->delete();

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

    }
