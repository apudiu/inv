<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceRecur extends Model
{
//    protected $attributes = [
//        'id', 'invoice_id', 'start_date', 'end_date',
//        'interval', // in days
//        'enabled', 'send_invoice', 'created_at', 'updated_at'
//    ];

    protected $fillable = [
        'invoice_id', 'start_date', 'end_date',
        'interval', 'enabled', 'send_invoice'
    ];


    /*******************
     * Relationships
     ******************/

    // belongs to invoice
    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
