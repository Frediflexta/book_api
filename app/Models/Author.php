<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
}
