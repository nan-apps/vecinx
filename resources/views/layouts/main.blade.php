@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">

      @if (session('status'))
        <div class="alert alert-success mt-3">
          {{ session('status') }}
        </div>
      @endif
      
      <div class="card">
        <div class="card-header">
          <h3 class="float-left" >
            @yield('title')
          </h3>
          <div class="float-right" >
            @yield('header_buttons')
          </div>
        </div>
      </div>

      @yield('subcontent')

    </div>
  </div>
</div>
@endsection
