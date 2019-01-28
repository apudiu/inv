<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:24 PM
 */

namespace App\Repositories\Person;


use App\Person;

class PersonRepository implements PersonInterface
{
    // Model (resolved by IoC)
    private $person;


    public function __construct(Person $person)
    {
        // Getting model using Laravel service container (IoC container)
        $this->person = $person;
    }

    /**
     * Get all persons
     * @return Person[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllByClient(int $id)
    {
        return $this->person->where('client_id', $id)->get();
    }

    /**
     * Get person by id
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->person->findOrFail($id);
    }

    /**
     * Create person
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->person->create($attributes);
    }

    /**
     * Update person
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->getById($id)->update($attributes);
    }

    /**
     * Delete person
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->getById($id)->delete();
    }
}
