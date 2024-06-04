@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>PRODUCT AANPASSEN</h1>
    <form class="default-form" method="POST" action="{{ route('warehouses.update', ['id' => $warehouse->id]) }}">
        @csrf
        @method('PUT')
        <label>Naam</label>
        <input type="text" name="naam" value="{{ $warehouse->name }}">
        @if ($errors->has('naam'))
        <p style="color:#FF0000;">{{ $errors->first('naam') }}</p>
        @endif
        <label>straat</label>
        <input type="text" name="straat" value="{{ $warehouse->street }}">
        @if ($errors->has('straat'))
        <p style="color:#FF0000;">{{ $errors->first('straat') }}</p>
        @endif
        <label>Huisnummer</label>
        <input type="text" name="Huisnummer" value="{{ $warehouse->housenumber }}">
        @if ($errors->has('Huisnummer'))
        <p style="color:#FF0000;">{{ $errors->first('Huisnummer') }}</p>
        @endif
        <input type="text" name="Huisnummer" value="{{ $warehouse->housenumber }}">
        @if ($errors->has('Huisnummer'))
        <p style="color:#FF0000;">{{ $errors->first('Huisnummer') }}</p>
        @endif

        <input class="submit" type="submit" value="Aanpassen" />
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </form>
</div>
@stop
