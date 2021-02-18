<div class="form-group">
	@if($label)
		<label for="{{$name}}">{{$label}}</label>
	@endif
	<select data-live-search="true" name="{{$name}}" id="{{$name}}" class="selectpicker form-control @error($name) is-invalid @enderror {{$cssClasses ?? ''}}" >
		<option value="" >{{$placeholder ?? 'Seleccione...'}}</option>
		@foreach ($collection as $object)
			<option value="{{$object->id}}" {{ $selected == $object->id ? "selected" : "" }} >
				{{$getNameFunc ? $getNameFunc($object) : $object->name}}
			</option>
		@endforeach
	</select>
</div>
