@extends('layouts.master')

@section('content')

<div class="product-form">
    <h1>Select a Product voor {{ $werknemer->name }}</h1>

    <form action="{{ route('submit.form') }}" method="POST">
        @csrf
        <input type="hidden" name="werknemer_id" value="{{ $werknemer->id }}">

        <label for="product">Select a product:</label>
        <select name="product" id="product" style="color:#000000">
            @foreach($products as $product)
                <option style="color:#000000" value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" style="color:#000000">

        <button type="submit">Submit</button>
    </form>
</div>

@stop