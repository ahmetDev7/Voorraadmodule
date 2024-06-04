@extends('layouts.master')

@section('content')
<form action="{{ route('product.done') }}" class="default-form" method="POST">
    @csrf
    <input type="hidden" name="ownerid" value="{{ $owner->id}}">
    <input type="hidden" name="productid" value="{{ $product->id }}">


    <label for="quantity">Hoeveelheid beschikbaar: {{$quantity}}</label>
    <input type="number" name="quantity" id="quantity" min="1" max="{{ $quantity }}">

    <label for="warehouse">Selecteer een magazijn</label>
    <select name="warehouse" id="warehouse">
        @foreach($warehouses as $warehouse)
            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
        @endforeach
    </select>



    <button type="submit">verzenden</button>
</form>

<script>
    document.getElementById('quantity').addEventListener('input', function () {
        var maxQuantity = {{ $quantity }};
        if (parseInt(this.value) > maxQuantity) {
            this.value = maxQuantity;
        }
    });
</script>
@stop