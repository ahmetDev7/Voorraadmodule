@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>PRODUCT ARCHIVEREN</h1>
    <form class="default-form" action="{{ route('products.archive') }}" method="post">
        @csrf
        <label>serienummer</label>
        <input type="text" name="serialnumber" value="">
        
        <input class="submit" type="submit" value="Archiveren"/>
    </form>
</div>
@stop
