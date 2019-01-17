<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
//    protected $attributes = [
//        'id', 'name', 'city', 'address', 'tax_id', 'zip',
//        'note', 'image', 'created_at', 'updated_at'
//    ];

    // mass assignable attrs
    protected $fillable = [
        'name', 'city', 'address', 'tax_id', 'zip', 'note', 'image'
    ];



    /*******************
     * Relationships
     ******************/

    // clients will be having many invoices
    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    // clients will be having many projects
    public function projects() {
        return $this->hasMany(Project::class);
    }

    // clients will be having many (contact) persons
    public function persons() {
        return $this->hasMany(Person::class);
    }
}
