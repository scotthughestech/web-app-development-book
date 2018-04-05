<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * Get the user that owns the organization.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
