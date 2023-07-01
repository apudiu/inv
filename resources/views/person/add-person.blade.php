@extends('layouts.main')

@section('title')
    Add Contact
@endsection

@section('content')

<div class="section">
    <div class="row">
        <div class="col s12 m12">
            <div class="card white darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline blue-grey-text">
                            Add Contact Person (for: {{ $client->name }})
                        </div>
                    </div>

                    <div class="pb-2">

                        <form action="{{ route('persons.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="client_id" value="{{ $client->id }}">

                            <div class="row">
                                <div class="input-field col s12 m8">
                                    <label for="name">Name
                                        <span class="red-text">*</span>
                                    </label>
                                    <input class="validate"
                                           type="text"
                                           placeholder="Officer Name"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required>
                                    @component('components.form-error', ['name'=>'name'])
                                    @endcomponent
                                </div>
                                <div class="input-field col s12 m4">
                                    <label for="surname">Surname
                                    </label>
                                    <input type="text"
                                           placeholder="Surname"
                                           id="surname"
                                           name="surname"
                                           value="{{ old('surname') }}">
                                    @component('components.form-error', ['name'=>'surname'])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m4">
                                    <label for="email">Email
                                        <span class="red-text">*</span>
                                    </label>
                                    <input class="validate"
                                           type="email"
                                           placeholder="Email"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required>
                                    @component('components.form-error', ['name'=>'email'])
                                    @endcomponent
                                </div>
                                <div class="input-field col s12 m3">
                                    <label for="phone">Phone
                                    </label>
                                    <input class="validate"
                                           type="tel"
                                           placeholder="Phone"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}">
                                    @component('components.form-error', ['name'=>'phone'])
                                    @endcomponent
                                </div>
                                <div class="input-field col s12 m3">
                                    <label for="department">Department
                                    </label>
                                    <input class="validate"
                                           type="text"
                                           placeholder="Department"
                                           id="department"
                                           name="department"
                                           value="{{ old('department') }}">
                                    @component('components.form-error', ['name'=>'department'])
                                    @endcomponent
                                </div>
                                <div class="input-field col s12 m2">
                                    <label for="designation">Designation
                                    </label>
                                    <input class="validate"
                                           type="text"
                                           placeholder="Designation"
                                           id="designation"
                                           name="designation"
                                           value="{{ old('designation') }}">
                                    @component('components.form-error', ['name'=>'designation'])
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
                            </div>
                            <div class="row">
                                @component('components.form-error', ['name'=>'client_id'])
                                @endcomponent
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
