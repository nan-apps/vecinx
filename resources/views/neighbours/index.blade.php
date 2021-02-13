@extends('layouts.common')

@section('title') Vecinxs @endsection

@section('header_buttons')
<a href="{{route('neighbours.create')}}" class="btn btn-success">
  <x-fa>plus</x-fa>
  Agregar
</a>
@endsection

@section('body')
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Dirección</th>
      <th scope="col">Estado</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if($neighbours->isEmpty())
      <tr>
        <td><i>Sin resultados</i></td>
      </tr>
    @endif
   @foreach ($neighbours as $neighbour)
    <tr>
      <td>
        {{$neighbour->name}}
        <br />
        @if($neighbour->phone)
            <span class="text-muted" >
              <x-fa>phone</x-fa>
              {{$neighbour->phone}}
            </span>
        @endif
      </td>
      <td>{{$neighbour->address}}</td>
      <td>
        @if($neighbour->enable)
        <span class="badge badge-primary"><x-fa>check</x-fa> ACTIVO</span>
        @else
        <span class="badge badge-danger"><x-fa>times</x-fa> INACTIVO</span>
        @endif
      </td>
      <td>
        <a href="{{route('neighbours.edit', ['neighbour' => $neighbour])}}" class="btn btn-success btn-sm">
          <x-fa>edit</x-fa>
          Editar
        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection

@section('footer')
<i>
  {{count($neighbours)}} vecinxs
</i>
@endsection
