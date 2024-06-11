@extends('layouts.master')

@section('content')

<div class="producten-pagina">
  <h1>Producten</h1>

  <a href="/producten/toevoegen" class="add-button">
    <p>Product toevoegen</p>
  </a>
  <div style="margin-bottom: 20px;"></div>
  <a href="/archief" class="add-button">
    <p>Archief/prullenbak</p>
  </a>

  <!-- Adding a bit of space -->
  <div style="margin-bottom: 20px;"></div>


  <div class="bg-white pb-4 px-4 rounded-md w-full" style="width:1000px; margin-left:auto; margin-right:auto; margin-top:50px;">
    <div class="w-full flex justify-end px-2 mt-2">
      <div class="w-full sm:w-64 inline-block relative ">
        <form action="{{ route('products.search') }}" method="GET">
          <input type="search" name="search" value="{{ request('search') }}" class="leading-snug border border-gray-300 block w-full appearance-none bg-gray-100 text-sm text-gray-600 py-1 px-4 pl-8 rounded-lg" placeholder="Zoeken" />
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
            <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Productnummer</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Naam</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Beschrijving</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Categorie</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Hoeveelheid</th>
            <th class="px-4 py-2 " style="background-color:#f8f8f8">Acties</th>
          </tr>
        </thead>
        <tbody class="text-sm font-normal text-gray-700">
          @forelse($products as $p)
          <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
            <td class="px-4 py-4">{{$p->productnummer}}</td>
            <td class="px-4 py-4">{{$p->name}}</td>
            <td class="px-4 py-4">{{$p->description}}</td>
            <td class="px-4 py-4">{{$p->category}}</td>
            <td class="px-4 py-4">{{$p->serial_number_count}}</td>
            <td class="px-4 py-4">
              <a href="{{ route('products.edit', $p->id) }}" class="small-button">
                <img id="logo" src="{{url('/images/edit-icon.png')}}">
              </a>
              <a href="{{ route('products.archive', $p->id) }}" class="small-button" onclick="confirmationArchive(event)">
                <img id="logo" src="{{url('/images/Archive-Button.png')}}">
              </a>
              <a href="{{ route('itemquantityinwarehouses.showAssignForm', $p->id) }}" class="small-button">
                <img id="logo" src="{{url('/images/warehouse2.png')}}">
              </a>
              <a href="{{ route('products.show', $p->id) }}" class="small-button-2">
                <img id="logo" src="{{url('/images/info-icon.png')}}">
              </a>


            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="px-4 py-4 list-group-item-danger">geen producten.</td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
  function confirmationArchive(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');
    console.log(urlToRedirect);
    swal({
        title: "Weet u zeker dat u dit product wilt archiveren?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willCancel) => {
        if (willCancel) {



          window.location.href = urlToRedirect;

        }


      });


  }
</script>


@stop