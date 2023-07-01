@extends('layouts.main')

@section('title')
    Invoice
@endsection

@section('onpage-css')
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <style>
        #total-txt {
            width: 81%;
        }
        #total-val {
            width: 19%;
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
                        <div class="ml-0 d-inline">Invoice Details</div>
                        <div class="mr-0 float-right">
                            {{--<a class="" --}}
                               {{--href="{{ route('invoices.edit', $invoice->id) }}">Edit Invoice</a>--}}
                            <a class='dropdown-trigger btn btn-small waves-effect blue-grey'
                               data-target='invoice-edit'>
                               Actions <i class="material-icons right">arrow_drop_down</i>
                            </a>

                            <!-- Dropdown Structure -->
                            <ul id='invoice-edit' class='dropdown-content'>
                                <li><a href="#!">Send</a></li>
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
                                                        <h4 class="mt-0">{{ ($m = getAuthUser())->org }}</h4>
                                                    </div>
                                                    <div class="col s12 m4">
                                                        <div>
                                                            <span class="font-weight-bold">Invoice </span> #
                                                            {{ $invoice->id }}
                                                            @component('components.status-badge', ['status' => $invoice->status])
                                                            @endcomponent
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold">Date of invoice:</span>
                                                            {{ formatDateTime($invoice->created_at, true) }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col s12 m6">
                                                        <h6>To</h6>
                                                        <div class="font-weight-bold">
                                                            {{ $invoice->client->name }}
                                                        </div>
                                                        <div>
                                                            <div>{{ $invoice->client->address }}</div>
                                                            <div>{{ $invoice->client->city }} {{ $invoice->client->zip }}</div>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                @forelse($invoice->persons as $person)

                                                                    <li>
                                                                        <span class="font-weight-bold">
                                                                            {{ $person->name }}
                                                                        </span>
                                                                        {{ $person->email }}
                                                                    </li>

                                                                @empty
                                                                    <li class="red-text">No contacts available</li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col s12 m6">
                                                        <h6>From</h6>
                                                        <div class="font-weight-bold">
                                                            {{ $m->org }}
                                                        </div>
                                                        <div>
                                                            <div>{{ $m->address }}</div>
                                                            <div>Dhaka 1212</div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <span class="font-weight-bold">
                                                                {{ $m->name }}
                                                            </span>
                                                            {{ $m->email }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col s12">
                                                        <table class="table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Qty</th>
                                                                <th>Description</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                                @forelse($invoice->entries as $entry)
                                                                    <tr>
                                                                        <td>{{ $entry->qty }}</td>
                                                                        <td>{{ $entry->description }}</td>
                                                                        <td>{{ $entry->price }}</td>
                                                                        <td class="entry-total">{{ $entry->qty * $entry->price }}</td>
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
                                                            <div class="col s12" id="total-val">12000</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col s12 font-weight-bold mt-4">Note</div>
                                                    <div class="col s12">Thank you!</div>
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
                printElement('invoice', 'Invoice_{{ $invoice->id }}');

            });

        });
    </script>
@endsection
