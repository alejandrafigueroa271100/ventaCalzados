<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RolController extends Controller
{
    //
     //
     public function index(){
        return view('frmRol');
    }

    public function save(Request $request){
        //dd($request);
        DB::beginTransaction();
        try{
            $rolId = DB::table('rol')->insertGetId([
                'nombre' => $request->nombre,
            ]);
            
            foreach($request->permisos as $permiso){
                DB::table('permiso_rol')->insert([
                    'id_permiso'=>$permiso['id'],
                    'id_rol'=>$rolId ,
                ]);
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            dd($e);
        }
        

    }

    public function modify(Request $request){
        //dd($request);
        DB::beginTransaction();
        try{
            DB::table('rol')->where('rol.id', $request->id_rol)->update([
                'nombre' => $request->nombre,
            ]);
            
            // foreach($request->permisos as $permiso){
                DB::table('permiso_rol')
                // ->where('id_permiso', $permiso['id'])
                ->where('id_rol', $request->id_rol )
                ->delete();
            // }
            foreach($request->permisos as $permiso){
                DB::table('permiso_rol')->insert([
                    'id_permiso'=>$permiso['id'],
                    'id_rol'=>$request->id_rol ,
                ]);
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            dd($e);
        }
        

    }

    public function getRoles(){
        return DB::table('rol')->get();
    }

    public function getRolesUsuarios(){
        return DB::table('rol')
        ->where('estado', 1)
        ->get();
    }

    public function activar(Request $request){
        DB::table('rol')->where('id', $request->id_rol)->update([
            'estado'=>1
        ]);
    }

    public function desactivar(Request $request){
        DB::table('rol')->where('id', $request->id_rol)->update([
            'estado'=>0
        ]);
    }
}
