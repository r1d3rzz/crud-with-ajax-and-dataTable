@props(['name','type'=>'text','value'=>'','option'=>false])

<div class="mb-3">
    <label for="{{$name}}">{{ucfirst($name)}}{{$option ? " (option)" : ""}}</label>
    <input type="{{$type}}" name="{{$name}}" value="{{old($name,$value)}}" id="{{$name}}" class="form-control">
    @error($name)
    <small class="text-danger">
        {{$message}}
    </small>
    @enderror
</div>