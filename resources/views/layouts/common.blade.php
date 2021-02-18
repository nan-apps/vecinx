@extends('layouts.main')

@section('subcontent')

<div class="card mt-3">
  <div class="card-body">
    @yield('body')
  </div>
</div>

@if(Illuminate\Support\Facades\View::hasSection('footer'))
<div class="card mt-3">
  <div class="card-body">
    @yield('footer')
  </div>
</div>
@endif

@endsection
