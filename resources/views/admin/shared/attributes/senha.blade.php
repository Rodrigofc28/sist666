<div class="col-lg-{{ $size ?? "12" }} mt-2">
   
    <input hidden class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" autocomplete="off"
        type="password" value="{{ old('senha', $usuario->password) }}" {{$required ?? ''}} />
    @include('shared.error_feedback', ['name' => $name])
</div>