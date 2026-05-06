<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// class Category extends Model
// {
//     protected $fillable = [
//         'name',
//         'slug'
//     ];

//     // Auto-generate slug
//     protected static function boot()
//     {
//         parent::boot();

//         static::creating(function ($category) {
//             $category->slug = Str::slug($category->name);
//         });

//         static::updating(function ($category) {
//             if ($category->isDirty('name')) {
//                 $category->slug = Str::slug($category->name);
//             }
//         });
//     }
// }



class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
