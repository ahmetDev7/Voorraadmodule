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

        

        <input class="submit" type="submit" value="Aanpassen" />
        @if(session()->has('success'))
        <div style="color:green" class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </form>
</div>
@stop