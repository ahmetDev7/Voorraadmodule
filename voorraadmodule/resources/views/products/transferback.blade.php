@extends('layouts.master')

@section('content')

<form action="" method="POST">
    @csrf

    <label for="warehouse">Choose a Warehouse:</label>
    <select name="warehouse_id" id="warehouse">
        @foreach($warehouses as $warehouse)
            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
        @endforeach
    </select>

    <label for="quantity">Enter Quantity:</label>
    <input type="number" name="quantity" id="quantity" min="1" required>

    <!-- Include other form fields as needed -->

    <input type="submit" value="Transfer Product">
</form>

@endsection