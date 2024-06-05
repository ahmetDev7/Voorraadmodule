@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>Opslaglocatie toevoegen</h1>
    <form class="default-form" action="{{ route('warehouses.add') }}" method="post">
        @csrf
        <label>Naam</label>
        @if ($errors->has('name')) <p style="color:#FF0000;">{{ $errors->first('name') }}</p> @endif
        <input type="text" name="name" value="">
        <label>Straat</label>
        @if ($errors->has('street')) <p style="color:#FF0000;">{{ $errors->first('street') }}</p> @endif
        <input type="text" name="street" value="">
        <label>Huisnummer</label>
        @if ($errors->has('housenumber')) <p style="color:#FF0000;">{{ $errors->first('housenumber') }}</p> @endif
        <input type="text" name="housenumber" value="">
        <label>Postcode</label>
        @if ($errors->has('zipcode')) <p style="color:#FF0000;">{{ $errors->first('zipcode') }}</p> @endif
        <input type="text" name="zipcode" value="">
        <label>Stad</label>
        @if ($errors->has('city')) <p style="color:#FF0000;">{{ $errors->first('city') }}</p> @endif
        <input type="text" name="city" value="">
        <label>Land</label>
        @if ($errors->has('country')) <p style="color:#FF0000;">{{ $errors->first('country') }}</p> @endif
        <input type="text" name="country" value="">
        <input class="submit" type="submit" value="Toevoegen" />
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </form>
</div>
@stop