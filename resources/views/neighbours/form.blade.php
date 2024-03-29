@extends('layouts.form')

@push('scripts')
<script src="{{ asset('js/neighbour_form.js') }}"></script>
@endpush

@section('action'){{$action}}@endsection
@section('method'){{$method ?? 'POST'}}@endsection
@section('title'){{$title}}@endsection

@section('header_buttons')

@if($neighbour->exists)
<a href="{{route('notes.index', ['neighbour_id' => $neighbour->id])}}" class="btn btn-primary">
  <x-fa>list</x-fa> Administrar sus notas
</a>
@endif

@if($neighbour->exists)
<x-form.delete-button :route="route('neighbours.destroy', [$neighbour])" />
@endif

@endsection


@section('body')

<div class="row" >

  <div class="col-md-8 border-right" >

    <div class="row" >
      <div class="col-md-6" >
        <x-form.input-text label="Nombre" name="name" :value="$neighbour->name" />
      </div>
      <div class="col-md-6" >
        <x-form.input-text label="Apellido" name="last_name" :value="$neighbour->last_name" />
      </div>
    </div>

    <div class="row" >
      <div class="col-md-6" >
        <x-form.input-text label="Dni" name="id_number" :value="$neighbour->id_number" />
      </div>
      <div class="col-md-6" >
        <x-form.input-text label="Teléfono" name="phone" :value="$neighbour->phone" />
      </div>
    </div>

    <div class="row" >
      <div class="col-md-6" >
        <x-form.input-text 
        label="Fecha de Nac." 
        name="birthdate" 
        mode="date" 
        :value="$neighbour->birthdate"
        placeholder="dd/mm/yyyy" />
      </div>
    </div>
    
    <div class="form-group border-top mt-3 pt-3" >

      <x-form.select label="Parada" 
      name="address_id" 
      :collection="$addresses" 
      :selected="$neighbour->address_id" 
      :getNameFunc="function($a){return $a->full_name;}" />

      <a href="{{route('addresses.create')}}" class="btn btn-outline-success new-address">
        <x-fa>plus</x-fa> Nueva parada
      </a>

      
      <a href="{{$neighbour->address ? route('addresses.edit', $neighbour->address) : '#'}}" 
        class="btn btn-outline-secondary edit-address @unless($neighbour->address) d-none @endunless" 
      >
        <x-fa>edit</x-fa> Editar parada
      </a>

    </div>

    <div class="row" >
      <div class="col-md-12" >
        <x-form.input-text label="Notas sobre la dirección" name="address_notes" :value="$neighbour->address_notes" />
      </div>
    </div>

  </div>

  <div class="col-md-4" >


    @if($neighbour->exists)
      {{-- <h4>Agregar Nota</h4>

      <div class="form-group" >
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          @foreach($tags as $tag)
          <label class="btn btn-outline-{{$tag->color}}">
            <input type="radio" name="tag[id]" value="{{$tag->id}}" {{$tag->id == $neighbour->tag_id ? 'checked' : ''}} > {{$tag->name}}
          </label>
          @endforeach
        </div>
      </div>

      <div class="form-group" >
        <textarea class="form-control" name="note[body]" ></textarea>
      </div>

      <button href="{{route('neighbours.notes.store', $neighbour->id)}}" class="btn btn-outline-primary btn-block">
        <x-fa>check</x-fa>
        Guardar nota
      </button>

      <hr /> --}}

      <h4 class="" >
        Últimas Notas
      </h4>

      @forelse($notes as $note)
      <p>
        <badge class="badge badge-{{$note->tag->color}}" >
          {{$note->tag->name}}
        </badge>
        <span class="text-muted" >{{$note->created_at->format("d/m/Y H:i")}}</span>
        <br />
        {{Illuminate\Support\Str::of($note->body)->substr(0, 100)}}...
      </p>
      @empty
      <x-fa>info-circle</x-fa>
      <i>Aun no hay notas cargadas</i>
      @endforelse

      @endif


    </div>
  </div>

  @endsection

  @section('footer')
  <button type="submit" class="btn btn-primary">
    Guardar
  </button>

  <a href="{{url()->previous()}}" class="btn btn-link">
    Cancelar
  </a>
  @endsection
