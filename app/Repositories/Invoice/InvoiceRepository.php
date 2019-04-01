<?php
/**
 * Created by PhpStorm.
 * User: Apu
 * Date: 1/16/2019
 * Time: 3:24 PM
 */

namespace App\Repositories\Invoice;


use App\Invoice;
use DB;

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
     * @param array $with pull listed relations too
     * @return Invoice[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll(array $with=[])
    {
        return $this->invoice->with($with)->get();
    }

    /**
     * Get one by id
     * @param int $id
     * @param array $with list of relations to eager load
     * @return mixed
     */
    public function getById(int $id, array $with=[])
    {
        return $this->invoice->with($with)->findOrFail($id);
    }

    /**
     * Get all persons
     * @param int $clientId
     * @return Invoice[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllByClient(int $clientId)
    {
        return $this->invoice->where('client_id', $clientId)->get();
    }

    /**
     * Create one
     * @param array $invoiceData
     * @param array $entryData
     * @return mixed
     * @throws \Throwable
     */
    public function create(array $invoiceData, $entryData)
    {
        // getting (& removing) persons data from invoice data
        $invPersons = array_pull($invoiceData, 'contact');

        // using transaction for safety as it will insert data in multiple table
        $inv = DB::transaction(function () use ($invoiceData, $entryData, $invPersons) {

            // creating invoice
            $invoice = $this->invoice->create($invoiceData);

            // adding necessary fields to each invoice entries
            $entryData = array_map(function ($item) use($invoice) {

                // adding invoice_id to each entry
                $item['invoice_id'] = $invoice->id;

                return $item;

            }, $entryData);


            // deleting hardcoded indexes
            $entryData = array_values($entryData);

            // saving invoice entries
            $entries = $invoice->entries()->createMany($entryData);

            // saving invoice (client) contact persons
            $persons = $invoice->persons()->sync($invPersons);

            return [
                'invoice' => $invoice,
                'entries' => $entries,
                'persons' => $persons,
            ];
        });

        return $inv['invoice'];
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
