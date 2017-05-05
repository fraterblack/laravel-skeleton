<?php

namespace Lpf\Domains\Location;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /* Relationships */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
