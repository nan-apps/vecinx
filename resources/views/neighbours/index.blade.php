@extends('layouts.common')


@section('title') 
  Listado de Vecinxs 
  @if($withDeleted)
    borradxs
  @endif

@endsection

@section('header_buttons')

@if($withDeleted)
  <a href="{{route('neighbours.index')}}" class="btn btn-success">
    <x-fa>check</x-fa>
    Ver no borradxs
  </a>
@else
  <a href="{{route('neighbours.create')}}" class="btn btn-primary">
    <x-fa>plus</x-fa>
    Agregar vecinx
  </a>
  <a href="{{route('neighbours.index', ['with_deleted' => true])}}" class="btn btn-danger">
    <x-fa>trash</x-fa>
    Ver borradxs
  </a>
@endif

@endsection

@section('body')

  <form method="GET" action="{{route('neighbours.index')}}" class="" >
    <div class="row" >
      <div class="col-md-6" >

        <input name="with_deleted" value="{{$withDeleted}}" type="hidden" />

        <x-form.buttons-switch
          label="Recorrido" 
          name="route_id" 
          :collection="$routes" 
          :selected="$routeId"
          size="sm"
          all-button="Todos"
          input-classes="submit-on-click"
        />
        
      </div>
      
    </div>
  </form>

<table class="table table-hover table-responsive-md">
  <thead>
    <tr>
      <th scope="col">Recorrido</th>
      <th scope="col">Nombre</th>
      <th scope="col">Barrio</th>
      <th scope="col">Dirección</th>
      <th scope="col" style="width: 180px;">Acciones</th>
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
        <span class="badge badge-{{$neighbour->route->color}}" >
          {{$neighbour->route->name}}
        </span>
      </td>
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
        @if($withDeleted)
          <a href="{{route('neighbours.restore', $neighbour->id)}}" class="btn btn-sm btn-light">
            <x-fa>undo</x-fa> Reestablecer
          </a>
        @else
          <a href="{{route('neighbours.edit', $neighbour)}}" class="btn btn-primary btn-sm">
            <x-fa>edit</x-fa>
            Editar
          </a>
          <a href="{{route('notes.index', ['neighbour_id' => $neighbour->id])}}" class="btn btn-secondary btn-sm">
            <x-fa>list</x-fa>
            Notas
          </a>
        @endif
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
