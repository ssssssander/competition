<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Participant extends Model
{
    use SoftDeletes, Sortable;

    protected $fillable = ['name', 'address', 'city', 'email'];
}
