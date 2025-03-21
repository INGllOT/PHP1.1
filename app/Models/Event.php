<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
  
    protected $fillable = ['title', 'description', 'place', 'ticket_price', 'ticket_quantity', 'event_date', 'ticket_start_date', 'ticket_end_date', 'category', 'user_id'];
    
}
 