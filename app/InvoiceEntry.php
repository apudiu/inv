<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceEntry extends Model
{
    protected $attributes = [
        'id', 'invoice_id', 'price', 'qty',
        'qt_type', // enum (hours, days, services, products, others)
        'description', 'created_at', 'updated_at'
    ];

    /*******************
     * Relationships
     ******************/

    // belongs to invoice
    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
