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
       *  На выход: json файл 
       *  со всем категориями из таблицы CAREGORY 
       **/
      public function ShowCategory() {
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

    }
