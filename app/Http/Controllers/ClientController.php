<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientStoreRequest;
use App\Repositories\Client\ClientInterface;
use App\Traits\ImageHandleTrait;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ImageHandleTrait;


    // Client repository
    private $clientRepo;


    public function __construct(ClientInterface $client)
    {
        $this->clientRepo = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->clientRepo->getAll();

        $data = [
            'clients' => $clients,
        ];

        return view('client.clients', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.add-client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        /// preparing data
        $data = [
            'name' => $request->get('name'),
            'city' => $request->get('city'),
            'address' => $request->get('address'),
            'zip' => $request->get('zip'),
        ];

        // handling optional params
        if ($request->filled('tax')) {
            $data['tax_id'] = $request->get('tax');
        }

        if ($request->filled('note')) {
            $data['note'] = $request->get('note');
        }

        // uploading image if available
        if ($request->hasFile('img')) {

            // upload path
            $path = config('app.image.client.upload_path');

            $image = $request->file('img');

            $uploadedName = $this->setUploadPath($path)->uploadImages([$image]);

            $data['image'] = $uploadedName;
        }

        /// creating client

        $client = $this->clientRepo->create($data);

        /// Redirecting with notification

        if ($client->id) {

            return redirect()->route('clients');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
