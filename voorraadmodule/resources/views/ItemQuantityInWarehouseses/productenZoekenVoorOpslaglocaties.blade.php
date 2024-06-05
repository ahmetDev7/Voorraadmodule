@extends('layouts.master')

@section('content')
<div class="producten-pagina">
<h1 style="text-align: center;">Zoek welke opslaglocaties de gezochte product hebben</h1>

  <!-- Adding a bit of space -->
  <div style="margin-bottom: 20px;"></div>


  <div class="bg-white pb-4 px-4 rounded-md w-full" style="width:1000px; margin-left:auto; margin-right:auto; margin-top:50px;">
    <div class="w-full flex justify-end px-2 mt-2">
      <div class="w-full sm:w-64 inline-block relative ">
      <form>
        <input type="search" value="{{ request('search') }}" name="search" class="leading-snug border border-gray-300 block w-full appearance-none bg-gray-100 text-sm text-gray-600 py-1 px-4 pl-8 rounded-lg" placeholder="Zoek welke opslaglocaties de gezochte product hebben" />
        </form>
        <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-300">

          <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999">
            <path d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z" />
          </svg>
        </div>
      </div>
    </div>
    <div class="overflow-x-auto mt-6">

      <table class="table-auto border-collapse w-full">
        <thead>
          <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Naam</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Straat</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Huisnummer</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Postcode</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Stad</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Land</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Product ID</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Hoeveelheid</th>

          </tr>
        </thead>
        <tbody class="text-sm font-normal text-gray-700">
        @forelse($warehouses as $w)
            <tr>
                <td class="px-4 py-4">{{$w->name}}</td>
                <td class="px-4 py-4">{{$w->street}}</td>
                <td class="px-4 py-4">{{$w->housenumber}}</td>
                <td class="px-4 py-4">{{$w->zipcode}}</td>
                <td class="px-4 py-4">{{$w->city}}</td>
                <td class="px-4 py-4">{{$w->country}}</td>
                <td class="px-4 py-4">{{$w->product_id}}</td>
                <td class="px-4 py-4">{{$w->quantity}}</td>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="px-4 py-4 list-group-item-danger">Product niet in een opslag.</td>
            </tr>
        @endforelse
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