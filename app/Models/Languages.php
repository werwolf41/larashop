<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Languages extends Model
{
    use Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'active', 'primary'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => 'bollean',
        'primary' => 'bollean',
    ];
}
