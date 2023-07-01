@extends('layouts.main')

@section('title')
    Welcome
@endsection

@section('content')

<div class="section">
    <div class="row">
        <div class="col s12 m12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline">Clients</div>
                        <div class="mr-0 float-right">
                            <a class="btn btn-small waves-effect blue-grey" 
                               href="{{ route('clients.create') }}">Add Client</a>
                        </div>
                    </div>

                    <div class="pb-2">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>City</th>
                                    <th>Since</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->city }}</td>
                                        <td>{{ formatDateTime($client->created_at, true) }}</td>
                                        <td>
                                            {{--<button class='dropdown-trigger btn btn-small blue-grey waves-effect'--}}
                                                    {{--data-target='d1'>Action</button>--}}
                                            {{--<ul id='d1' class='dropdown-content'>--}}
                                                {{--<li><a href="#!">Edit</a></li>--}}
                                                {{--<li><a href="#!">View</a></li>--}}
                                            {{--</ul>--}}
                                            <a href="{{ route('clients.show', $client->id) }}"
                                               class='btn btn-small blue-grey waves-effect'>View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="center">No clients available</td>
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
