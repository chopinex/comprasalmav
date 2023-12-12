<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertenencia',
        'tipo_documento',
        'numero_documento',
        'fecha_documento',
        'proveedor',
        'area',
        'servicio',
        'proyecto',
        'moneda',
        'tipo_cambio',
        'total',
        'pagado',
        'fecha_pago',
        'detalle_pago',
        'comentario'
    ];
}
