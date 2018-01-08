<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTitle extends Model
{
    protected $fillable = [
        'category_id',
        'language_id',
        'name',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }
}
