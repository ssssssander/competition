<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'address', 'city', 'email'];

    public function votes() {
        return $this->hasMany('App\Vote');
    }
}
