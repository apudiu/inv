<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
//    protected $attributes = [
//        'id', 'client_id', 'name', 'description',
//        'status', // enum (draft, partial, billed)
//        'created_at', 'updated_at'
//    ];

    protected $fillable = [
        'client_id', 'name', 'description', 'status'
    ];



    /*******************
     * Relationships
     ******************/

    // belongs to client
    public function client() {
        return $this->belongsTo(Client::class);
    }

    // has many project entries
    public function entries() {
        return $this->hasMany(ProjectEntry::class);
    }
}
