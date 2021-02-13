@extends('layouts.form')

@push('scripts')
  <script src="{{ asset('js/neighbour_form.js') }}" defer></script>
@endpush

@section('action'){{$action}}@endsection
@section('method'){{$method ?? 'POST'}}@endsection
@section('title'){{$title}}@endsection

@section('header_buttons')
<a href="{{route('neighbours.index')}}" class="btn btn-outline-success">
  <x-fa>caret-left</x-fa>
  Volver
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
        <x-form.input-text label="Dni" name="id_number" :value="$neighbour->id_number" />
      </div>
    </div>

    <div class="row" >
      <div class="col-6" >
        <x-form.input-text label="Teléfono" name="phone" :value="$neighbour->phone" />
      </div>
      <div class="col-6" >
        <x-form.input-text label="Fecha de Nac." name="birthdate" mode="date" :value="$neighbour->birthdate" />
      </div>
    </div>
    
    <div class="border-top mt-3 pt-3" >
      
      <x-form.select label="Barrio" name="hood_id" :collection="$hoods" :selected="$neighbour->hood_id" />

      <x-form.input-text label="Dirección" name="address" :value="$neighbour->address" />

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

    <h4>Agregar Nota</h4>


    <div class="form-group" >
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        @foreach($tags as $tag)
        <label class="btn btn-outline-{{$tag->color}}">
          <input type="radio" name="tag" value="{{$tag->id}}" {{$tag->id == $neighbour->tag_id ? 'checked' : ''}} > {{$tag->name}}
        </label>
        @endforeach
      </div>
    </div>


    
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
