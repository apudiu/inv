<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
//    protected $attributes = [
//        'id', 'client_id', 'p_o_no',
//        'type', // enum (estimate, invoice)
//        'status', // enum (draft, partial, billed, accepted)
//        'created_at', 'updated_at'
//    ];

    protected $fillable = [
        'client_id', 'p_o_no', 'type', 'status'
    ];


    /*******************
     * Relationships
     ******************/

    // belongs to clients
    public function client() {
        return $this->belongsTo(Client::class);
    }

    // has many invoice entries
    public function entries() {
        return $this->hasMany(InvoiceEntry::class);
    }

    // has many contact/persons (many to many)
    public function persons() {
        return $this->belongsToMany(Person::class);
    }
}
