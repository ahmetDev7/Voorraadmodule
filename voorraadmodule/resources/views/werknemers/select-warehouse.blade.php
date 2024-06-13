@extends('layouts.master')

@section('content')

<div class="warehouse-form">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: black;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 style="color: black;">Selecteer een magazijn {{ $product->name }} {{$werknemer->name}}</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <input type="hidden" name="werknemer_id" value="{{ $werknemerId }}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <label for="serialnumber" style="color: black;">Select a warehouse: </label>
        <select name="serialnumber" id="serialnumber" style="color: black;">
            <option value=""> --kies een serienummer-- </option>


            @for($i = 0; $i < $productsinWarehouses->count(); $i++)

                <option value=""> --slider is working--</option>

                @php
                    $warehouse_ids = $productsinWarehouses->pluck('warehouse_id');

                    $warehouse = $validwarehouses->find($warehouse_ids[$i]);
                    $serialnumber = $productsinWarehouses->pluck('serial_number')[$i];
                @endphp

                <option value="{{ $serialnumber }}">
                    {{ $serialnumber }} - {{ $warehouse->name }}
                </option>
            @endfor
        </select>


        <button type="submit" style="color: black;">Verzend</button>
    </form>

    <a href="{{ route('products.select', ['werknemerId' => $werknemerId]) }}" style="color: black;">Ga terug naar
        producten</a>

</div>


@stop
