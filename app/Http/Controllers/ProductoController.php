<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductoController extends Controller
{
    //
    public function index(){
        return view('frmProducto');
    }

    public function getProductos(Request $request){
        return DB::table('producto')
        ->join('categoria', 'producto.id_categoria', '=', 'categoria.id_categoria')
        ->select('producto.id_categoria', 'producto.estado', 'producto.id_producto', 'producto.nombre', 'producto.tamanio', 'producto.precio', 'categoria.nombre as categoria')
        ->where($request->criterio, 'LIKE', '%'.$request->buscar.'%')->get();
    }

    public function guardarProducto(Request $request){
        DB::table('producto')->insert([
            'nombre'=>$request->nombre,
            'tamanio'=>$request->tamanio,
            'precio'=>$request->precio,
            'id_categoria'=>$request->id_categoria,
            
        ]);
    }

    public function modificarProducto(Request $request){
        DB::table('producto')->where('producto.id_producto', $request->id_producto)->update([
            'nombre'=>$request->nombre,
            'tamanio'=>$request->tamanio,
            'precio'=>$request->precio,
            'id_categoria'=>$request->id_categoria,
        ]);
    }

    public function activarProducto(Request $request){
        DB::table('producto')->where('producto.id_producto', $request->id_producto)->update([
            'estado'=>0,
        ]);
    }

    public function desactivarProducto(Request $request){
        DB::table('producto')->where('producto.id_producto', $request->id_producto)->update([
            'estado'=>1,
        ]);
    }
}
