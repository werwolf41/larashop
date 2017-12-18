<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Category extends Model
{
    use Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'parent', 'image', 'active'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'active' => 'bollean',
    ];
}
