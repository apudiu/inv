<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Invoice\InvoiceInterface;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class InvoiceController extends Controller
{
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
//        $invs = Invoice::with('entries')->get();
//        dd($invs);
        $data = [
            'invoices' => []
        ];

        return view('invoice.invoices', $data);
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

        $data = [
            'clients' => $clients,
            'entryTypes' => $entryTypes
        ];

        return view('invoice.add-invoice', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
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
