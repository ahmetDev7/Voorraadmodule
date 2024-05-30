@extends('layouts.master')

@section('content')

<div class="product-form">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Select a Product voor {{ $werknemer->name }}</h1>

    <form action="{{ url('/werknemers/producten/toevoegen/' . $werknemer->id) }}" method="POST">
        @csrf
        <input type="hidden" name="werknemer_id" value="{{ $werknemer->id }}">


        <label for="warehouseSelect">Select a Warehouse to obtain a product from:</label>

        <select name="WarehouseSelect" id="WarehouseSelect" onchange="updateSecondSelect()" style="color:#000000">
            @foreach($warehouse as $warehouse)
                <option style="color:#000000" value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
{{--
        <script>
            function updateSecondSelect() {
                const WarehouseSelect = document.getElementById('WarehouseSelect');
                const productSelect = document.getElementById('product');

                options =

                // Clear existing options in the second select
                secondSelect.innerHTML = '<option value="">--Select an option--</option>';

                // Get the options for the selected category
                const selectedOptions = options[firstSelect.value] || [];

                // Add new options to the second select
                selectedOptions.forEach(option => {
                    const newOption = document.createElement('option');
                    newOption.value = option.value;
                    newOption.text = option.text;
                    secondSelect.appendChild(newOption);
                });
            }
        </script> --}}

        <br>

        <label for="product"> Select a product:</label>
        <select name="product" id="product" style="color:#000000">
            @foreach($products->where as $product)
                <option style="color:#000000" value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>

        <br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" style="color:#000000">

        <button type="submit">Submit</button>
    </form>
</div>

@stop
