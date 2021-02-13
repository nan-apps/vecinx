@extends('layouts.main')

@section('subcontent')

<div class="card mt-3">
  <div class="card-body">
    @yield('body')
  </div>
</div>

<div class="card mt-3">
  <div class="card-body">
    @yield('footer')
  </div>
</div>



@endsection
