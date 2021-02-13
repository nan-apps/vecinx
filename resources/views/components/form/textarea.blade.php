<div class="form-group">
    <label for="{{$name}}">{{$label}}</label>
    <textarea 
        class="form-control @error($name) is-invalid @enderror" 
        id="{{$name}}" 
        name="{{$name}}" 
        style="height: 200px" >{{$slot}}</textarea> 
</div>
