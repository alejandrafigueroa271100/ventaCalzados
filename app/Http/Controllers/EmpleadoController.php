<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class EmpleadoController extends Controller
{
    //
    public function index(){
        return view('frmEmpleado');
    }

    public function getEmpleados(Request $request){

        $empleados=DB::table('empleado')
        ->where($request->criterio, 'LIKE', '%'.$request->buscar.'%')
        ->get();
        return $empleados;
    }

    public function guardarEmpleado(Request $request){

        DB::table('empleado')
        ->insert([
            'nombre'=>$request->nombre,
            'apellidos'=>$request->apellidos,
            'telefono'=>$request->telefono,
            'direccion'=>$request->direccion,
            'sueldo'=>$request->sueldo,
        ]);
   
    }

    public function modificarEmpleado(Request $request){

        DB::table('empleado')
        ->where('id_empleado', $request->id_empleado)
        ->update([
            'nombre'=>$request->nombre,
            'apellidos'=>$request->apellidos,
            'telefono'=>$request->telefono,
            'direccion'=>$request->direccion,
            'sueldo'=>$request->sueldo,

        ]);
   
    }

    public function activarEmpleado(Request $request){

        DB::table('empleado')
        ->where('id_empleado', $request->id_empleado)
        ->update([
            'estado'=>0,
            
        ]);
   
    }

    public function desactivarEmpleado(Request $request){

        DB::table('empleado')
        ->where('id_empleado', $request->id_empleado)
        ->update([
            'estado'=>1,
            
        ]);
   
    }
}
