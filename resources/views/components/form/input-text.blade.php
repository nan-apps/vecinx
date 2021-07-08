<div class="form-group">
	<label for="{{$name}}">{{$label}}</label>
	<input 
		type="{{$type()}}" 
		name="{{$name}}" id="{{$name}}" 
		class="form-control @error($name) is-invalid @enderror" 
		value="{{$value ?? ''}}"
		placeholder="{{$placeholder ?? ''}}" 
		>
	@if($helpText)
		<small class="form-text text-muted">{{$helpText}}</small>
	@endif
</div>
