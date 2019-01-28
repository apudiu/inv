<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonStoreRequest;
use App\Notifications\PersonAdded;
use App\Person;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Person\PersonInterface;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class PersonController extends Controller
{
    use Notifiable;

    // Person repository
    private $personRepo;
    private $clientRepo;


    public function __construct(PersonInterface $person, ClientInterface $client)
    {
        $this->personRepo = $person;
        $this->clientRepo = $client;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($clientId)
    {
        $client = $this->clientRepo->getById($clientId);

        $data = [
            'client' => $client
        ];

        return view('person.add-person', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonStoreRequest $request)
    {
        /// preparing data
        $data = [
            'client_id' => $request->get('client_id'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            // optionals
            'surname' => $request->get('surname'),
            'phone' => $request->get('phone'),
            'department' => $request->get('department'),
            'designation' => $request->get('designation'),
            'note' => $request->get('note'),
        ];

        /// creating model

        $person = $this->personRepo->create($data);

        /// Redirecting with notification

        if ($person->id) {

            // notify
            $this->notify(new PersonAdded($person));

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }

    /**
     * Get all persons of a client
     *
     * @param int $clientId
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getPersonsByClient(int $clientId, Request $request) {

        // allow only AJAX calls
        if (!$request->ajax()) {
            return response('Only ajax calls allowed', 403);
        }

        // get all persons by client
        $persons = $this->personRepo->getAllByClient($clientId);

        return response()->json($persons);
    }
}
