@if($errors->count())
    <div class="row">
        <div class="col s12 form-error-container">
            <div class="font-weight-bold">Please correct following errors to proceed</div>
            <ul>
                @foreach($errors->all() as $er)
                    <li>{{ $er }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
