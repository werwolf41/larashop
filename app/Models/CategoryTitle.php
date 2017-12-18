<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoryTitle extends Model
{
    protected $fillable = [
        'category_id', 'language_id', 'name', 'description', 'meta_title', 'meta_description', 'meta_keywords',
    ];
}
