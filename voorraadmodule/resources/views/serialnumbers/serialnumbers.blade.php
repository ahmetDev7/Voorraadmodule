@extends('layouts.master')

@section('content')
<div class="serienummers-pagina">
  <h1>Serienummers</h1> 
  <a href="/serienummers/toevoegen" class="add-button">
    <p>Serienummer toevoegen</p>
  </a> 
  <!-- Adding a bit of space -->
  <div style="margin-bottom: 20px;"></div>
  <div class="bg-white pb-4 px-4 rounded-md w-full" style="width:1000px; margin-left:auto; margin-right:auto; margin-top:50px;">
    <div class="overflow-x-auto mt-6">
      <table class="table-auto border-collapse w-full">
        <thead>
          <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
            <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Serienummer</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Productnaam</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Beschrijving</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Categorie</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Opslag</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Acties</th>
          </tr>
        </thead>
        <tbody class="text-sm font-normal text-gray-700"> 
          @forelse($serienummers as $s) 
          <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
            <td class="px-4 py-4">{{$s->serialnumber}}</td>
            <td class="px-4 py-4">{{$s->product->name}}</td>
            <td class="px-4 py-4">{{$s->product->description}}</td>
            <td class="px-4 py-4">{{$s->product->category}}</td>
            <td class="px-4 py-4">{{ $s->warehouse ? $s->warehouse->name : 'Zit niet in opslag' }}</td>
            <td class="px-4 py-4"> 
              <a href="{{ route('serialnumbers.delete', $s->id) }}" class="small-button"> 
                <img id="logo" src="{{url('/images/Archive-Button.png')}}"> 
              </a> 
            </td>
          </tr> 
          @empty 
          <tr>
            <td colspan="8" class="px-4 py-4 list-group-item-danger">Er zijn geen serienummers aanwezig.</td>
          </tr> 
          @endforelse 
        </tbody>
      </table>
    </div>
  </div>
  <style>
    thead tr th:first-child {
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
    }

    thead tr th:last-child {
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
    }

    tbody tr td:first-child {
      border-top-left-radius: 5px;
      border-bottom-left-radius: 0px;
    }

    tbody tr td:last-child {
      border-top-right-radius: 5px;
      border-bottom-right-radius: 0px;
    }
  </style>
</div> 
@stop
