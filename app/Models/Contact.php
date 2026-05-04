<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Table name (optional if plural is correct)
     */
    protected $table = 'contacts';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'name',
        'email',
        'title',
        'description',
    ];
}
