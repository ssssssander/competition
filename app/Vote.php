<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function participant() {
        return $this->belongsTo('App\Participant');
    }
}
