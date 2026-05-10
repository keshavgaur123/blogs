<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];

    /*
    |-----------------------------------
    | PARENT CATEGORY (self relation)
    |-----------------------------------
    */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /*
    |-----------------------------------
    | CHILD CATEGORIES
    |-----------------------------------
    */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /*
    |-----------------------------------
    | OPTIONAL: recursive children (tree view support)
    |-----------------------------------
    */
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    /*
    |-----------------------------------
    | OPTIONAL: auto-load parent + children
    |-----------------------------------
    */
    protected $with = ['parent'];
}
