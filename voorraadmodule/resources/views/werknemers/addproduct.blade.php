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


    <form action="{{ route('products.index') }}" method="POST">
        @csrf
        <input type="hidden" name="werknemer_id" value="{{ $werknemerId }}">

        <label for="product" style="color: black;">Selecteer een product:</label>
        <select name="product_id" id="product" style="color: black;">
            <option value=-1> --kies een Product</option>

            @foreach($productsSelect as $product)
                <option value="{{ $product->id }}" style="color: black;">{{ $product->name }}</option>
            @endforeach
        </select>

        <button type="submit" style="color: black;">Verzend</button>
    </form>

</div>

@stop
