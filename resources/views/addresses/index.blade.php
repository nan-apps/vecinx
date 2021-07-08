@extends('layouts.common')

@push('scripts')
<script src="{{ asset('js/addresses_list.js') }}"></script>
<script>
  ADDRESSES_SUCCESS_PATH = "{{route('addresses.success')}}";
</script>
@endpush


@section('title') 
  Listado de paradas
@endsection

@section('header_buttons')

{{-- @if($withDeleted)
  <a href="{{route('addresses.index')}}" class="btn btn-success">
    <x-fa>check</x-fa>
    Ver no borradxs
  </a>
@else
  <a href="{{route('addresses.create')}}" class="btn btn-primary">
    <x-fa>plus</x-fa>
    Agregar vecinx
  </a>
  <a href="{{route('addresses.index', ['with_deleted' => true])}}" class="btn btn-danger">
    <x-fa>trash</x-fa>
    Ver borradxs
  </a>
@endif --}}

  <a href="{{route('addresses.create')}}" class="btn btn-primary new-address">
    <x-fa>plus</x-fa>
    Agregar parada
  </a>

@endsection

@section('body')

  <form method="GET" action="{{route('addresses.index')}}" class="" >
    <div class="row" >
      <div class="col-md-6" >

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
      <th scope="col">Orden</th>
      <th scope="col">Nombre</th>
      <th scope="col">Dirección</th>
      <th scope="col">Barrio</th>
      <th scope="col">Notas</th>
      <th scope="col" style="width: 180px;">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if($addresses->isEmpty())
      <tr>
        <td><i>Sin resultados</i></td>
      </tr>
    @endif
   @foreach ($addresses as $address)
    <tr>
      <td>
        <span class="badge badge-{{$address->route->color}}" >
          {{$address->route->name}}
        </span>
      </td>
      <td>
        <div class="btn-group" >
          <a href="{{route('addresses.moveUp', $address)}}" class="btn btn-sm btn-outline-secondary">
            <x-fa>caret-up</x-fa>
          </a>
          <button type="button" class="btn btn-sm btn-{{$address->route->color}} disabled">
            {{$address->order_column}}
          </button>
          <a href="{{route('addresses.moveDown', $address)}}" class="btn btn-sm btn-outline-secondary">
            <x-fa>caret-down</x-fa>
          </a>
        </div>

      </td>
      <td>{{$address->name}}</td>
      <td>{{$address->address}}</td>
      <td>{{$address->hood->name}}</td>
      <td>
        <span class="text-muted small" >{{$address->address_notes}}</span>
      </td>
      <td>
        <a href="{{route('addresses.edit', $address)}}" class="btn btn-primary btn-sm edit-address">
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
  {{count($addresses)}} paradas
</i>
@endsection


