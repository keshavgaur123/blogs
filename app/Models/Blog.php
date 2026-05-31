<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category_id',
        'user_id',
        'status'
    ];

    /*
    |-----------------------------------
    | CATEGORY RELATION
    |-----------------------------------
    */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /*
    |-----------------------------------
    | USER RELATION
    |-----------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
    |-----------------------------------
    | OPTIONAL: auto eager load relations
    | (useful for DataTables)
    |-----------------------------------
    */
    protected $with = ['category', 'user'];
   
}
