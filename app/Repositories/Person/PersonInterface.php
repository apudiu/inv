<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:15 PM
 */

namespace App\Repositories\Person;


interface PersonInterface
{
    // get all by clients
    public function getAllByClient(int $id);

    // get a person by id
    public function getById(int $id);

    // create a person
    public function create(array $attributes);

    // update a person
    public function update(int $id, array $attributes);

    // delete a person
    public function delete(int $id);
}
