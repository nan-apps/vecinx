<div class="form-group">
	<label for="{{$name}}">{{$label}}</label>
	<input 
		type="{{$mode ?? 'text'}}" 
		name="{{$name}}" id="{{$name}}" 
		class="form-control @error($name) is-invalid @enderror" 
		value="{{$value ?? ''}}"

		>
</div>
