<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/tareasp',
        '/filtrouf',
        '/buscar',
        '/año',
        '/actividades',
        '/modulos',
        '/visitas',
        '/altainv',
        '/filtroalm',
        '/salida_inv',
        '/captura_a',
        '/editar',
        '/pintura_editar',
        'agregar_alimento',
        'agregar_pintura',
        '/imprimir_pintura',
        'exportar_excel',
        '/buscar_munloc',
        '/exportar_excel_a',
        '/buscar_folio',
        'pag_al',
        'repetidos_alimentos'

    ];
}
