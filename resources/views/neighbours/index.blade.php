@extends('layouts.common')

@section('title') Listado de Vecinxs @endsection

@section('header_buttons')
<a href="{{route('neighbours.create')}}" class="btn btn-primary">
  <x-fa>plus</x-fa>
  Agregar vecinx
</a>
@endsection

@section('body')
<table class="table table-hover table-responsive-md">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Barrio</th>
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
        {{$neighbour->fullName()}}
        <br />
        @if($neighbour->phone)
            <span class="text-muted" >
              <x-fa>phone</x-fa>
              {{$neighbour->phone}}
            </span>
        @endif
      </td>
      <td>{{$neighbour->hood ? $neighbour->hood->name : ''}}</td>
      <td>
        {{$neighbour->address}}<br/>
        <span class="text-muted small" >{{$neighbour->address_notes}}</span>
      </td>
      <td>
        @if($neighbour->enable)
        <span class="badge badge-success"><x-fa>check</x-fa> ACTIVO</span>
        @else
        <span class="badge badge-danger"><x-fa>times</x-fa> INACTIVO</span>
        @endif
      </td>
      <td>
        <a href="{{route('neighbours.edit', $neighbour)}}" class="btn btn-primary btn-sm">
          <x-fa>edit</x-fa>
          Editar
        </a>
        <a href="{{route('notes.index', ['neighbour_id' => $neighbour->id])}}" class="btn btn-secondary btn-sm">
          <x-fa>list</x-fa>
          Notas
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
