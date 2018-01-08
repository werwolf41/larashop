<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        'slug',
        'parent',
        'image',
        'active'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'active' => 'bollean',
    ];

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = []){
        return parent::save($options);
    }
    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent')->with('subCategory')->with('parent')->with('titles');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent')->with('parent')->with('titles');
    }

    public function titles()
    {
        $lang = Languages::select('id')->where('primary', '=', 1)->first();

        return $this->hasMany(CategoryTitle::class, 'category_id', 'id')->where('language_id', '=', $lang->id);
    }

    private function beforeSave(){
        if(!$this->id){
            DB::table($this->table)
                ->where('left_key','>',$this->parent->right_key)
                ->increment('left_key', 2)
                ->increment('right_key', 2);

            DB::table($this->table)
                ->where([['right_key','>=',$this->parent->right_key], ['left_key', '<', $this->parent->right_key]])
                ->increment('left_key', 2)
                ->increment('right_key', 2);
        }
    }
}
