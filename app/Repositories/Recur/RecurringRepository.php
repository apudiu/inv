<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:24 PM
 */

namespace App\Repositories\Recur;


use App\InvoiceRecur;

class RecurringRepository implements RecurringInterface
{
    // Model (resolved by IoC)
    private $recur;


    public function __construct(InvoiceRecur $recur)
    {
        // Getting model using Laravel service container (IoC container)
        $this->recur = $recur;
    }

    /**
     * Get all
     * @param array $with pull listed relations too
     * @return InvoiceRecur[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll(array $with=[])
    {
        return $this->recur->with($with)->get();
    }

    /**
     * Get one by id
     * @param int $id
     * @param array $with list of relations to eager load
     * @return mixed
     */
    public function getById(int $id, array $with=[])
    {
        return $this->recur->with($with)->findOrFail($id);
    }

    /**
     * Create one
     * @param array $recurData
     * @return mixed
     * @throws \Throwable
     */
    public function create(array $recurData)
    {
        return $this->recur->create($recurData);
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
