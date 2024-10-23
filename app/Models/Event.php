<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'start_date', 'end_date', 'category'];

    public static array $categories = [
        'History',
        'Science',
        'Sport'
    ];

}
