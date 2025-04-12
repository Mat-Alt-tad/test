{{-- filepath: c:\Users\Matlag\Desktop\programacion\testeo\testApp\resources\views\facturas\create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Crear Factura</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('facturas.store') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="numero" class="block text-sm font-medium">Número de Factura</label>
                <input type="text" id="numero" name="numero" value="{{ old('numero') }}" class="w-full border-gray-300 rounded p-2">
                @error('numero')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="fecha" class="block text-sm font-medium">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" class="w-full border-gray-300 rounded p-2">
                @error('fecha')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cliente_nombre" class="block text-sm font-medium">Cliente</label>
                <input type="text" id="cliente_nombre" name="cliente_nombre" value="{{ old('cliente_nombre') }}" class="w-full border-gray-300 rounded p-2">
                @error('cliente_nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="vendedor" class="block text-sm font-medium">Vendedor</label>
                <input type="text" id="vendedor" name="vendedor" value="{{ old('vendedor') }}" class="w-full border-gray-300 rounded p-2">
                @error('vendedor')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium">Estado</label>
                <select id="estado" name="estado" class="w-full border-gray-300 rounded p-2">
                    <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activa</option>
                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactiva</option>
                </select>
                @error('estado')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <h2 class="text-lg font-semibold mt-6 mb-2">Ítems</h2>
            <div id="items-container" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <input type="text" name="detalles[0][articulo]" placeholder="Artículo" class="border-gray-300 rounded p-2">
                    <input type="number" name="detalles[0][cantidad]" placeholder="Cantidad" class="border-gray-300 rounded p-2" oninput="calcularTotal()">
                    <input type="number" step="0.01" name="detalles[0][precio_unitario]" placeholder="Precio Unitario" class="border-gray-300 rounded p-2" oninput="calcularTotal()">
                </div>
            </div>
            <button type="button" onclick="agregarItem()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Agregar Ítem</button>
        </div>

        <div class="mt-4">
            <label for="valor_total" class="block text-sm font-medium">Valor Total</label>
            <input type="text" id="valor_total" name="valor_total" readonly class="w-full border-gray-300 rounded p-2 bg-gray-100">
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Guardar Factura</button>
    </form>
</div>

<script>
    let index = 1;
    function agregarItem() {
        const container = document.getElementById('items-container');
        const div = document.createElement('div');
        div.classList.add('grid', 'grid-cols-1', 'sm:grid-cols-3', 'gap-2');
        div.innerHTML = `
            <input type="text" name="detalles[${index}][articulo]" placeholder="Artículo" class="border-gray-300 rounded p-2">
            <input type="number" name="detalles[${index}][cantidad]" placeholder="Cantidad" class="border-gray-300 rounded p-2" oninput="calcularTotal()">
            <input type="number" step="0.01" name="detalles[${index}][precio_unitario]" placeholder="Precio Unitario" class="border-gray-300 rounded p-2" oninput="calcularTotal()">
        `;
        container.appendChild(div);
        index++;
    }

    function calcularTotal() {
        let total = 0;
        const items = document.querySelectorAll('#items-container > div');
        items.forEach(item => {
            const cantidad = item.querySelector('input[name*="[cantidad]"]').value || 0;
            const precio = item.querySelector('input[name*="[precio_unitario]"]').value || 0;
            total += cantidad * precio;
        });
        document.getElementById('valor_total').value = total.toFixed(2);
    }
</script>
@endsection