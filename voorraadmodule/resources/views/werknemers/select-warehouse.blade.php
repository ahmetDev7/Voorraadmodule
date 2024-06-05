@extends('layouts.master')

@section('content')

<div class="warehouse-form">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: black;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 style="color: black;">Selecteer een magazijn {{ $product->name }} {{$werknemer->name}}</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <input type="hidden" name="werknemer_id" value="{{ $werknemerId }}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <label for="warehouse" style="color: black;">Select a warehouse: </label>
        <select name="warehouse" id="warehouse" onchange="updateMaxQuantity()" style="color: black;">
            @if ($warehouses->isEmpty())
                <option value="" disabled style="color: black;">Geen warehouses die deze product heeft</option>
            @else
                <option value=-1> --kies een magazijn</option>
                @foreach($warehouses as $warehouse)

                    <option value="{{ $warehouse->id }}"
                        data-quantity="{{ $warehouse->products->firstWhere('id', $product->id)->pivot->quantity ?? 0 }}"
                        style="color: black;">
                        {{ $warehouse->name }} (Quantity:
                        @forelse($warehouse->products as $product)
                            {{ $product->pivot->quantity }}
                        @empty
                            niet beschikbaar
                        @endforelse
                        )
                    </option>
                @endforeach
            @endif
        </select>

        <label for="quantity" style="color: black;">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" style="color: black;">

        <button type="submit" style="color: black;">Verzend</button>
    </form>

    <a href="{{ route('products.select', ['werknemerId' => $werknemerId]) }}" style="color: black;">Ga terug naar
        producten</a>

</div>

<script>
    function updateMaxQuantity() {
        const warehouseSelect = document.getElementById('warehouse');
        const selectedOption = warehouseSelect.options[warehouseSelect.selectedIndex];
        const maxQuantity = selectedOption.getAttribute('data-quantity');
        document.getElementById('quantity').max = maxQuantity;
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateMaxQuantity();
    });
</script>

@stop
