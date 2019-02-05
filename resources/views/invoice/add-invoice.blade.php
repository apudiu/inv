@extends('layouts.main')

@section('title')
    Add Invoice
@endsection

@section('onpage-css')
    <style>
        label[for="client"], label[for="contact"] {
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
                        <div class="ml-0 d-inline blue-grey-text">Add Invoice</div>
                    </div>

                    <div class="pb-2">
                        <hr>
                        <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if($errors->count())
                                <div class="row">
                                    <div class="col s12 form-error-container">
                                        <div class="font-weight-bold">Please correct following errors to proceed</div>
                                        <ul>
                                            @foreach($errors->all() as $er)
                                                <li>{{ $er }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="input-field col s12 m7">
                                    <label for="client">Client
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
                                    <label for="date">Date
                                        <span class="red-text">*</span>
                                    </label>
                                    <input class="validate datepicker"
                                           type="text"
                                           id="date"
                                           placeholder="Select Date"
                                           name="date"
                                           value="{{ old('date') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <label for="contact">Contact
                                        <span class="red-text">*</span>
                                        <span class="material-icons spin" id="contact-loader">cached</span>
                                    </label>
                                    <select class="validate"
                                            id="contact"
                                            name="contact[]"
                                            multiple>
                                        <option value="" disabled>Choose contact</option>
                                    </select>
                                </div>
                                <div class="input-field col s12 m3">
                                    <label for="pon">P.O. No.
                                    </label>
                                    <input class="validate"
                                           type="text"
                                           id="pon"
                                           placeholder="P.O. Number"
                                           name="pon"
                                           value="{{ old('pon') }}">
                                </div>
                                <div class="input-field col s12 m3">
                                    <label for="iid">Invoice ID
                                    </label>
                                    <input class="validate"
                                           type="number"
                                           id="iid"
                                           placeholder="Invoice ID"
                                           name="invid"
                                           value="{{ old('invid') }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <div class="card blue-grey darken-1">
                                        <div class="card-content white-text">
                                            <div class="card-title">
                                                <div class="ml-0 d-inline">Entries</div>
                                                <div class="mr-0 float-right">
                                                    <button type="button" id="add-entry-btn"
                                                            class="btn btn-small waves-effect blue-grey">Add</button>
                                                </div>
                                            </div>

                                            <div class="pb-2">
                                                <hr>
                                                <table class="highlight" id="inv-tbl">
                                                    <thead>
                                                        <tr>
                                                            <th class="action">A.</th>
                                                            <th class="qt">Qt</th>
                                                            <th class="desc">Description</th>
                                                            <th class="price">Price</th>
                                                            <th class="total-h">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pt-0 pb-0">
                                                                <button type="button" class="waves-effect waves-orange btn-floating btn-flat blue-grey delete-entry-btn">
                                                                    <i class="material-icons">delete</i>
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="input-field col s5">
                                                                        <input class="white-text qt"
                                                                               type="text"
                                                                               name="entry[1][qty]"
                                                                               value="0">

                                                                    </div>
                                                                    <div class="input-field col s7">
                                                                        <select class="validate white-text inv-entry-first"
                                                                                name="entry[1][qt_type]">
                                                                            @foreach($entryTypes as $entry)
                                                                                <option value="{{ $entry }}">{{ $entry }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-field mt-0 mb-0">
                                                                        <textarea class="white-text materialize-textarea"
                                                                                  name="entry[1][description]"
                                                                                  placeholder="Description"></textarea>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <input class="white-text price"
                                                                               type="text"
                                                                               name="entry[1][price]"
                                                                               value="0">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="total">0</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <hr>
                                                <div class="row">
                                                    <div class="col s12 text-right" id="g-total-txt">Total</div>
                                                    <div class="col s12" id="g-total-val">0</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 center">
                                    <button type="reset" class="btn waves-effect white darken-2 black-text text-lighten-2">Reset</button>
                                    <button type="submit" class="btn waves-effect light-blue darken-2">Create Invoice</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden template for adding in the invoice -->
<div class="d-none" id="inv-entry-template">
    <table>
        <tbody>
            <tr>
                <td class="pt-0 pb-0">
                    <button type="button" class="waves-effect waves-orange btn-floating btn-flat blue-grey delete-entry-btn">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
                <td>
                    <div class="row">
                        <div class="input-field col s5">
                            <input class="white-text qt"
                                   type="text"
                                   name="entry[index][qty]"
                                   value="0">
                        </div>
                        <div class="input-field col s7">
                            <select class="validate white-text inv-entry-type"
                                    name="entry[index][qt_type]">
                                @foreach($entryTypes as $entry)
                                    <option value="{{ $entry }}">{{ $entry }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-field mt-0 mb-0">
                        <textarea class="white-text materialize-textarea"
                                  name="entry[index][description]"
                                  placeholder="Description"></textarea>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="white-text price"
                                   type="text"
                                   name="entry[index][price]"
                                   value="0">
                        </div>
                    </div>
                </td>
                <td>
                    <span class="total">0</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection

@section('onpage-js')
    <script>
        $(document).ready(function() {

            // init dropdowns
            $('#client, #contact, .inv-entry-first').formSelect();

            // getting contact list for selected client
            $('#client').change(function() {

                // selected client id
                let clientId = this.value;

                // persons dropdown
                let personsDropDown = $('#contact');

                // Request interceptor for handling something just after request is sent
                const loadingSign = axios.interceptors.request.use((config) => {
                    $('#contact-loader').css('display', 'inline-block');
                    return config;

                }, (error) => {
                    console.error('Error on request interceptor');
                    return Promise.reject(error);
                });


                // get contact persons for this client
                axios.get('/persons/by_client/' + clientId)
                    .then(function (response) {

                        // contacts for the selected company
                        let persons = response.data;

                        // emptying previous contacts
                        personsDropDown.empty();

                        // inserting first item
                        let nContacts = (persons.length >= 1) ? 'Choose contact' : 'No contacts available';
                        personsDropDown.append(`<option value="" disabled>${nContacts}</option>`);

                        $.each(persons, function(index, person) {

                            // creating new option
                            let newOpt = $('<option></option>').attr('value', person.id).text(person.name);

                            // adding new options to the dropdown
                            personsDropDown.append(newOpt);
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
                        personsDropDown.formSelect();

                        // hiding contact loader
                        $('#contact-loader').hide();
                    });

            });

            // Calculating total in invoice entries (using event delegation)
            $('#inv-tbl').on('change keyup', function (e) {

                // actual clicked element
                let element = e.target;

                // affected row
                let row = $(element).parents('tr').first();

                // current qt
                let qt = row.find('.qt').val();

                // current price
                let price = row.find('.price').val();

                // updating total
                let total = (qt * price);
                row.find('.total').text(total);

                // updating grand total
                calculateGTotal('#g-total-val', '.total');
            });

            // removing invoice entry
            $('#inv-tbl').on('click', function (e) {

                // actual clicked element
                let element = e.target;

                // if clicked on delete button
                let deleteBtn = $(element).parent('button').hasClass('delete-entry-btn');

                if (deleteBtn) {

                    // current row
                    let row = $(element).parents('tr').first();

                    // remove
                    row.remove();

                    // updating grand total
                    calculateGTotal('#g-total-val', '.total');
                }

            });

            // Adding new entry (row)
            // index of entries
            let eIndex = 2;

            $('#add-entry-btn').click(() => {

                // container
                let container = $('#inv-tbl tbody');

                // template
                let row = $('#inv-entry-template tbody').html();
                // placing indexes
                row = row.replace(/index/g, eIndex);

                // adding single row
                container.append(row);

                eIndex++;

                // reinitializing invoice dropdown's
                $('#inv-tbl .inv-entry-type').formSelect();

            });

        });
    </script>
@endsection
