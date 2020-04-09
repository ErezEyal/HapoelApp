<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    protected $dateFormat = 'U';
    public $timestamps = false;
}
