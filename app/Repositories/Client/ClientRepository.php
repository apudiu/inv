<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:24 PM
 */

namespace App\Repositories\Client;


use App\Client;

class ClientRepository implements ClientInterface
{
    // Model (resolved by IoC)
    private $client;


    public function __construct(Client $client)
    {
        // Getting model using Laravel service container (IoC container)
        $this->client = $client;
    }

    /**
     * Get all clients
     * @return Client[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->client->all();
    }

    /**
     * Get client by id
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->client->findOrFail($id);
    }

    /**
     * Create client
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->client->create($attributes);
    }

    /**
     * Update client
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->getById($id)->update($attributes);
    }

    /**
     * Delete client
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->getById($id)->delete();
    }
}
