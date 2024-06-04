@extends('layouts.master')

@section('content')
<div class="producten-pagina">
<h1> Serienummer toevoegen</h1>
<form action="{{ route('products.addSerial') }}" method="POST">
    @csrf

        <label>Productnummer</label>
    <select name="product" id="product">
        @foreach($products as $product)
        <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>

    <label for="serial_number">Serial Number:</label>
    <input type="text" id="serial_number" name="serial_number">

    <button type="submit">Add Product</button>
</form>