<?php

namespace Lpf\Domains\Location;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /* Relationships */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
