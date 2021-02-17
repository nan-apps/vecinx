@extends('layouts.common')

@section('title')
  Listado General de Notas
@endsection

@section('body')

  <form method="GET" action="{{route('notes.index')}}" >
    <div class="form-group" >
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-sm btn-outline-dark">
          <input type="radio" class="submit-on-click" name="tag_id" value="" {{!$tagId ? 'checked' : ''}} > Todas
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
<table class="table table-hover table-responsive-md">
  <thead>
    <tr>
      <th scope="col" style="width: 120px;"> Fecha</th>
      <th scope="col">Categoría</th>
      <th scope="col" style="width: 120px;"> Vecinx</th>
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
        {{$note->created_at->format('d/m/Y')}}<br/>
        <span class="text-muted small" >
          <x-fa>clock</x-fa>
          {{$note->created_at->format('H:i')}}
        </span>
      </td>
      <td>
        <span class="badge badge-{{$note->tag->color}}" >
          {{$note->tag->name}}
        </span>
      </td>
      <td>
        <a href="{{route('neighbours.edit', $note->neighbour)}}" >
          {{$note->neighbour->fullName()}}
        </a>
      </td>
      <td>{{$note->body}}</td>
      <td>
        <a href="{{route('neighbours.notes.edit', [$note->neighbour_id, $note->id])}}" class="btn btn-primary btn-sm btn-icon" title="Editar">
          <x-fa>edit</x-fa> Editar
        </a>
        {{-- <a href="{{route('neighbours.notes.create', [$note->neighbour_id])}}" class="btn btn-secondary btn-sm btn-icon" title="Agregarle nota a estx vecinx">
          <x-fa>plus</x-fa> Agregar
        </a>
        <a href="{{route('neighbours.notes.index', [$note->neighbour_id])}}" class="btn btn-warning btn-sm btn-icon" title="Agregarle nota a estx vecinx">
          <x-fa>list</x-fa> Ver sus notas
        </a> --}}
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
