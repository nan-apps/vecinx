@extends('layouts.form')

@section('action'){{route('members.store')}}@endsection
@section('title') Alta de voluntarix @endsection
@section('header_buttons')
<a href="{{route('members.index')}}" class="btn btn-outline-success">
  <x-fa>caret-left</x-fa>
  Volver
</a>
@endsection
@section('body')

  <div class="row" >

    <div class="col-md-8 border-right" >

      <x-form.input-text label="Nombre" name="name" :value="$member->name" />
      <x-form.input-text label="Email" name="email" :value="$member->email" />
      <x-form.input-text label="Teléfono" name="phone" :value="$member->phone" />
      <x-form.input-text label="Dirección" name="address" :value="$member->address" />

    </div>

    <div class="col-md-4" >
      <h4>Opciones</h4>
      <div class="form-group" >
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          @foreach($roles as $role)
          <label class="btn btn-outline-secondary">
            <input type="radio" name="role" value="{{$role->id}}" {{$role->id == $member->role_id ? 'checked' : ''}} > {{$role->name}}
          </label>
          @endforeach
        </div>
      </div>

      <div class="form-group" >
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="enable" value="1" id="enable" {{$member->enable ? 'checked' : ''}}>
          <label class="custom-control-label" for="enable">¿Activo?</label>
        </div>
      </div>
  </div>
</div>

@endsection

@section('footer')
<button type="submit" class="btn btn-primary">
  Guardar
</button>
@endsection
