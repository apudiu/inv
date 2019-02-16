<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Invoice;
use App\Notifications\InvoiceAdded;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Invoice\InvoiceInterface;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class InvoiceController extends Controller
{
    use Notifiable;

    private $clientRepo,
            $invoiceRepo;


    public function __construct(ClientInterface $client, InvoiceInterface $invoice)
    {
        // requiring authentication
        $this->middleware('auth');

        $this->clientRepo = $client;
        $this->invoiceRepo = $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // eager loading related models for invoice (conf)
        $eagerloadInvs = ['entries:invoice_id,qty,price', 'client:id,name'];

        // getting invoices with related models
        $invs = $this->invoiceRepo->getAll($eagerloadInvs)
            ->where('type','invoice'); // its not efficient but doing it as its a small project

        // adding 'amount' to each invoice
        $invs = $invs->map(function($invoice) {

            // summing each entry (qty * price)
            $inv = $invoice->entries->map(function($entry) {

                // returning only the sum
                return ($entry->qty * $entry->price);
            });

            // assigning each entries sum to new attribute (amount)
            $invoice->amount = $inv->sum();

            // return the modified model
            return $invoice;
        });


        $data = [
            'invoices' => $invs,
        ];

        return view('invoice.invoices', $data);
    }

    public function indexEstimate()
    {
        // eager loading related models for estimate (conf)
        $eagerloadInvs = ['entries:invoice_id,qty,price', 'client:id,name'];

        // getting estimates with related models
        $estms = $this->invoiceRepo->getAll($eagerloadInvs)
            ->where('type','estimate');

        // adding 'amount' to each invoice
        $estms = $estms->map(function($estimate) {

            // summing each entry (qty * price)
            $estm = $estimate->entries->map(function($entry) {

                // returning only the sum
                return ($entry->qty * $entry->price);
            });

            // assigning each entries sum to new attribute (amount)
            $estimate->amount = $estm->sum();

            // return the modified model
            return $estimate;
        });


        $data = [
            'estimates' => $estms,
        ];

        return view('estimate.estimates', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = $this->clientRepo->getAll();
        $entryTypes = config('app.invoice.entry.types');
        $invoiceTypes = config('app.invoice.type');

        $data = [
            'clients' => $clients,
            'entryTypes' => $entryTypes,
            'invoiceTypes' => $invoiceTypes
        ];

        return view('invoice.add-invoice', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceStoreRequest $request)
    {
        /// preparing data
        $invoiceData = [
            'client_id' => $request->get('client'),
            'p_o_no' => $request->get('pon'),
            'contact' => $request->get('contact'),
            'type' => $request->get('type'),
        ];

        if ($invoiceData['type'] == 'estimate') {
            $invoiceData['status'] = 'draft';
        }

        $entryData = $request->get('entry');

        /// creating model
        $invoice = $this->invoiceRepo->create($invoiceData, $entryData);

        /// Redirecting with notification
        if ($invoice->id) {

            // notify
            $this->notify(new InvoiceAdded($invoice));
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param $invoiceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($invoiceId)
    {
        // eager related
        $related = ['entries', 'client', 'persons'];
        $invoice = $this->invoiceRepo->getById($invoiceId, $related);

        $data = [
            'invoice' => $invoice
        ];

        return view('invoice.invoice', $data);
    }

    public function showEstimate($estimateId) {

        // eager related
        $related = ['entries', 'client', 'persons'];
        $estimate = $this->invoiceRepo->getById($estimateId, $related);

        $data = [
            'estimate' => $estimate
        ];

        return view('estimate.estimate', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
