@extends('layouts.common')

@push('scripts')
<script src="{{ asset('js/map.js') }}"></script>
@endpush

@section('title')
Mapa general
@endsection


@section('body')

<div id="vecinxs-map" style="width: 100%; height: 500px;" >


</div>


<div id="map-vecinx-template" class="d-none" >
  <div class="content" >
    <x-fa>user</x-fa> %name% <br/>
    <x-fa>map-marker</x-fa> %address% <br/>
    <x-fa>phone</x-fa> %phone% <br/>
    <a href="%editPath%">
      <x-fa>edit</x-fa> Editar datos
    </a> 
  </div>
</div>



@endsection



