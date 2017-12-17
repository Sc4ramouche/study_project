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
          $OneCharacteristic = ['Characteristic' => $Characteristic, 'Value' => $Value];
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

    }
