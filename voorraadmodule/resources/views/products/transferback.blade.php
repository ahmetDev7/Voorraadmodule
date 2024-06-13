@extends('layouts.master')

@section('content')
<form action="{{ route('product.done') }}" class="default-form" method="POST" style="color: black;">
    @csrf
    <input type="hidden" name="ownerid" value="{{ $owner->id }}">
    <input type="hidden" name="productid" value="{{ $product->id }}">
    <input type="hidden" name="productid" value="{{ $product->id }}">

    <label for="warehouse" style="color: black;">Selecteer een magazijn</label>
    <select name="warehouse" id="warehouse" style="color: black;">
        @foreach($warehouses as $warehouse)
            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
        @endforeach
    </select>

    <button type="submit" style="color: black;">verzenden</button>
</form>
@stop