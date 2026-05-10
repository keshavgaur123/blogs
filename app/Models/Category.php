<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];

    /*
    |-----------------------------------
    | AUTO GENERATE SLUG
    |-----------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {

            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {

            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

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
    | BLOG RELATION
    |-----------------------------------
    */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /*
    |-----------------------------------
    | OPTIONAL: auto-load parent + children
    |-----------------------------------
    */
    protected $with = ['parent'];
}