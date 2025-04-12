<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class FacturasController extends Controller
{
   public function create()
   {
      return view('facturas.create');
   }

   public function store(Request $request)
   {
      $request->validate([
         'numero' => 'required|integer|unique:facturas,numero',
         'fecha' => 'required|date',
         'cliente_nombre' => 'required|string|max:255',
         'vendedor' => 'required|string|max:255',
         'estado' => 'boolean',
         'detalles' => 'required|array',
         'detalles.*.articulo' => 'required|string|max:255',
         'detalles.*.cantidad' => 'required|integer|min:1',
         'detalles.*.precio_unitario' => 'required|numeric|min:0',
      ]);

      DB::beginTransaction();
      try {
         $valor_total = 0;

         // Crear la factura principal
         $factura = Factura::create([
            'numero' => $request->numero,
            'fecha' => $request->fecha,
            'cliente_nombre' => $request->cliente_nombre,
            'vendedor' => $request->vendedor,
            'estado' => $request->estado ?? false,
            'valor_total' => 0, // Se actualizará después
         ]);

         // Crear los detalles de la factura
         foreach ($request->detalles as $detalle) {
            $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
            $valor_total += $subtotal;

            $factura->detalles()->create([
               'articulo' => $detalle['articulo'],
               'cantidad' => $detalle['cantidad'],
               'precio_unitario' => $detalle['precio_unitario'],
               'subtotal' => $subtotal,
            ]);
         }

         // Actualizar el valor total de la factura
         $factura->update(['valor_total' => $valor_total]);

         DB::commit();
         return redirect()->route('facturas.index')->with('success', 'Factura creada exitosamente.');
      } catch (\Exception $e) {
         DB::rollBack();
         return redirect()->route('facturas.index')->with('error', 'Error al crear la factura: ' . $e->getMessage());
      }
   }

   public function index()
   {
      $facturas = Factura::with('detalles')->get();
      return view('facturas.index', compact('facturas'));
   }

   public function show($id)
   {
      $factura = Factura::with('detalles')->findOrFail($id);
      return view('facturas.show', compact('factura'));
   }
}
