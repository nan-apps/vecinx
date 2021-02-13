@php
$id = $name . ($value ? "_{$value}" : '');
@endphp
<div class="form-group" >
	<div class="custom-control custom-checkbox">
		<input type="checkbox" 
		class="custom-control-input" 
		name="{{$name}}" 
		value="{{$value ?? '1'}}" 
		id="{{$id}}" 
		{{$checked() ? 'checked' : ''}}
		>
		<label class="custom-control-label" for="{{$id}}">{{$label}}</label>
	</div>
</div>
