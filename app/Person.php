<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
//    protected $attributes = [
//        'id', 'client_id', 'name', 'surname', 'email', 'phone', 'designation',
//        'department', 'note', 'created_at', 'updated_at'
//    ];

    protected $fillable = [
        'client_id', 'name', 'surname', 'email', 'phone',
        'designation', 'department', 'note'
    ];

    protected $table = 'persons';


    /*******************
     * Relationships
     ******************/

    // belongs to client
    public function client() {
        return $this->belongsTo(Client::class);
    }

    // belongs to many invoices
    public function invoices() {
        return $this->belongsToMany(Invoice::class);
    }
}
