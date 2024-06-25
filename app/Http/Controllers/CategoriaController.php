<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoriaController extends Controller
{
    //
    public function index(){
        return view('frmCategoria');
    }

    public function getCategorias(Request $request){
        $categorias=DB::table('categoria')
        ->where($request->criterio, 'LIKE', '%'.$request->buscar.'%')
        ->get();

        return $categorias;
    }

    public function guardarCategoria(Request $request){
        $categorias=DB::table('categoria')
        ->insert([
            'nombre'=>$request->nombre,
        ]);

    }

    public function modificarCategoria(Request $request){
        $categorias=DB::table('categoria')
        ->where('id_categoria', $request->id_categoria)
        ->update([
            'nombre'=>$request->nombre,
        ]);

    }

    public function activarCategoria(Request $request){
        $categorias=DB::table('categoria')
        ->where('id_categoria', $request->id_categoria)
        ->update([
            'estado'=>0,
        ]);

    }

    public function desactivarCategoria(Request $request){
        $categorias=DB::table('categoria')
        ->where('id_categoria', $request->id_categoria)
        ->update([
            'estado'=>1,
        ]);

    }
}
