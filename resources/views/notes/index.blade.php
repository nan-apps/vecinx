@extends('layouts.common')

@section('title') 
  Notas de {{$neighbour->fullName()}}<br/>
  <small class="text-muted" >
    <x-fa>home</x-fa> {{$neighbour->fullAddress()}}<br />
    <x-fa>phone</x-fa> {{$neighbour->phone ?? 'No registrado'}}
  </small>
@endsection

@section('header_buttons')
<a href="{{route('neighbours.notes.create', $neighbour->id)}}" class="btn btn-success">
  <x-fa>plus</x-fa>
  Agregar Nota
</a>
<a href="{{route('neighbours.edit', $neighbour->id)}}" class="btn btn-outline-secondary">
  <x-fa>caret-left</x-fa>
  Volver al vecinx
</a>
@endsection

@section('body')

<form method="GET" action="{{route('neighbours.notes.index', $neighbour->id)}}" >
  <div class="form-group" >
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
      <label class="btn btn-sm btn-outline-dark">
        <input type="radio" class="submit-on-click" name="tag_id" value="" {{!$tagId ? 'checked' : ''}} > Todos
      </label>
      @foreach($tags as $tag)
      <label class="btn btn-sm btn-outline-{{$tag->color}}">
        <input type="radio" class="submit-on-click" name="tag_id" value="{{$tag->id}}" {{$tag->id == $tagId ? 'checked' : ''}}> {{$tag->name}}
      </label>
      @endforeach
    </div>
  </div>
</form>

<hr />
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col" style="width: 120px;"> Fecha</th>
      <th scope="col">Categoría</th>
      <th scope="col">Nota</th>
      <th scope="col" style="width: 100px;">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if($notes->isEmpty())
      <tr>
        <td><i>Sin resultados</i></td>
      </tr>
    @endif
   @foreach ($notes as $note)
    <tr>
      <td>
        {{date('d/m/Y', strtotime($note->created_at))}}<br/>
        <span class="text-muted small" >
          <x-fa>clock</x-fa>
          {{date('H:i', strtotime($note->created_at))}}
        </span>
      </td>
      <td>
        <span class="badge badge-{{$note->tag->color}}" >
          {{$note->tag->name}}
        </span>
      </td>
      <td>{{$note->body}}</td>
      <td>
        <a href="{{route('neighbours.notes.edit', [$note->neighbour_id, $note->id])}}" class="btn btn-success btn-sm btn-icon" title="Editar">
          <x-fa>edit</x-fa>
        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection

@section('footer')
<i>
  {{count($notes)}} notas
</i>
@endsection
