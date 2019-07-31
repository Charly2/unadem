<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use Maatwebsite\Excel\Excel;

Route::get('/', function () {


    $data=  DB::table('usuario')->get()->toArray();





    //return view('welcome');
});



Route::get('/prueba',function (){
    $header_item[] = array('Usuario', 'Password');
    $items = DB::table('docente')->take(30)->get();
    /*foreach($items as $item) {
        $header_item[] = array(
            'Usuario' => $item->usuario,
            'Password' => $item->password,
        );
    }*/
    Excel::create('Summary', function($excel) use ($items) {
        $excel->setTitle('Summary');
        $excel->sheet('Summary', function($sheet) use ($items) {
            //$sheet->fromArray($header_item, null, 'A1', false, false);
            $sheet->loadView('excel',['docente'=>$items]);
        });
    })->download('xlsx');
});

