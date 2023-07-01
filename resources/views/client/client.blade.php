@extends('layouts.main')

@section('title')
    Client
@endsection

@section('content')

<div class="section">
    <div class="row">
        <div class="col s12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline">Client Info</div>
                        <div class="mr-0 float-right">
                            <a class="btn btn-small waves-effect blue-grey" 
                               href="{{ route('clients.edit', $client->id) }}">Edit Client</a>
                        </div>
                    </div>

                    <div class="">
                        <hr>

                        <div class="row">
                            <div class="col s12 m5">
                                <div class="row">
                                    <div class="col s12">
                                        <img class="materialboxed responsive-img"
                                             src="{{ clientImage($client->image) }}"
                                             alt="{{ $client->name }} logo">
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m7">
                                <div class="row">
                                    <div class="col s12 m4 font-weight-bold">Company</div>
                                    <div class="col s12 m8">{{ $client->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m4 font-weight-bold">Address</div>
                                    <div class="col s12 m8">
                                        {{ $client->address }} <br>
                                        {{ $client->city }} - {{ $client->zip }} <br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m4 font-weight-bold">Tax ID</div>
                                    <div class="col s12 m8">{{ $client->tax_id }}</div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m4 font-weight-bold">Note</div>
                                    <div class="col s12 m8">{{ $client->note }}</div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m4 font-weight-bold">Since</div>
                                    <div class="col s12 m8">{{ formatDateTime($client->created_at, true) }}</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Contacts -->
        <div class="col s12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline">Contacts</div>
                        <div class="mr-0 float-right">
                            <a class="btn btn-small waves-effect blue-grey"
                               href="{{ route('persons.create', $client->id) }}">Add Contact</a>
                        </div>
                    </div>

                    <div class="pb-2">
                        <hr>

                        <table class="responsive-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($client->loadMissing('persons')->persons as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->department }}</td>
                                    <td>{{ $contact->designation }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>
                                        <a href="{{ route('persons.show', $contact->id) }}"
                                           class='btn btn-small blue-grey waves-effect'>Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="center">No contacts available</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
