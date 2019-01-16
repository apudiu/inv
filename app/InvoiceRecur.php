<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceRecur extends Model
{
    protected $attributes = [
        'id', 'invoice_id', 'start_date', 'end_date',
        'interval', // in days
        'enabled', 'created_at', 'updated_at'
    ];

    /*******************
     * Relationships
     ******************/

    // belongs to invoice
    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
