<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:15 PM
 */

namespace App\Repositories\Client;


interface ClientInterface
{
    // get all clients
    public function getAll();

    // get a client by id
    public function getById(int $id);

    // create a client
    public function create(array $attributes);

    // update a client
    public function update(int $id, array $attributes);

    // delete a client
    public function delete(int $id);
}
