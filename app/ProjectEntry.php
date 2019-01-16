<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectEntry extends Model
{
    protected $attributes = [
        'id', 'project_id', 'rate', 'hour',
        'status', // enum (0,1)
        'description', 'created_at', 'updated_at'
    ];

    /*******************
     * Relationships
     ******************/

    // belongs to project
    public function project() {
        return $this->belongsTo(Project::class);
    }
}
