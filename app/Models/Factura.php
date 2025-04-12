<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'facturas';
    protected $fillable = [
        'numero',
        'fecha',
        'cliente_nombre',
        'vendedor',
        'estado',
        'valor_total'
    ];
    protected $casts = [
        'numero' => 'integer',
        'fecha' => 'date',
        'cliente_nombre' => 'string',
        'vendedor' => 'string',
        'estado' => 'boolean',
        'valor_total' => 'float'
    ];
    public function detalles()
    {
        return $this->hasMany(FacturaDetalle::class, 'factura_id');
    }
}
