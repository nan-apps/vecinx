<div class="form-group" >
  @if($label)
  <label>{{$label}}</label><br />
  @endif
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
    @if(!empty($allButton))
    <label class="btn btn-sm btn-outline-dark">
      <input type="radio" class="{{$inputClasses ?? ''}}" name="{{$name}}" value="" {{!$selected ? 'checked' : ''}} /> {{$allButton}}
    </label>
    @endif
    @foreach($collection as $object)
    <label class="btn btn-{{$size ?? 'md'}} btn-outline-{{$object->color}} {{$object->id == $selected ? 'active' : ''}}">
      <input type="radio" class="{{$inputClasses ?? ''}}" name="{{$name}}" value="{{$object->id}}" {{$object->id == $selected ? 'checked' : ''}} > {{$object->name}}
    </label>
    @endforeach
  </div>
  @error($name) <x-fa color="danger" >exclamation-circle</x-fa> @enderror
</div>
