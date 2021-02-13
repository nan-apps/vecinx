<div class="form-group">
	<label for="{{$name}}">{{$label}}</label>
	<select name="{{$name}}" id="{{$name}}" class="form-control @error($name) is-invalid @enderror" >
		<option value="" >Seleccione...</option>
		@foreach ($collection as $object)
			<option value="{{$object->id}}" {{ $selected == $object->id ? "selected" : "" }} >
				{{$object->name}}
			</option>
		@endforeach
	</select>
</div>
