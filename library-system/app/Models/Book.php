<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = ['title', 'author', 'category_id', 'stock'];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
