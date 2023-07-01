@extends('layouts.main')

@section('title')
    Add Project
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
            width: 15%;
        }
        #inv-tbl th.desc {
            width: 55%;
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
                        <div class="ml-0 d-inline blue-grey-text">Add Project</div>
                    </div>

                    <div class="pb-2">
                        <hr>
                        <form action="{{ route('projects.store') }}" method="POST">
                            @csrf

                            @component('components.form-error-list')
                            @endcomponent
                            <div class="row">
                                <div class="input-field col s12 m7">
                                    <label for="name">Name
                                        <span class="red-text">*</span>
                                    </label>
                                    <input class="validate"
                                           type="text"
                                           id="name"
                                           placeholder="Enter name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required>
                                </div>
                                <div class="input-field col s12 m5">
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
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="desc">Description.
                                        <span class="red-text">*</span>
                                    </label>
                                    <textarea id="desc" class="materialize-textarea validate"
                                              placeholder="Project description"
                                              name="description"
                                              required>{{ old('description') }}</textarea>
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
                                                            <th class="qt">Hours</th>
                                                            <th class="desc">Description</th>
                                                            <th class="price">Rate</th>
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
                                                                    <div class="input-field col s12">
                                                                        <input class="white-text qt"
                                                                               type="text"
                                                                               name="entry[1][hour]"
                                                                               value="0">

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
                                                                               name="entry[1][rate]"
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
                        <div class="input-field col s12">
                            <input class="white-text qt"
                                   type="text"
                                   name="entry[index][hour]"
                                   value="0">
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
                                   name="entry[index][rate]"
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

            // Calculating total in entries (using event delegation)
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

            // removing  entry
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
