<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Auth;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage;
    // use App\Page;


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
        $Category = DB::table('category')->get();
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
        DB::table('category')->insert(
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
        $Category = DB::table('category')->get();
        //представить каждую категорию как ассоциативный массив:
        //'CategoryName' - название категории
        //'SubCategoryArray' - хранит n элементов подкатегорий, которые имеют одинакову категорию
        for ($i = 0; $i < sizeof($Category); $i++) {
          $ElementResponse = ['CategoryName' => $Category[$i]->Name, 'SubCategoryArray' => []]; 
          array_push($Response, $ElementResponse);
        }

        //получить все подкатегории из таблицы SUBCATEGORY
        $SubCategory = DB::table('subcategory')->get();
        
        // Записать каждую подкатегорию в массив Response c совпадающими
        // названиями категорий
        for ($i = 0; $i < sizeof($SubCategory); $i++) {
          //получить название категории по ID_CATEGORY у подкатегории
          $SubCategory[$i]->NameCategory = DB::table('category')->where('ID_CATEGORY', $SubCategory[$i]->ID_CATEGORY)->first()->Name;
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
        DB::table('subcategory')->insert(
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

        // $AllCharacteristicsSub = DB::table('ALLCHARACTERISTICS')->where('ID_SUBCATEGORY', $request->id_SubCategory)->get();
        $AllCharacteristicsSub = DB::table('allcharacteristics')->where('VENDOR_CODE', $request->id_SubCategory)->get();

        //пройтись по каждой характеристике, и разобрать ее
        for ($i = 0; $i < sizeof($AllCharacteristicsSub); $i++) {
          //получить название характеристики 
          $Characteristic = DB::table('characteristicsubc')
                            ->where('ID_CHARACTERISTICSUBC', $AllCharacteristicsSub[$i]->ID_CHARACTERISTICSUBC)->first()->Name;

          //получить значение характеристики
          $Value = DB::table('valuesubc')->where('ID_VALUESUBC', $AllCharacteristicsSub[$i]->ID_VALUESUBC)->first()->Name;

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

        
        $AllProducts = DB::table('product')->where('ID_SUBCATEGORY', $request->id_subCategory)->get();

        $AllChar = DB::table('characteristicsubc')->get();
        $NewCharId = NULL;
        $flag = false;
        for ($i = 0; $i < sizeof($AllChar); $i++) { 
          if ($AllChar[$i]->Name == $request->nameChar) {
            $NewCharId = $AllChar[$i];
            $flag = true;
            break;
          }
        }

        if ($flag == false) {
          DB::table('characteristicsubc')->insert(
            ['Name' => $request->nameChar]);
          $NewCharId = DB::table('characteristicsubc')->where('Name', $request->nameChar)->first();
        }

        for ($i = 0; $i < sizeof($AllProducts); $i++) { 
          DB::table('allcharacteristics')->insert(
            [
              'ID_SUBCATEGORY' => $request->id_subCategory,
              'ID_CHARACTERISTICSUBC' => $NewCharId->ID_CHARACTERISTICSUBC,
              'ID_VALUESUBC' => 7,
              'VENDOR_CODE' => $AllProducts[$i]->VENDOR_CODE
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
      * Получить список любых характеристик
      * На вход: ничего
      * На выходе: JSON файл с любыми характеристиками
      * из таблица CHARACTERISTICSUBC
      **/
      public function GetCharacteristic() {
        $Characteristics = DB::table('characteristicsubc')->get();
        return json_encode($Characteristics);
      }

      /**
      * Редактировать выбранную характеристику подкатегории
      * На вход: request с ID_характеристики и новые значения для замены
      * На выходе: ответ на успешный и обработанный PUT-запрос.
      **/
      public function RedactSubCatChar(Request $request) {

          $AllVal = DB::table('valuesubc')->get();
          $NewVal = NULL;
          $flag = false;
          for ($i = 0; $i < sizeof($AllVal); $i++) { 
            if ($AllVal[$i]->Name == $request->valueChar) {
              $NewVal = $AllVal[$i];
              $flag = true;
              break;
            }
          }

          //если такого значения еще не было, то добавить его
          if ($flag == false) {
            DB::table('valuesubc')->insert([
              'Name' => $request->valueChar]);
          }
          
          $NewVal = DB::table('valuesubc')->where('Name', $request->valueChar)->get()->first();
          DB::table('allcharacteristics')->where('ID_ALLCHARACTERISTICS', $request->id_CharSub)
                                          ->update(['ID_VALUESUBC' => $NewVal->ID_VALUESUBC]);



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
        DB::table('allcharacteristics')
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
        $AllBrend = DB::table('brend')->get();
        return json_encode($AllBrend);
      }

      /**
      * Добавить новый брен в БД
      * На вход: название бренда
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddBrend(Request $request) {

        //Добавить новый бренд в таблицу
        DB::table('brend')->insert(
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

        DB::table('brend')
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
        DB::table('brend')
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
        $AllMaterials = DB::table('material')->get();
        return json_encode($AllMaterials);
      }

      /**
      * Добавить новый материал в БД
      * На вход: название материала
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddMaterial(Request $request) {
        //Добавить новый материал в таблицу
        DB::table('material')->insert(
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
        DB::table('material')
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
        DB::table('material')
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
        $AllCountrys = DB::table('country')->get();
        return json_encode($AllCountrys);
      }

      /**
      * Добавить новую страну в БД
      * На вход: название страны
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddCountry(Request $request) {
        //Добавить новый материал в таблицу
        DB::table('country')->insert(
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
        DB::table('country')
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
        DB::table('country')
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
        $AllModels = DB::table('model')->get();
        return json_encode($AllModels);
      }

      /**
      * Добавить новую модель в БД
      * На вход: название модели
      * На выход: ответ на успешный и обработанный POST-запрос.
      **/
      public function AddModel(Request $request) {
        //Добавить новый материал в таблицу
        DB::table('model')->insert(
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
        DB::table('model')
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
        DB::table('model')
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

        $AllProducts = DB::table('product')->where('ID_SUBCATEGORY', $request->id_SubCategory)->get();
        //пройтись по каждому продукту в таблице
        for ($i = 0; $i < sizeof($AllProducts); $i++) {
          
          $Status = ($AllProducts[$i]->IsNew === $AllProducts[$i]->IsLeader ? 'Рекомендация' : ($AllProducts[$i]->IsNew > $AllProducts[$i]->IsLeader ? 'Новинка' : 'Лидер')); 

          $OneProduct = [
            'VendoreCode' => $AllProducts[$i]->VENDOR_CODE,
            'SubName' => DB::table('subcategory')->where('ID_SUBCATEGORY', $AllProducts[$i]->ID_SUBCATEGORY)->first()->Name,
            'BrendName' => DB::table('brend')->where('ID_BREND', $AllProducts[$i]->ID_BREND)->first()->Name,
            'ModelName' => DB::table('model')->where('ID_MODEL', $AllProducts[$i]->ID_MODEL)->first()->Name,
            'CountryName' => DB::table('country')->where('ID_COUNTRY', $AllProducts[$i]->ID_COUNTRY)->first()->Name,
            'MaterialName' => DB::table('material')->where('ID_MATERIAL', $AllProducts[$i]->ID_MATERIAL)->first()->Name,
            'GeneralPic' => DB::table('picture')->where('ID_PICTURE', $AllProducts[$i]->ID_PICTURE)->first()->Name,
            'VendoreCodeProvider' => $AllProducts[$i]->VENDOR_CODE_PROVIDER,
            'Weight' => $AllProducts[$i]->Weight,
            'Height' => $AllProducts[$i]->Height,
            'Length' => $AllProducts[$i]->length,
            'Width' => $AllProducts[$i]->Width,
            'Status' => $Status,
            'Price' => $AllProducts[$i]->Price,
            'Description' => $AllProducts[$i]->Description,
          ];

          array_push($Response, $OneProduct);
        }

        return json_encode($Response);
      }

      public function createNamePicture($str, $vendoreCode) {
        $format = "";
        for ($i = strlen($str) - 1; $i >= 0; $i--) {
          if ($str[$i] == '.') {
            $format .= '.';
            $str = substr($str, 0, ($i));
            $str = $str . "_" . $vendoreCode . strrev($format);
            return $str;
          }
          else {
            $format .= $str[$i];
          }
        }
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

        if ($request->hasFile('img') == false) {
          return var_dump("Вы не выбрали фотографию!");
          if ($request->vendoreCode == "") {
            return var_dump("Вы не ввели артикул продукта!");
            if ($request->VendoreCodeProvider == "") {
              return var_dump("Вы не ввели артикул поставщика!");
              if ($request->WidthProduct ==  "") {
                return var_dump("Вы не ввели ширину продукта!");
                if ($request->HeightProduct ==  "") {
                  return var_dump("Вы не ввели высоту продукта!");
                  if ($request->LengthProduct == "") {
                    return var_dump("Вы не ввели длину продукта!");
                    if ($request->WeightProduct == "") {
                      return var_dump("Вы не ввели вес продукта!");
                        if ($request->PriceProduct == "") {
                          return var_dump("Вы не ввели вес продукта!");
                          if ($request->BrendSelect == null) {
                            return var_dump("Вы не выбрали бренд прокта!");
                            if ($request->ModelSelect == null) {
                              return var_dump("Вы не выбрали модель продукта!");
                              if ($request->CountrySelect == null) {
                                return var_dump("Вы не выбрали страну для продукта!");
                                if ($request->MaterialSelect == null) {
                                  return var_dump("Вы не выбрали материал продукта!");
                                  if ($request->SubCategorySelect == null) {
                                    return var_dump("Вы не выбрали подкатегорию продукта");
                                    if ($request->text == "") {
                                      return var_dump("Вы не ввели описание продукта!");
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                  }
                }
              }
            }
          }
        }   

        $namePic = self::createNamePicture( $request->file('img')->getClientOriginalName(), $request->VendoreCode);

        $file = $request->file('img');
        $vendore = $request->vendore;
        $destinationPath =  public_path().'/img';
        // $filename = $file->getClientOriginalName();

        //добавление файла в бд
        DB::table('picture')->insert([
          'Name' => $namePic
        ]);

        $request->file('img')->move($destinationPath, $namePic);

        $id_FilePicture = DB::table('picture')->where('Name', $namePic)->first()->ID_PICTURE;

        // если новинка
        if ($request->CategoryNumber == 1) {
          DB::table('product')->insert(
              [
                'VENDOR_CODE' => $request->VendoreCode,
                'ID_SUBCATEGORY' => $request->SubCategorySelect,
                'ID_BREND' => $request->BrendSelect,
                'ID_MODEL' => $request->ModelSelect,
                'ID_COUNTRY' => $request->CountrySelect,
                'ID_PICTURE' => $id_FilePicture,
                'VENDOR_CODE_PROVIDER' => $request->VendoreCodeProvider,
                'Width' => $request->WidthProduct,
                'Height' => $request->HeightProduct,
                'length' => $request->LengthProduct,
                'Weight' => $request->WeightProduct,
                'IsNew' => 1,
                'IsLeader' => 0,
                'IsRecomend' => 0,
                'Price' => $request->PriceProduct,
                'ID_MATERIAL' => $request->MaterialSelect,
                'Count' => 0,
                'Description' => $request->text
              ]
            );   
        }
        //если рекоминдация магазина
        else if ($request->CategoryNumber == 2) {
          DB::table('product')->insert(
            [
              'VENDOR_CODE' => $request->VendoreCode,
              'ID_SUBCATEGORY' => $request->SubCategorySelect,
              'ID_BREND' => $request->BrendSelect,
              'ID_MODEL' => $request->ModelSelect,
              'ID_COUNTRY' => $request->CountrySelect,
              'ID_PICTURE' => $id_FilePicture,
              'VENDOR_CODE_PROVIDER' => $request->VendoreCodeProvider,
              'Width' => $request->WidthProduct,
              'Height' => $request->HeightProduct,
              'length' => $request->LengthProduct,
              'Weight' => $request->WeightProduct,
              'IsNew' => 0,
              'IsLeader' => 0,
              'IsRecomend' => 1,
              'Price' => $request->PriceProduct,
              'ID_MATERIAL' => $request->MaterialSelect,
              'Count' => 0,
              'Description' => $request->text
            ]
          );
        }
        //если лидер
        else if ($request->CategoryNumber == 3) {
          DB::table('product')->insert(
            [
              'VENDOR_CODE' => $request->VendoreCode,
              'ID_SUBCATEGORY' => $request->SubCategorySelect,
              'ID_BREND' => $request->BrendSelect,
              'ID_MODEL' => $request->ModelSelect,
              'ID_COUNTRY' => $request->CountrySelect,
              'ID_PICTURE' => $id_FilePicture,
              'VENDOR_CODE_PROVIDER' => $request->VendoreCodeProvider,
              'Width' => $request->WidthProduct,
              'Height' => $request->HeightProduct,
              'length' => $request->LengthProduct,
              'Weight' => $request->WeightProduct,
              'IsNew' => 0,
              'IsLeader' => 1,
              'IsRecomend' => 0,
              'Price' => $request->PriceProduct,
              'ID_MATERIAL' => $request->MaterialSelect,
              'Count' => 0,
              'Description' => $request->text
            ]
         );
        }
        //иначе просто товар
        else {
          DB::table('product')->insert(
            [
              'VENDOR_CODE' => $request->VendoreCode,
              'ID_SUBCATEGORY' => $request->SubCategorySelect,
              'ID_BREND' => $request->BrendSelect,
              'ID_MODEL' => $request->ModelSelect,
              'ID_COUNTRY' => $request->CountrySelect,
              'ID_PICTURE' => $id_FilePicture,
              'VENDOR_CODE_PROVIDER' => $request->VendoreCodeProvider,
              'Width' => $request->WidthProduct,
              'Height' => $request->HeightProduct,
              'length' => $request->LengthProduct,
              'Weight' => $request->WeightProduct,
              'IsNew' => 0,
              'IsLeader' => 0,
              'IsRecomend' => 0,
              'Price' => $request->PriceProduct,
              'ID_MATERIAL' => $request->MaterialSelect,
              'Count' => 0,
              'Description' => $request->text
            ]
          );
        }

        return redirect('/admin');

        // //вернуть ответ на запрос в JSON формате(Успешный ответ)
        // $response = array(
        //   'status' => 'success',
        //   'msg' => $request->message,
        // );
        // return response()->json($response);
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

        DB::table('product')
                            ->where('VENDOR_CODE', $request->VendoreCode)
                            ->delete();

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить артикул товаров и количество товара в магазине  из БД
      * На вход: идентификатор подкатегории
      * На выход: JSON файл с перчнем товаров из таблицы PRODUCT
      **/
      public function CountProduct(Request $request) {

        $Response = [];
        $AllProducts = DB::table('product')->where('ID_SUBCATEGORY', $request->id_SubCategory)->get();
        
        for ($i = 0; $i < sizeof($AllProducts); $i++) { 
          $LocalResponse = [
            'VendoreCode' => $AllProducts[$i]->VENDOR_CODE, 
            'Count' => $AllProducts[$i]->Count,
          ];

          array_push($Response, $LocalResponse);
        }

        return json_encode($Response);
      }

      /**
      * Обновить количество выбранного товара в БД
      * На вход: артикул товара и его количество
      * На выходе: ответ на успешлый и обработанный PUT-запрос
      **/
      public function UpdateCountProduct(Request $request) {
        DB::table('product')
                            ->where('VENDOR_CODE', $request->VendoreCode)
                            ->update(['Count' => $request->Count]);

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      /**
      * Получить список заказов и их статус из БД
      * На вход: ничего
      * На выход: JSON файл с перчнем заказов из таблицы ORDER
      **/
      public function GetOrdersStatus(Request $request) {

        $Response = [];

        $AllOrders = DB::table('order')->get();
        for ($i = 0; $i < sizeof($AllOrders); $i++) { 
          $StatusOrder = DB::table('statusorder')->where('ID_STATUSORDER', $AllOrders[$i]->ID_STATUSORDER)->first()->Name;
          $PaymentStatus = DB::table('paymentmethod')->where('id', $AllOrders[$i]->ID_PaymentMethod)->first()->name;
          $DeliveryStatus = DB::table('deliverymethod')->where('id', $AllOrders[$i]->ID_DeliveryMethod)->first()->name;

          $LocalResponse = [
            'id_Order' => $AllOrders[$i]->ID_ORDER,
            'email' => $AllOrders[$i]->email,
            'status' => $StatusOrder,
            'telephone' => $AllOrders[$i]->Telephone,
            'name' => $AllOrders[$i]->Name,
            'adress' => $AllOrders[$i]->Adress,
            'date' => $AllOrders[$i]->Date,
            'price' => $AllOrders[$i]->Price,
            'payment' => $PaymentStatus,
            'delivery' => $DeliveryStatus
          ];

          array_push($Response, $LocalResponse);
        }

        return json_encode($Response);
      }

      /**
      * Получить список продуктов определенного заказа из БД
      * На вход: идентификатор заказа
      * На выход: JSON файл с перчнем продуктов заказа из таблицы ORER_PRODUCT
      **/
      public function GetOrdersProducts(Request $request) {

        $Response = [];

        $AllOrders = DB::table('orer_product')->where('ID_ORDER', $request->id_Order)->get();

        for ($i = 0; $i < sizeof($AllOrders); $i++) {
          $SubProductID = DB::table('product')->where('VENDOR_CODE', $AllOrders[$i]->VENDOR_CODE)->first()->ID_SUBCATEGORY;
          $SubCategoryName = DB::table('subcategory')->where('ID_SUBCATEGORY', $SubProductID)->first()->Name;

          $LocalResponse = [
            'VendoreCode' => $AllOrders[$i]->VENDOR_CODE,
            'SubCategoryName' => $SubCategoryName,
            'Count' => $AllOrders[$i]->Count,
          ];

          array_push($Response, $LocalResponse);
        }

        return json_encode($Response);
      }

      /**
      * Получить список статусов для заказов из БД
      * На вход: ничего
      * На выход: JSON файл с перчнем статусов заказа из таблицы STATUSORDER
      **/
      public function GetAllStatus(Request $request) {
        $AllStatus = DB::table('statusorder')->get();

        return json_encode($AllStatus);
      }

      /**
      * Обновить стутус товара в БД
      * На вход: номер заказа, новый статус заказа
      * На выходе: ответ на успешлый и обработанный PUT-запрос
      **/
      public function UpdateStatusOrder(Request $request) {
        //если заказ отменен, тогда увеличить количество имеющегося товара в таблице PRODUCT
        if ($request->id_Status == 2) {
          //получить все продукты выбранного заказа
          $AllProductsOrder = DB::table('orer_product')->where('ID_ORDER', $request->id_Order)->get();
          for ($i = 0; $i < sizeof($AllProductsOrder); $i++) {
            //найти количество выбранного продукта в БД
            $ProductCount = DB::table('product')->where('VENDOR_CODE', $AllProductsOrder[$i]->VENDOR_CODE)->first()->Count;
            DB::table('product')
                              ->where('VENDOR_CODE', $AllProductsOrder[$i]->VENDOR_CODE)
                              ->update(['Count' => (int)($ProductCount + $AllProductsOrder[$i]->Count)]);
          }
        }
        DB::table('order')
                        ->where('ID_ORDER', $request->id_Order)
                        ->update(['ID_STATUSORDER' => $request->id_Status]);

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      //получить все письма для сайта
      public function GetAllMessages() {
        $Email = DB::table('email')->get();
        return json_encode($Email);
      }

      //получить все почтовые ящики для рассылки
      public function getAllEmail() {
        $Email = DB::table('dispatch')->get();
        return json_encode($Email);
      }

      //добавить побочную фотографию к товару
      //vendore - идентфиикатор товара
      //img - изображение
      public function AddSecondPic(Request $request) {

        if ($request->hasFile('img')) {

          $file = $request->file('img');
          $vendore = $request->vendore;
          $destinationPath =  public_path().'/img';
          $filename = $file->getClientOriginalName();

          //добавление файла в бд
          DB::table('secondpicture')->insert([
            'VENDOR_CODE' => $vendore,
            'Name' => $filename
          ]);
          //добавление файла в репозиторий
          if ($request->hasFile('img')) {
              $request->file('img')->move($destinationPath, $filename);
          }
          return redirect('/admin');
        }
        else {
          return redirect('/admin');
          //  $response = array(
          // 'status' => 'success',
          // 'msg' => $request->message,
        }
      }

      //добавить главную фотографию к товару
      //vendore - идентфиикатор товара
      //img - изображение
      // public function AddFirstPic(Request $request) {

      //   if ($request->hasFile('img')) {

      //     $file = $request->file('img');
      //     $vendore = $request->vendore;
      //     $destinationPath =  public_path().'/img';
      //     $filename = $file->getClientOriginalName();

      //     //добавление файла в бд
      //     DB::table('picture')->insert([
      //       'Name' => $filename
      //     ]);
          
      //     //добавление файла в репозиторий
      //     if ($request->hasFile('img')) {
      //         $request->file('img')->move($destinationPath, $filename);
      //     }
      //     return redirect('/admin');
      //   }
      //   else {
      //     return redirect('/admin');
      //     //  $response = array(
      //     // 'status' => 'success',
      //     // 'msg' => $request->message,
      //   }
      // }

      public function GetAllNews() {
        $News = DB::table('news')->get();
        return json_encode($News);
      }

      public function AddNewNews(Request $request) {
        DB::table('news')->insert([
          'Label' => $request->Label,
          'ShortText' => $request->ShortDesct,
          'Text' => $request->Text,
          'Date' => $request->Date
        ]);

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      public function DeleteNews(Request $request) {
        DB::table('news')->where('id', $request->NewsId)->delete();
        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
        );
        return response()->json($response);
      }

      public function GetOneProduct(Request $request) {
        $OneProduct = DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)->get();

        return json_encode($OneProduct);
      }

      public function UpdateOneProduct(Request $request) {

        $Product = DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)->get();
        if ($request->hasFile('img') == true) {
          $NameOldPic = DB::table('picture')->where("ID_PICTURE", $Product[0]->ID_PICTURE)->first()->Name;
          if ($NameOldPic != $request->file('img')->getClientOriginalName() ) {
            $namePic = self::createNamePicture( $request->file('img')->getClientOriginalName(), $request->VendoreCode);
            $idPic = DB::table('picture')->where('Name', $namePic)->get();
            if (sizeof($idPic) == 0) { //Была изменена картинка на новую
            //получить путь public/img
            $destinationPath =  public_path().'/img';
            //добавление файла в бд
            DB::table('picture')->insert([
              'Name' => $namePic
            ]);
            //Добавить новый файл в репозиторий
            $request->file('img')->move($destinationPath, $namePic);
            //получить ID  новой картинки
            $id_FilePicture = DB::table('picture')->where('Name', $namePic)->first()->ID_PICTURE;
            //получсить ID старой картинки
            $idOldPicture = DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)->first()->ID_PICTURE;
            //получить имя старой картинки по его ID
            $NameOldPicture = DB::table('picture')->where('ID_PICTURE', $idOldPicture)->first()->Name;
            //обновить продукт на новую картинку
            DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)
                                ->update(['ID_PICTURE' => $id_FilePicture]);
            //получсить полный путь старой картинки
            $AllPath = $destinationPath . "/" . $NameOldPicture;
            //удалить старую картинку из репозитория
            unlink($AllPath);
            //Удалить запись про старое изображение
            DB::table('picture')->where('ID_PICTURE', $idOldPicture)->delete();
          }
          else {
            // return var_dump("старая картинка!");
          }
          }
          else {
            // return var_dump("Выбрана старая картинка!");
          }
        }

        
        DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)
                            ->update([
                              'ID_SUBCATEGORY' => $request->SubCategorySelect,
                              'ID_BREND' => $request->BrendSelect,
                              'ID_MODEL' => $request->ModelSelect,
                              'ID_COUNTRY' => $request->CountrySelect,
                              'VENDOR_CODE_PROVIDER' => $request->VendoreCodeProvider,
                              'Width' => $request->WidthProduct,
                              'Height' => $request->HeightProduct,
                              'length' => $request->LengthProduct,
                              'Weight' => $request->WeightProduct,
                              'Price' => $request->PriceProduct,
                              'ID_MATERIAL' => $request->MaterialSelect,
                              'Count' => 0,
                              'Description' => $request->text
                            ]);

        //Новинка
        if ($request->CharacteristicProduct == "1") {
          DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)
                              ->update([
                                'IsNew' => "1",
                                'IsLeader' => "0",
                                'IsRecomend' => "0"
                              ]);
        }
        else if ($request->CharacteristicProduct == "2") { //Рекомендация
          DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)
                              ->update([
                                'IsNew' => "0",
                                'IsLeader' => "0",
                                'IsRecomend' => "1"
                              ]);
        }
        else if ($request->CharacteristicProduct == "3") { //Лидер
          DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)
                              ->update([
                                'IsNew' => "0",
                                'IsLeader' => "1",
                                'IsRecomend' => "0"
                              ]);
        }
        else { //Ничего
          DB::table('product')->where('VENDOR_CODE', $request->VendoreCode)
                              ->update([
                                'IsNew' => "0",
                                'IsLeader' => "0",
                                'IsRecomend' => "0"
                              ]);
        }

        return redirect('/admin');
      }
  }
