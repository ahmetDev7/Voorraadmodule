@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>Product toevoegen aan opslaglocatie</h1>
    <form class="default-form" action="{{ route('itemquantityinwarehouses.assignProductToWarehouse', ['id' => $product->id]) }}" method="post">
        @csrf

        <label>Productnummer</label>
        <input type="text" name="id" value="{{ $product->productnummer }}" readonly>
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <label>Opslaglocatie ID</label>
        <select style="color: black;" name="warehouse_id">
            @foreach($warehouses as $warehouse)
            <option style="color: black;" value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
            @if ($errors->has('warehouse_id'))
            <p style="color:#FF0000;">{{ $errors->first('warehouse_id') }}</p>
            @endif
        </select>
        <div>
            <label><input type="checkbox" id="select-all"> Selecteer alles</label>
        </div>
        <br>
        <div>
            @foreach($serialNumbers as $serialNumber)
            <div>
                <input type="checkbox" name="serial_numbers[]" value="{{ $serialNumber->serialnumber }}">
                <label>{{ $serialNumber->serialnumber }}</label>
            </div>
            @endforeach
        </div>

        <input class="submit" type="submit" value="Toevoegen" />
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-error">
            {{ session()->get('error') }}
        </div>
        @endif
    </form>
</div>
@stop
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#select-all').click(function() {
            $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
        });
    });
</script>