@if($errors->has($name))
    <span class="orange-text text-darken-3">{{ $errors->first($name) }}</span>
@endif
