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
        'status',
        'user_id' // REQUIRED because you are assigning it in controller
    ];

    /**
     * CATEGORY RELATION
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * USER RELATION (SAFE + NO CRASH + LIMITED FIELDS)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->select('id', 'name')
            ->withDefault([
                'name' => 'Unknown'
            ]);
    }

    /**
     * IMPORTANT:
     * Avoid global eager loading (prevents over-fetching + improves performance)
     */
    protected $with = [];
}
