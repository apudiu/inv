<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRecurStoreRequest;
use App\InvoiceRecur;
use App\Notifications\InvoiceRecurringAdded;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Recur\RecurringInterface;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class InvoiceRecurController extends Controller
{
    use Notifiable;

    private $clientRepo,
            $recurringRepo;


    public function __construct(ClientInterface $client, RecurringInterface $recurring)
    {
        // requiring authentication
        $this->middleware('auth');

        $this->clientRepo = $client;
        $this->recurringRepo = $recurring;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recurrings = $this->recurringRepo->getAll();

        $data = [
            'recurrings' => $recurrings
        ];

        return view('recurring.recurrings', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // related models of client
        $clientRelated = ['invoices'];
        // get all
        $clients = $this->clientRepo->getAll($clientRelated);

        $data = [
            'clients' => $clients
        ];

        return view('recurring.add-recurring', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRecurStoreRequest $request)
    {
        // prepare data to be stored
        $startDate = strftime('%F', strtotime($request->get('start_date')));
        $endDate = strftime('%F', strtotime($request->get('end_date')));
        $enabled = ($request->get('enabled')) ? '1' : '0';
        $invoiceSend = ($request->get('send')) ? '1' : '0';

        $data = [
            'invoice_id' => $request->get('invoice'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'interval' => $request->get('interval'),
            'enabled' => $enabled,
            'send_invoice' => $invoiceSend,
        ];

        $recur = $this->recurringRepo->create($data);


        // redirecting
        if ($recur->id) {

            // notify
            $this->notify(new InvoiceRecurringAdded($recur));
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceRecur  $invoiceRecur
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceRecur $invoiceRecur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceRecur  $invoiceRecur
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceRecur $invoiceRecur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceRecur  $invoiceRecur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceRecur $invoiceRecur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceRecur  $invoiceRecur
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceRecur $invoiceRecur)
    {
        //
    }
}
