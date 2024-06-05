@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>Werknemer toevoegen</h1>
    <form class="default-form" action="{{ route('werknemers.toevoegen') }}" method="post">
        @csrf
        <label>Naam</label>
        <input type="text" name="name" value="">
        @if ($errors->has('name'))
        <p style="color:#FF0000;">{{ $errors->first('name') }}</p>
        @endif
        <label>Email</label>
        <textarea type="text" name="email" value=""></textarea>
        @if ($errors->has('email'))
        <p style="color:#FF0000;">{{ $errors->first('description') }}</p>
        @endif
        <label>Functie</label>
        <input type="text" name="functie" value="">
        @if ($errors->has('functie'))
        <p style="color:#FF0000;">{{ $errors->first('category') }}</p>
        @endif
        <input class="submit" type="submit" value="Toevoegen" />
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </form>
</div>
@stop
