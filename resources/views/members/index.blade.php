@extends('layouts.common')

@section('title') Voluntarixs @endsection

@section('header_buttons')
{{-- <a href="{{route('members.create')}}" class="btn btn-success">
  <x-fa>plus</x-fa>
  Nuevx
</a> --}}
@endsection

@section('body')
<i>En construcción</i>
{{-- <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Rol</th>
      <th scope="col">Estado</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($members as $member)
    <tr>
      <td>
        {{$member->name}}
        <br />
        <span class="text-muted" >
          <x-fa>phone</x-fa>
          {{$member->phone}}
        </span>
      </td>
      <td>{{$member->role->name}}</td>
      <td>
        @if($member->enable)
        <span class="badge badge-primary"><x-fa>check</x-fa> ACTIVO</span>
        @else
        <span class="badge badge-danger"><x-fa>times</x-fa> INACTIVO</span>
        @endif
      </td>
      <td>
        <button type="button" class="btn btn-link btn-sm">
          <x-fa>edit</x-fa>
          Editar
        </button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table> --}}
@endsection

@section('footer')
{{-- <i>
  {{count($members)}} voluntarixs
</i> --}}
@endsection
