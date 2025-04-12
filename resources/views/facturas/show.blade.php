@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Factura #{{ $factura->numero }}</h1>

    <div class="bg-white border rounded p-6 shadow space-y-3">
        <p><strong>Fecha:</strong> {{ $factura->fecha->format('Y-m-d') }}</p>
        <p><strong>Cliente:</strong> {{ $factura->cliente_nombre }}</p>
        <p><strong>Vendedor:</strong> {{ $factura->vendedor }}</p>
        <p><strong>Estado:</strong>
            <span class="inline-block px-2 py-1 rounded text-xs font-semibold 
                {{ $factura->estado ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                {{ $factura->estado ? 'Activa' : 'Inactiva' }}
            </span>
        </p>
        <p><strong>Total:</strong> ${{ number_format($factura->valor_total, 2) }}</p>
    </div>

    <h2 class="text-xl font-semibold mt-8 mb-2">Detalle de Ítems</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Artículo</th>
                    <th class="px-4 py-2">Cantidad</th>
                    <th class="px-4 py-2">Precio Unitario</th>
                    <th class="px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($factura->detalles as $detalle)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $detalle->articulo }}</td>
                    <td class="px-4 py-2">{{ $detalle->cantidad }}</td>
                    <td class="px-4 py-2">${{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td class="px-4 py-2">${{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('facturas.index') }}" class="mt-6 inline-block text-blue-600 hover:underline">← Volver al listado</a>
</div>
@endsection
