<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }
}
