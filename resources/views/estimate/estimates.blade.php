@extends('layouts.main')

@section('title')
    Estimates
@endsection

@section('content')

<div class="section">
    <div class="row">
        <div class="col s12 m12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline">Estimates</div>
                        <div class="mr-0 float-right">
                            <a class="btn btn-small waves-effect blue-grey" 
                               href="{{ route('invoices.create') }}">Add Estimate</a>
                        </div>
                    </div>

                    <div class="pb-2">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($estimates as $estimate)
                                    <tr>
                                        <td>{{ $estimate->id }}</td>
                                        <td>{{ formatDateTime($estimate->created_at, true) }}</td>
                                        <td>{{ $estimate->client->name }}</td>
                                        <td>{{ $estimate->amount }}</td>
                                        <td>
                                            @component('components.status-badge', ['status' => $estimate->status])
                                            @endcomponent
                                        </td>
                                        <td>
                                            <a href="{{ route('estimates.show', $estimate->id) }}"
                                               class='btn btn-small blue-grey waves-effect'>View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="center">No estimate available</td>
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
