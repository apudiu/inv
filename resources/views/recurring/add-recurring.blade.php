@extends('layouts.main')

@section('title')
    Add Recurring
@endsection

@section('onpage-css')
    <style>
        label.dropdown-label {
            top: -25px;
            font-size: 0.85rem;
        }
        table.highlight > tbody > tr:hover {
            background-color: rgba(242, 242, 242, 0.1);
        }
        #inv-tbl td, #inv-tbl th{
            padding-left: 5px;
            padding-right: 5px;
        }
        #contact-loader {
            display: none;
        }

        #inv-tbl tbody td * {
            margin-top: 0;
            margin-bottom: 0;
        }

        #inv-tbl th.action {
            width: 10%;
        }
        #inv-tbl th.qt {
            width: 30%;
        }
        #inv-tbl th.desc {
            width: 40%;
        }
        #inv-tbl th.price {
            width: 10%;
        }
        #inv-tbl th.total-h {
            width: 10%;
        }

        #inv-tbl textarea {
            height: 47px !important;
        }

        #g-total-txt {
            width: 87%;
        }
        #g-total-val {
            width: 13%;
        }
    </style>
@endsection

@section('content')

    <div class="section">
        <div class="row">
            <div class="col s12 m12">
                <div class="card white darken-1">
                    <div class="card-content white-text">
                        <div class="card-title">
                            <div class="ml-0 d-inline blue-grey-text">Create Recurring</div>
                        </div>

                        <div class="pb-2">
                            <hr>
                            <form action="{{ route('recurrings.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @component('components.form-error-list')
                                @endcomponent
                                <div class="row">
                                    <div class="input-field col s12 m7">
                                        <label for="client" class="dropdown-label">Client
                                            <span class="red-text">*</span>
                                        </label>
                                        <select class="validate"
                                                id="client"
                                                name="client">
                                            <option value="" disabled selected>Choose client</option>
                                            @forelse($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="input-field col s12 m5">
                                        <label for="invoice" class="dropdown-label">Invoice
                                            <span class="red-text">*</span>
                                            <span class="material-icons spin hidden" id="invoice-loader">refresh</span>
                                        </label>
                                        <select class="validate"
                                                id="invoice"
                                                name="invoice">
                                            <option value="" disabled>Choose Invoice</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <label for="date1">Start Date
                                            <span class="red-text">*</span>
                                        </label>
                                        <input class="validate datepicker"
                                               type="text"
                                               id="date1"
                                               placeholder="Start Date"
                                               name="start_date"
                                               value="{{ old('start_date') }}">
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <label for="date2">End Date
                                            <span class="red-text">*</span>
                                        </label>
                                        <input class="validate datepicker"
                                               type="text"
                                               id="date2"
                                               placeholder="End Date"
                                               name="end_date"
                                               value="{{ old('end_date') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m5">
                                        <label for="int">Interval
                                            <span class="red-text">*</span>
                                        </label>
                                        <input class="validate"
                                               type="number"
                                               id="int"
                                               placeholder="Interval in Days"
                                               name="interval"
                                               value="{{ old('interval') }}">
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <label class="dropdown-label">Enabled
                                        </label>
                                        <div class="switch mt-3">
                                            <label>
                                                Off
                                                <input type="checkbox"
                                                       name="enabled"
                                                       checked>
                                                <span class="lever"></span>
                                                On
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-field col s12 m4">
                                        <label class="mt-1">
                                            <input type="checkbox"
                                                   class="filled-in"
                                                   name="send"
                                                   checked>
                                            <span>Send Invoice Automatically

                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12 center">
                                        <button type="reset" class="btn waves-effect white darken-2 black-text text-lighten-2">Reset</button>
                                        <button type="submit" class="btn waves-effect light-blue darken-2">Create Recurring</button>
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

@section('onpage-js')
    <script>
        $(document).ready(function() {

            // init dropdowns
            $('#client, #invoice').formSelect();

            // getting contact list for selected client
            $('#client').change(function() {

                // selected client id
                let clientId = this.value;

                // invoices dropdown
                let invoicesDropDown = $('#invoice');

                // Request interceptor for handling something just after request is sent
                const loadingSign = axios.interceptors.request.use((config) => {
                    $('#invoice-loader').css('display', 'inline-block');
                    return config;

                }, (error) => {
                    console.error('Error on request interceptor');
                    return Promise.reject(error);
                });


                // get contact persons for this client
                axios.get('/invoices/by_client/' + clientId)
                    .then(function (response) {

                        // invoices for the selected company
                        let invoices = response.data;

                        // emptying previous invoices
                        invoicesDropDown.empty();

                        // inserting first item
                        let nInvoices = (invoices.length >= 1) ? 'Choose Invoice' : 'No Invoice available';
                        invoicesDropDown.append(`<option value="" disabled>${nInvoices}</option>`);

                        $.each(invoices, function(index, invoice) {

                            // creating new option
                            let newOpt = $('<option></option>')
                                .attr('value', invoice.id)
                                .text('#' + invoice.id + ' / ' + invoice.creation_date + ' / '+ invoice.status);

                            // adding new options to the dropdown
                            invoicesDropDown.append(newOpt);
                        });
                    })

                    .catch(function (error) {
                        console.error(error);
                    })

                    .then(function () {
                        // always executed

                        // removing interceptor
                        axios.interceptors.request.eject(loadingSign);

                        // re initiating the dropdown with updated options
                        invoicesDropDown.formSelect();

                        // hiding contact loader
                        $('#invoice-loader').hide();
                    });

            });

        });
    </script>
@endsection
