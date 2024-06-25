<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //
    public function index(){
        return view('frmUsuario');
    }

    public function getUsuarios(){
        return DB::table('users')->join('rol', 'users.id_rol', '=', 'rol.id')
        ->select('users.*', 'rol.nombre as rol')->paginate(15);
    }

    public function activar(Request $request){
        DB::table('users')->where('users.id', $request->id_usuario)->update([
            'estado'=>1
        ]);
    }

    public function desactivar(Request $request){
        DB::table('users')->where('users.id', $request->id_usuario)->update([
            'estado'=>0
        ]);
    }

    public function save(Request $request){
        DB::table('users')->insert([
            'name'=>$request->nombre,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'id_rol'=>$request->id_rol,
            'id_empleado'=>$request->id_empleado,
        ]);

    }

    public function modify(Request $request){
        DB::table('users')->where('id', $request->id_usuario)->update([
            'name'=>$request->nombre,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'id_rol'=>$request->id_rol,
            'id_empleado'=>$request->id_empleado,

        ]);

    }
}
