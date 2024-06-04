@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>PRODUCT AANPASSEN</h1>
    <form class="default-form" method="POST" action="{{ route('products.update', ['id' => $product->id]) }}">
        @csrf
        @method('PUT')
        <label>Productnummer</label>
        <input type="text" name="productnummer" value="{{ $product->productnummer }}">
        @if ($errors->has('productnummer'))
        <p style="color:#FF0000;">{{ $errors->first('serialnumber') }}</p>
        @endif
        <label>Serienummer</label>
        <input type="text" name="serialnumber" value="{{ $product->serialnumber }}">
        @if ($errors->has('serialnumber'))
        <p style="color:#FF0000;">{{ $errors->first('serialnumber') }}</p>
        @endif
        <label>Naam</label>
        <input type="text" name="name" value="{{ $product->name }}">
        @if ($errors->has('name'))
        <p style="color:#FF0000;">{{ $errors->first('name') }}</p>
        @endif
        <label>Beschrijving</label>
        <textarea name="description">{{ $product->description }}</textarea>
        @if ($errors->has('description'))
        <p style="color:#FF0000;">{{ $errors->first('description') }}</p>
        @endif
        <label>Categorie</label>
        <input type="text" name="category" value="{{ $product->category }}">
        @if ($errors->has('category'))
        <p style="color:#FF0000;">{{ $errors->first('category') }}</p>
        @endif

        @foreach ($product->warehouses as $warehouse)
        <div>
            <br>
            <label>{{ $warehouse->name }}</label>
            <input type="hidden" name="itemQuantities[{{ $warehouse->id }}][warehouse_id]" value="{{ $warehouse->id }}">
            <input type="text" name="itemQuantities[{{ $warehouse->id }}][quantity]" value="{{ $warehouse->pivot->quantity }}">
            @if ($errors->has("itemQuantities.{$warehouse->id}.quantity"))
            <p style="color:#FF0000;">{{ $errors->first("itemQuantities.{$warehouse->id}.quantity") }}</p>
            @endif
            <input type="submit" name="deleteWarehouse[{{ $warehouse->id }}]" class="submit delete-button" value="product verwijderen uit opslag" />
        </div>
        @endforeach

        <input class="submit" type="submit" value="Aanpassen" />
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </form>
</div>
@stop