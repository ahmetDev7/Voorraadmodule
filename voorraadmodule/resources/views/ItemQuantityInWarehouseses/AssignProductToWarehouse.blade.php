@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>PRODUCT TOEVOEGEN AAN OPSLAG LOCATIE</h1>
    <form class="default-form" action="{{ route('itemquantityinwarehouses.assignProductToWarehouse', ['id' => $product->id]) }}" method="post">
        @csrf

        <label>Productnummer</label>
        <input type="text" name="id" value="{{ $product->productnummer }}" readonly>
        <label>Hoeveelheid</label>
        <input type="text" name="quantity" value="">
        <label>Opslaglocatie ID</label>
        <select style="color: black;" name="warehouse_id">
            @foreach($warehouses as $warehouse)
            <option style="color: black;" value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
        <input class="submit" type="submit" value="Toevoegen"/>
    </form>
</div>
@stop