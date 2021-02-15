@extends('layouts.form')

@push('scripts')
  <script src="{{ asset('js/neighbour_form.js') }}" defer></script>
@endpush

@section('action'){{$action}}@endsection
@section('method'){{$method ?? 'POST'}}@endsection
@section('title'){{$title}}@endsection

@section('header_buttons')
<a href="{{route('neighbours.index')}}" class="btn btn-outline-secondary">
  <x-fa>caret-left</x-fa>
  Volver al listado
</a>
@endsection
@section('body')

<div class="row" >

  <div class="col-md-8 border-right" >

    <div class="row" >
      <div class="col-6" >
        <x-form.input-text label="Nombre" name="name" :value="$neighbour->name" />
      </div>
      <div class="col-6" >
        <x-form.input-text label="Apellido" name="last_name" :value="$neighbour->last_name" />
      </div>
    </div>

    <div class="row" >
      <div class="col-6" >
        <x-form.input-text label="Dni" name="id_number" :value="$neighbour->id_number" />
      </div>
      <div class="col-6" >
        <x-form.input-text label="Teléfono" name="phone" :value="$neighbour->phone" />
      </div>
    </div>

    <div class="row" >
      <div class="col-6" >
        <x-form.input-text 
        label="Fecha de Nac." 
        name="birthdate" 
        mode="date" 
        :value="$neighbour->birthdate"
        placeholder="dd/mm/yyyy" />
      </div>
    </div>
    
    <div class="border-top mt-3 pt-3" >
      
      <x-form.input-text label="Dirección" name="address" :value="$neighbour->address" />

      <x-form.select label="Barrio" name="hood_id" :collection="$hoods" :selected="$neighbour->hood_id" />

      <div class="row" >
        <div class="col-6" >
          <x-form.input-text label="Latitud" name="lat" :value="$neighbour->lat" />
        </div>
        <div class="col-6" >
          <x-form.input-text label="Longitud" name="lng" :value="$neighbour->lng" />
        </div>
      </div>
      <x-form.input-text label="Notas sobre la dirección" name="address_notes" :value="$neighbour->address_notes" />
    </div>

    <div id="locationPicker" style="width: 100%; height: 300px;"></div>

  </div>

  <div class="col-md-4" >
    <h4>Opciones</h4>
    <x-form.check-box label="¿Activo?" name="enable" :checked="$neighbour->enable" />
    <hr />

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

      <h4>Últimas Notas</h4>

      @forelse($notes as $note)
        <p>
          <span class="text-muted" >{{$note->created_at}}</span>
          <badge class="badge badge-{{$note->tag->color}}" >
            {{$note->tag->name}}
          </badge>
          <br />
          {{Illuminate\Support\Str::of($note->body)->substr(0, 100)}}...
        </p>
      @empty
      <x-fa>info-circle</x-fa>
      <i>Aun no hay notas cargadas</i>
      @endforelse

      <hr/>
      <div class="row" >
        <div class="col" >
          <a href="{{route('neighbours.notes.create', $neighbour->id)}}" class="btn btn-outline-primary btn-block">
            <x-fa>plus</x-fa> Agregar Nota
          </a>
        </div>


        @if($notes->isNotEmpty())
          <div class="col" >
            <a href="{{route('neighbours.notes.index', $neighbour->id)}}" class="btn btn-outline-secondary btn-block">
              <x-fa>list</x-fa> Ver todas
            </a>
          </div>
        @endif

      </div>
    @endif

    
  </div>
</div>

@endsection

@section('footer')
<button type="submit" class="btn btn-primary">
  Guardar
</button>

<a href="{{route('neighbours.index')}}" class="btn btn-link">
  Cancelar
</a>
@endsection
