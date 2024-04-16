@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>PRODUCT TOEVOEGEN</h1>
    <form class="default-form" action="{{ route('products.add') }}" method="post">
        @csrf
        <label>Serienummer</label>
        <input type="text" name="serialnumber" value="">
        <label>Naam</label>
        <input type="text" name="name" value="">
        <label>Beschrijving</label>
        <textarea type="text" name="description" value=""></textarea>
        <label>Categorie</label>
        <input type="text" name="category" value="">
        <input class="submit" type="submit" value="Toevoegen"/>
    </form>
</div>
@stop