@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>PRODUCT TOEVOEGEN</h1>
    <form class="default-form" action="{{ route('products.add') }}" method="post">
        @csrf
        <label>Productnummer</label>
        <input type="text" name="productnummer" value="">
        @if ($errors->has('productnummer'))
        <p style="color:#FF0000;">{{ $errors->first('productnummer') }}</p>
        @endif
        <label>Naam</label>
        <input type="text" name="name" value="">
        @if ($errors->has('name'))
        <p style="color:#FF0000;">{{ $errors->first('name') }}</p>
        @endif
        <label>Beschrijving</label>
        <textarea type="text" name="description" value=""></textarea>
        @if ($errors->has('description'))
        <p style="color:#FF0000;">{{ $errors->first('description') }}</p>
        @endif
        <label>Categorie</label>
        <input type="text" name="category" value="">
        @if ($errors->has('category'))
        <p style="color:#FF0000;">{{ $errors->first('category') }}</p>
        @endif
        <input class="submit" type="submit" value="Toevoegen" />
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </form>
</div>
@stop