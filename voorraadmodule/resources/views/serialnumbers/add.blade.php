@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>Serienummer toevoegen</h1>
    <form class="default-form" action="{{ route('addserialnumbers.add') }}" method="post">
        @csrf
        <label>Selecteer een product</label>
        <select style="color:black;" name="existing_product_id">
            <option disabled selected>-- Selecteer een product --</option>
            @foreach($products as $product)
            <option style="color:black;" value="{{ $product->id }}">{{ $product->name }} (Productnummer: {{ $product->productnummer }})</option>
            @endforeach
        </select>
        <label>Serienummer</label>
        <input type="text" name="serialnumber_exist" value="">
        @if ($errors->has('serialnumber'))
        <p style="color:#FF0000;">{{ $errors->first('serialnumber') }}</p>
        @endif
        <input class="submit" type="submit" value="Toevoegen" />
        @if(session()->has('success'))
        <div style="color:green" class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div style="color:red" class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

</div>
@stop