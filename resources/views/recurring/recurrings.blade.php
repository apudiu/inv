@extends('layouts.main')

@section('title')
    Recurrings
@endsection

@section('content')

<div class="section">
    <div class="row">
        <div class="col s12 m12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline">Recurring Invoices</div>
                        <div class="mr-0 float-right">
                            <a class="btn btn-small waves-effect blue-grey" 
                               href="{{ route('recurrings.create') }}">Add Recurring</a>
                        </div>
                    </div>

                    <div class="pb-2">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Inv. ID</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Client</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($recurrings as $recurring)
                                    <tr>
                                        <td>{{ $recurring->invoice->id }}</td>
                                        <td>{{ $recurring->start_date }}</td>
                                        <td>{{ $recurring->end_date }}</td>
                                        <td>{{ $recurring->invoice->client->name }}</td>
                                        <td>
                                            <a href="{{ route('invoices.show', $recurring->invoice->id) }}"
                                               class='btn btn-small blue-grey waves-effect'>View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="center">No recurring invoice available</td>
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
