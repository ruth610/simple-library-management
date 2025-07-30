<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    //
    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'returned_at'];
    
    protected $casts = [
    'borrowed_at' => 'datetime',
    'returned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
