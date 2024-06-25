<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\LoginController@index')->name('ir_login');
// Route::get('/', 'App\Http\Controllers\LoginController@irLogin')->name('ir_login');
Route::post('/login_process', 'App\Http\Controllers\LoginController@loginProcess');
Route::get('/administracion', 'App\Http\Controllers\LoginController@administracion')->name('administracion');
Route::post('/administracion', 'App\Http\Controllers\LoginController@logout')->name('logout');

// clientes
Route::get('/clientes', 'App\Http\Controllers\ClienteController@index')->name('cliente');
Route::get('/get_clientes', 'App\Http\Controllers\ClienteController@getClientes');
Route::post('/guardar_cliente', 'App\Http\Controllers\ClienteController@guardarCliente');
Route::post('/modificar_cliente', 'App\Http\Controllers\ClienteController@modificarCliente');
Route::post('/desactivar_cliente', 'App\Http\Controllers\ClienteController@desactivarCliente');
Route::post('/activar_cliente', 'App\Http\Controllers\ClienteController@activarCliente');


// categorias
Route::get('/categorias', 'App\Http\Controllers\CategoriaController@index');
Route::get('/get_categorias', 'App\Http\Controllers\CategoriaController@getCategorias');
Route::post('/guardar_categoria', 'App\Http\Controllers\CategoriaController@guardarCategoria');
Route::post('/modificar_categoria', 'App\Http\Controllers\CategoriaController@modificarCategoria');
Route::post('/desactivar_categoria', 'App\Http\Controllers\CategoriaController@desactivarCategoria');
Route::post('/activar_categoria', 'App\Http\Controllers\CategoriaController@activarCategoria');


// empleados
Route::get('/empleados', 'App\Http\Controllers\EmpleadoController@index');
Route::get('/get_empleados', 'App\Http\Controllers\EmpleadoController@getEmpleados');
Route::post('/guardar_empleado', 'App\Http\Controllers\EmpleadoController@guardarEmpleado');
Route::post('/modificar_empleado', 'App\Http\Controllers\EmpleadoController@modificarEmpleado');
Route::post('/desactivar_empleado', 'App\Http\Controllers\EmpleadoController@desactivarEmpleado');
Route::post('/activar_empleado', 'App\Http\Controllers\EmpleadoController@activarEmpleado');

// productos
Route::get('/productos', 'App\Http\Controllers\ProductoController@index');
Route::get('/get_productos', 'App\Http\Controllers\ProductoController@getProductos');
Route::post('/guardar_producto', 'App\Http\Controllers\ProductoController@guardarProducto');
Route::post('/modificar_producto', 'App\Http\Controllers\ProductoController@modificarProducto');
Route::post('/desactivar_producto', 'App\Http\Controllers\ProductoController@desactivarProducto');
Route::post('/activar_producto', 'App\Http\Controllers\ProductoController@activarProducto');

// roles
Route::get('/roles', 'App\Http\Controllers\RolController@index')->middleware('auth');
Route::get('/get_roles', 'App\Http\Controllers\RolController@getRoles');
Route::get('/get_roles_usuarios', 'App\Http\Controllers\RolController@getRolesUsuarios');
Route::get('/activar_rol', 'App\Http\Controllers\RolController@activar');
Route::get('/desactivar_rol', 'App\Http\Controllers\RolController@desactivar');
Route::post('/save_rol', 'App\Http\Controllers\RolController@save');
Route::post('/modify_rol', 'App\Http\Controllers\RolController@modify');

// usuarios
Route::get('/usuarios', 'App\Http\Controllers\UsuarioController@index')->middleware('auth');
Route::get('/get_usuarios', 'App\Http\Controllers\UsuarioController@getUsuarios');
Route::get('/activar_usuario', 'App\Http\Controllers\UsuarioController@activar');
Route::get('/desactivar_usuario', 'App\Http\Controllers\UsuarioController@desactivar');
Route::post('/save_usuario', 'App\Http\Controllers\UsuarioController@save');
Route::post('/modify_usuario', 'App\Http\Controllers\UsuarioController@modify');

// permisos
Route::get('/get_permisos', 'App\Http\Controllers\PermisoController@getPermisos');
Route::get('/get_permisos_rol', 'App\Http\Controllers\PermisoController@getPermisoRol');