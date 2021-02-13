@extends('layouts.main')

@section('subcontent')

<form method="POST" action="@yield('action')" >
  @csrf
  <input type="hidden" name="_method" value="@yield('method', 'POST')">

  @if ($errors->any())
  <div class="alert alert-danger mt-3">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  
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

</form>


@endsection
