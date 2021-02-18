@extends('layouts.form')

@section('action'){{$action}}@endsection
@section('method'){{$method ?? 'POST'}}@endsection
@section('title')
  {{$title}}
  <br />
  <small class="text-muted" >
    <x-fa>home</x-fa> {{$neighbour->fullAddress()}}<br />
    <x-fa>phone</x-fa> {{$neighbour->phone ?? 'No registrado'}}
  </small>
@endsection

@section('header_buttons')
<a href="{{url()->previous()}}" class="btn btn-link">
  <x-fa>caret-left</x-fa>
  Volver
</a>

@if($note->exists)
  <x-form.delete-button :route="route('neighbours.notes.destroy', [$note->neighbour_id, $note->id])" />
@endif

@endsection
@section('body')

<div class="row" >

  <div class="col-md-8 border-right" >

    <div class="form-group" >
      <label class="" >Categoría</label><br />
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        @foreach($tags as $tag)
        <label class="btn btn-outline-{{$tag->color}}">
          <input type="radio" name="tag_id" value="{{$tag->id}}" {{$tag->id == $note->tag_id ? 'checked' : ''}} > {{$tag->name}}
        </label>
        @endforeach
      </div>
        @error('tag_id') <x-fa color="danger" >exclamation-circle</x-fa> @enderror
    </div>

    <div class="form-group">
      <x-form.textarea label="Nota" name="body" >{{$note->body}}</x-form.textarea>
    </div>

  </div>

  <div class="col-md-4" >
    
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
