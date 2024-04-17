@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>PRODUCT AANPASSEN</h1>
    <form class="default-form" method="POST" action="{{ route('products.update', ['id' => $product->id]) }}">
        @csrf
        @method('PUT')
        <label>Serienummer</label>
        <input type="text" name="serialnumber" value="{{ $product->serialnumber }}">
        <label>Naam</label>
        <input type="text" name="name" value="{{ $product->name }}">
        <label>Beschrijving</label>
        <textarea name="description">{{ $product->description }}</textarea>
        <label>Categorie</label>
        <input type="text" name="category" value="{{ $product->category }}">
        <input class="submit" type="submit" value="Aanpassen" />
    </form>
</div>
@stop