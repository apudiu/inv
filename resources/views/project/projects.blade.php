@extends('layouts.main')

@section('title')
    Projects
@endsection

@section('content')

<div class="section">
    <div class="row">
        <div class="col s12 m12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline">Projects</div>
                        <div class="mr-0 float-right">
                            <a class="btn btn-small waves-effect blue-grey" 
                               href="{{ route('projects.create') }}">Add Project</a>
                        </div>
                    </div>

                    <div class="pb-2">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Client</th>
                                    <th>Hours</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($projects as $project)
                                    <tr>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->client->name }}</td>
                                        <td>{{ $project->hours }}</td>
                                        <td>{{ $project->total }}</td>
                                        <td>
                                            @component('components.status-badge', ['status' => $project->status])
                                            @endcomponent
                                        </td>
                                        <td>
                                            <a href="{{ route('projects.show', $project->id) }}"
                                               class='btn btn-small blue-grey waves-effect'>View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="center">No projects available</td>
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
