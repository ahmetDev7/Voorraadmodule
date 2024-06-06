@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>OPSLAGLOCATIE AANPASSEN</h1>
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
        <input type="text" name="huisnummer" value="{{ $warehouse->housenumber }}">
        @if ($errors->has('huisnummer'))
        <p style="color:#FF0000;">{{ $errors->first('huisnummer') }}</p>
        @endif
        <label>Postcode</label>
        <input type="text" name="postcode" value="{{ $warehouse->zipcode }}">
        @if ($errors->has('postcode'))
        <p style="color:#FF0000;">{{ $errors->first('postCode') }}</p>
        @endif
        <label>Stad</label>
        <input type="text" name="stad" value="{{ $warehouse->city }}">
        @if ($errors->has('stad'))
        <p style="color:#FF0000;">{{ $errors->first('stad') }}</p>
        @endif
        <label>Land</label>
        <input type="text" name="land" value="{{ $warehouse->country }}">
        @if ($errors->has('land'))
        <p style="color:#FF0000;">{{ $errors->first('land') }}</p>
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
