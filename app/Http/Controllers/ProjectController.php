<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Notifications\ProjectAdded;
use App\Project;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Project\ProjectInterface;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class ProjectController extends Controller
{
    use Notifiable;

    private $projectRepo,
            $clientRepo;


    public function __construct(ProjectInterface $project, ClientInterface $client)
    {
        $this->middleware('auth');

        $this->projectRepo = $project;
        $this->clientRepo = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->projectRepo->getAll(['entries']);

        $projects = $projects->map(function ($project) {

            $proj = $project->entries->map(function ($entry) {

                return [
                    'hours' => $entry->hour,
                    'total' => ($entry->rate * $entry->hour)
                ];
            });

            // assigning new properties for view
            $project->hours = $proj->sum('hours');
            $project->total = $proj->sum('total');

            return $project;
        });


        $data = [
            'projects' => $projects
        ];

        return view('project.projects', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = $this->clientRepo->getAll();

        $data = [
            'clients' => $clients,
        ];

        return view('project.add-project', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        /// preparing data
        $projectData = [
            'client_id' => $request->get('client'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];

        $entryData = $request->get('entry');

        /// creating model
        $project = $this->projectRepo->create($projectData, $entryData);

        /// Redirecting with notification
        if ($project->id) {

            // notify
            $this->notify(new ProjectAdded($project));
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = $this->projectRepo->getById($id, ['entries']);

        $data = [
            'project' => $project
        ];

        return view('project.project', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
