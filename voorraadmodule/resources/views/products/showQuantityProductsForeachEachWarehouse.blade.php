@extends('layouts.master')

@section('content')
<div class="producten-pagina">
    <h1>{{$product->productnummer}} </h1>
    <div class="bg-white pb-4 px-4 rounded-md w-full" style="width:1000px; margin-left:auto; margin-right:auto; margin-top:50px;">
        <div class="overflow-x-auto mt-6">
            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                        <th class="px-4 py-2 bg-gray-200" style="background-color:#f8f8f8">Serienummer</th>
                        <th class="px-4 py-2" style="background-color:#f8f8f8">Opslag</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-normal text-gray-700">
                    @foreach($serialNumbers as $s)
                    <tr>
                        <td class="border px-4 py-2">{{ $s->serialnumber }}</td>
                        <td class="border px-4 py-2">{{ $s->warehouse->name ?? 'Zit niet in opslag' }}</td> 

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection