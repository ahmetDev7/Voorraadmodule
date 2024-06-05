@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>WERKNEMER AANPASSEN</h1>
    <form class="default-form" method="POST">
        @csrf
        <input type="hidden" name="id" value = {{$Employee->id}}>
        <label>Naam</label>
        <input type="text" name="name" value="{{ $Employee->name }}">
        @if ($errors->has('name'))
        <p style="color:#FF0000;">{{ $errors->first('name') }}</p>
        @endif
        <label>Email</label>
        <input type="text" name="email" value="{{ $Employee->email }}">
        @if ($errors->has('email'))
        <p style="color:#FF0000;">{{ $errors->first('email') }}</p>
        @endif
        <label>Functie</label>
        <textarea name="functie">{{ $Employee->functie }}</textarea>
        @if ($errors->has('functie'))
        <p style="color:#FF0000;">{{ $errors->first('functie') }}</p>
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
