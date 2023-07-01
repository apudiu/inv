@extends('layouts.main')

@section('title')
    Add Client
@endsection

@section('content')

<div class="section">
    <div class="row">
        <div class="col s12 m12">
            <div class="card white darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline blue-grey-text">Add Client</div>
                    </div>

                    <div class="pb-2">

                        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12 m8">
                                    <label for="name">Name
                                        <span class="red-text">*</span>
                                    </label>
                                    <input class="validate"
                                           type="text"
                                           placeholder="Company Name"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required>
                                    @component('components.form-error', ['name'=>'name'])
                                    @endcomponent
                                </div>
                                <div class="input-field col s12 m4">
                                    <label for="city">City
                                        <span class="red-text">*</span>
                                    </label>
                                    <input class="validate"
                                           type="text"
                                           placeholder="City Name"
                                           id="city"
                                           name="city"
                                           value="{{ old('city') }}"
                                           required>
                                    @component('components.form-error', ['name'=>'city'])
                                    @endcomponent
                                </div>
                                <div class="input-field col s12">
                                    <label for="address">Address
                                        <span class="red-text">*</span>
                                    </label>
                                    <textarea class="materialize-textarea"
                                              placeholder="Address"
                                              id="address"
                                              name="address"
                                              required>{{ old('address') }}</textarea>
                                    @component('components.form-error', ['name'=>'address'])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <label for="zip">Zip Code
                                        <span class="red-text">*</span>
                                    </label>
                                    <input class="validate"
                                           type="text"
                                           placeholder="Zip Code"
                                           id="zip"
                                           name="zip"
                                           value="{{ old('zip') }}"
                                           required>
                                    @component('components.form-error', ['name'=>'zip'])
                                    @endcomponent
                                </div>
                                <div class="input-field col s12 m6">
                                    <label for="tax">Tax ID</label>
                                    <input class="validate"
                                           type="text"
                                           placeholder="Tax ID"
                                           id="tax"
                                           name="tax"
                                           value="{{ old('tax') }}">
                                    @component('components.form-error', ['name'=>'tax'])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="note">Note</label>
                                    <textarea class="materialize-textarea"
                                              placeholder="Optional Note"
                                              id="note"
                                              name="note">{{ old('note') }}</textarea>
                                    @component('components.form-error', ['name'=>'note'])
                                    @endcomponent
                                </div>
                                <div class="file-field input-field col s12">
                                    <div class="pb-2">
                                        <label for="img">Company Logo
                                            <span class="orange-text">The image shouldn't exceed 300px in any dimension</span>
                                        </label>
                                    </div>
                                    <div class="btn btn-small blue-grey">
                                        <span>Logo</span>
                                        <input type="file"
                                               id="img"
                                               name="img"
                                               accept=".jpg,.png">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input placeholder="Choose company Logo" id="img" class="file-path validate" type="text">
                                    </div>
                                    @component('components.form-error', ['name'=>'img'])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 center">
                                    <button type="reset" class="btn waves-effect white darken-2 black-text text-lighten-2">Reset</button>
                                    <button type="submit" class="btn waves-effect light-blue darken-2">Add</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
