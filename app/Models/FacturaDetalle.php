<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacturaDetalle extends Model
{
    use HasFactory;
    protected $table = 'facturas_detalle';
    protected $fillable = [
        'factura_id',
        'articulo',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];
    protected $casts = [
        'factura_id' => 'integer',
        'cantidad' => 'integer',
        'precio_unitario' => 'float',
        'subtotal' => 'float'
    ];
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
