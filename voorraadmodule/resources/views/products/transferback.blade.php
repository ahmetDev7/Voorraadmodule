@extends('layouts.master')

@section('content')
<h1>Product Details</h1>
<p>Product Number: {{ $product->productnummer }}</p>
<p>Name: {{ $product->name }}</p>
<p>Description: {{ $product->description }}</p>
<p>Category: {{ $product->category }}</p>

<h2>Quantities in Warehouses</h2>
@foreach($product->warehouses as $warehouse)
    <p>Warehouse ID: {{ $warehouse->id }}</p>
    <p>Quantity: {{ $warehouse->pivot->quantity }}</p>
@endforeach
@endsection