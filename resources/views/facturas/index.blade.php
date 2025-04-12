@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Listado de Facturas</h1>
        <a href="{{ route('facturas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nueva Factura</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Número</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Cliente</th>
                    <th class="px-4 py-2">Vendedor</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($facturas as $factura)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $factura->numero }}</td>
                    <td class="px-4 py-2">{{ $factura->fecha->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $factura->cliente_nombre }}</td>
                    <td class="px-4 py-2">{{ $factura->vendedor }}</td>
                    <td class="px-4 py-2">
                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold 
                            {{ $factura->estado ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $factura->estado ? 'Activa' : 'Inactiva' }}
                        </span>
                    </td>
                    <td class="px-4 py-2">${{ number_format($factura->valor_total, 2) }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('facturas.show', $factura) }}" class="text-blue-600 hover:underline">Ver</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-4 text-center text-gray-500">No hay facturas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
