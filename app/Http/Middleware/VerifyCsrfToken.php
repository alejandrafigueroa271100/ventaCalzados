<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'get_clientes',
        'guardar_cliente',
        'modificar_cliente',
        'get_categorias',
        'guardar_categoria',
        'modificar_categoria',
        'get_empleados',
        'guardar_empleado',
        'modificar_empleado',
    ];
}
