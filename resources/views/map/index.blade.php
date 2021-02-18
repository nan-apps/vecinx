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



@endsection



