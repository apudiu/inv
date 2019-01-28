<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:24 PM
 */

namespace App\Repositories\Invoice;


use App\Invoice;

class InvoiceRepository implements InvoiceInterface
{
    // Model (resolved by IoC)
    private $invoice;


    public function __construct(Invoice $invoice)
    {
        // Getting model using Laravel service container (IoC container)
        $this->invoice = $invoice;
    }

    /**
     * Get all
     * @return Invoice[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->invoice->all();
    }

    /**
     * Get one by id
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->invoice->findOrFail($id);
    }

    /**
     * Create one
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->invoice->create($attributes);
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
