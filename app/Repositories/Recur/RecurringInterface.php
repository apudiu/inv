<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:15 PM
 */

namespace App\Repositories\Recur;


interface RecurringInterface
{
    // get all
    // $with is list of relations to pull from
    public function getAll(array $with = []);

    // get one by id
    public function getById(int $id, array $with = []);

    // create one
    public function create(array $attributes);

    // update one
    public function update(int $id, array $attributes);

    // delete one
    public function delete(int $id);
}
