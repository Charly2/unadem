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


    //$data=  DB::table('usuario')->get()->toArray();





    return view('welcome');
});



Route::get('/prueba',function (){

    $items = DB::table('docente')->take(30)->get();
    $docente  = DB::select('SELECT * FROM `evaluacionDocente` e inner join docente d on e.docente = d.folio where e.evaluacion = 1 and e.periodo = "2018-2S-B2" and e.fechaTermino is not null');
    $data  = [];
    foreach ($docente as $d) {
        $aux = [];
        $aux['evalucion'] = $d;
        $indicadorcali = DB::table('indicadorCalificacion')->where('idEvaluacion', $d->idEvaluacionDocente)->orderBy('indicador', 'ASC')->get();
        foreach ($indicadorcali as $i ){
            $aux['calificaciones'][] = $i->calificacion;
        }
        $obs=  DB::select('select * from evaluacionObservacion e inner join observaciones o on  o.idObservacion = e.observacion where e.evaluacion = "'.$d->idEvaluacionDocente.'" ');
        $aux['obs'] = $obs;
        $data[] = $aux;
    }

    $criterios = DB::table('criterio')->where('idEvaluacion',1)->get();
    $header = [];
    foreach ($criterios as $c){
        $aux = [];
        $aux['titulo'] = $c->nombre;
        $indi = DB::table('indicador')->where('idCriterio',$c->idCriterio)->get();
        foreach ($indi as $i ){
            $aux['items'][] = $i->titulo;
        }
        $header[]= $aux;
    }
    Excel::create('Summary', function($excel) use ($data,$header) {
        $excel->setTitle('Summary');
        $excel->sheet('Summary', function($sheet) use ($data,$header) {
            //$sheet->fromArray($header_item, null, 'A1', false, false);
            $sheet->loadView('excel',['docente'=>$data,'criterios'=>$header]);
        });
    })->download('xlsx');
});



Route::get('/tabla',function (){



    $items = DB::table('docente')->take(30)->get();
    $docente  = DB::select('SELECT * FROM `evaluacionDocente` e inner join docente d on e.docente = d.folio where e.evaluacion = 1 and e.periodo = "2018-2S-B2" and e.fechaTermino is not null');
    $data  = [];
    foreach ($docente as $d) {
        $aux = [];
        $aux['evalucion'] = $d;
        $indicadorcali = DB::table('indicadorCalificacion')->where('idEvaluacion', $d->idEvaluacionDocente)->orderBy('indicador', 'ASC')->get();
        foreach ($indicadorcali as $i ){
            $aux['calificaciones'][] = $i->calificacion;
        }
        $obs=  DB::select('select * from evaluacionObservacion e inner join observaciones o on  o.idObservacion = e.observacion where e.evaluacion = "'.$d->idEvaluacionDocente.'" ');
        $aux['obs'] = $obs;
        $data[] = $aux;
    }

    $criterios = DB::table('criterio')->where('idEvaluacion',1)->get();
    $header = [];
    foreach ($criterios as $c){
        $aux = [];
        $aux['titulo'] = $c->nombre;
        $indi = DB::table('indicador')->where('idCriterio',$c->idCriterio)->get();
        foreach ($indi as $i ){
            $aux['items'][] = $i->titulo;
        }
        $header[]= $aux;
    }






    return view('excel',['docente'=>$data,'criterios'=>$header]);
});