<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    
    protected $fillable = [
        'user_id',
        'event_id',
        'name',
        'email',
        'ticket_quantity',
        'event_name',
        'event_description',
        'event_place',
        'ticket_price',
        'event_date'
    ];

}
