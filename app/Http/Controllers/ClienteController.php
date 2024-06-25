<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ClienteController extends Controller
{
    //
    public function index(){
        return view('frmCliente');
    }

    public function getClientes(Request $request){
        $clientes = DB::table('cliente')
        ->where($request->criterio, 'LIKE', '%'.$request->buscar.'%')
        ->get();
        return $clientes;
    }

    public function guardarCliente(Request $request){
        DB::table('cliente')->insert([
            'nombre'=>$request->nombre,
            'apellidos'=>$request->apellidos,
            // 'empresa'=>$request->empresa,
            'telefono'=>$request->telefono,
            'direccion'=>$request->direccion,
        ]);
    }

    public function modificarCliente(Request $request){
        DB::table('cliente')->where('id_cliente', $request->id_cliente)->update([
            'nombre'=>$request->nombre,
            'apellidos'=>$request->apellidos,
            // 'empresa'=>$request->empresa,
            'telefono'=>$request->telefono,
            'direccion'=>$request->direccion,
        ]);
    }

    public function desactivarCliente(Request $request){
        DB::beginTransaction();
        try{
            DB::table('cliente')->where('id_cliente', $request->id_cliente)->update([
                'estado'=>1,
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function activarCliente(Request $request){
        DB::beginTransaction();
        try{
            DB::table('cliente')->where('id_cliente', $request->id_cliente)->update([
                'estado'=>0,
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }
}
