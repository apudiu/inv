<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:24 PM
 */

namespace App\Repositories\Project;


use App\Project;
use DB;

class ProjectRepository implements ProjectInterface
{
    // Model (resolved by IoC)
    private $project;


    public function __construct(Project $project)
    {
        // Getting model using Laravel service container (IoC container)
        $this->project = $project;
    }

    /**
     * Get all
     * @param array $with pull listed relations too
     * @return Invoice[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll(array $with=[])
    {
        return $this->project->with($with)->get();
    }

    /**
     * Get one by id
     * @param int $id
     * @param array $with list of relations to eager load
     * @return mixed
     */
    public function getById(int $id, array $with=[])
    {
        return $this->project->with($with)->findOrFail($id);
    }

    /**
     * Create one
     * @param array $projectData
     * @param array $entryData
     * @return mixed
     * @throws \Throwable
     */
    public function create(array $projectData, $entryData)
    {
        // using transaction for safety as it will insert data in multiple table
        $inv = DB::transaction(function () use ($projectData, $entryData) {

            // creating
            $project = $this->project->create($projectData);

            // adding necessary fields to each entries
            $entryData = array_map(function ($item) use($project) {

                // adding project_id to each entry
                $item['project_id'] = $project->id;

                return $item;

            }, $entryData);


            // deleting hardcoded indexes
            $entryData = array_values($entryData);

            // saving entries
            $entries = $project->entries()->createMany($entryData);

            return [
                'project' => $project,
                'entries' => $entries,
            ];
        });

        return $inv['project'];
    }

    /**
     * Update one
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->getById($id)->update($attributes);
    }

    /**
     * Delete one
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->getById($id)->delete();
    }
}
