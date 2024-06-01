@extends('layouts.master')

@section('content')

<div class="product-form">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: black;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 style="color: black;">Select a Product</h1>

    <form action="{{ route('products.index') }}" method="POST">
        @csrf
        <input type="hidden" name="werknemer_id" value="{{ $werknemerId }}">

        <label for="product" style="color: black;">Select a product:</label>
        <select name="product_id" id="product" style="color: black;">
            @foreach($products as $product)
                <option value="{{ $product->id }}" style="color: black;">{{ $product->name }}</option>
            @endforeach
        </select>

        <button type="submit" style="color: black;">Submit</button>
    </form>

</div>

@stop