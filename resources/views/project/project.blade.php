@extends('layouts.main')

@section('title')
    Project
@endsection

@section('onpage-css')
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <style>
        #total-txt {
            width: 86%;
        }
        #total-val {
            width: 14%;
        }

        @media print {
            a[href*='//']:after {
                content:" (" attr(href) ") ";
                color: lightblue;
            }
            #invoice * {
                background-color: royalblue;
                color: black;
            }
        }
    </style>
@endsection

@section('content')

<div class="section">
    <div class="row">
        <div class="col s12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <div class="card-title">
                        <div class="ml-0 d-inline">Project Details</div>
                        <div class="mr-0 float-right">
                            {{--<a class="" --}}
                               {{--href="{{ route('invoices.edit', $invoice->id) }}">Edit Invoice</a>--}}
                            <a class='dropdown-trigger btn btn-small waves-effect blue-grey'
                               data-target='invoice-edit'>
                               Actions <i class="material-icons right">arrow_drop_down</i>
                            </a>

                            <!-- Dropdown Structure -->
                            <ul id='invoice-edit' class='dropdown-content'>
                                <li><a href="#!" id="print-btn">Print</a></li>
                                <li><a href="#!" id="download-btn">Download</a></li>
                                <li class="divider" tabindex="-1"></li>
                                <li><a href="#!">Change Stat.</a></li>
                                <li class="divider" tabindex="-1"></li>
                                <li><a href="#!">Edit</a></li>
                                <li><a href="#!">Delete</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="">
                        <hr>

                        <div class="row">
                            <div class="col s12">
                                <div class="row">
                                    <!-- From -->
                                    <div class="col s12">

                                        <div class="card" id="invoice">
                                            <div class="card-content black-text">
                                                <div class="row">
                                                    <div class="col s12 m8">
                                                        <h5 class="mt-0">
                                                            {{ $project->name }}
                                                        </h5>
                                                    </div>
                                                    <div class="col s12 m4">
                                                        <div>
                                                            <span class="font-weight-bold">Project </span> #
                                                            {{ $project->id }}
                                                            @component('components.status-badge', ['status' => $project->status])
                                                            @endcomponent
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold">Date of project:</span>
                                                            {{ formatDateTime($project->created_at, true) }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col s12 m8">
                                                        {{ $project->description }}
                                                    </div>

                                                    <div class="col s12 m4">
                                                        <h6>Client</h6>
                                                        <div class="font-weight-bold">
                                                            {{ $project->client->name }}
                                                        </div>
                                                        <div>
                                                            <div>{{ $project->client->address }}</div>
                                                            <div>{{ $project->client->city }} {{ $project->client->zip }}</div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <h6 class="mb-0">Status</h6>
                                                        </div>
                                                        <div class="font-weight-bold">{{ $project->status }}</div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col s12">
                                                        <table class="table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Hours</th>
                                                                <th>Description</th>
                                                                <th>Rate</th>
                                                                <th>Total</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                                @forelse($project->entries as $entry)
                                                                    <tr>
                                                                        <td>{{ $entry->hour }}</td>
                                                                        <td>{{ $entry->description }}</td>
                                                                        <td>{{ $entry->rate }}</td>
                                                                        <td class="entry-total">{{ $entry->hour * $entry->rate }}</td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="4" class="red-text">No entries available</td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                        <div class="font-weight-bold">
                                                            <hr>
                                                            <div class="col s12 text-right" id="total-txt">Total</div>
                                                            <div class="col s12" id="total-val">0</div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('onpage-js')
    <script src="{{ asset('js/print.js') }}"></script>
    <script src="{{ asset('js/html2pdf.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // calculating grand total for invoice
            calculateGTotal('#total-val', '.entry-total');

            // printing
            $('#download-btn').click(function (e) {
                // download as PDF file
                printElement('invoice', 'Invoice_{{ $project->id }}');

            });

        });
    </script>
@endsection
