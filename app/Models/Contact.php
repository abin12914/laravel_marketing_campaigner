<?php

namespace App\Models;

use App\Events\ContactCreated;
use App\Traits\HasNotificationHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory, HasUlids, Notifiable, HasNotificationHistory;
    
    protected $fillable = [
        'username',
        'email'
    ];

    protected $dispatchesEvents = [
        'created' => ContactCreated::class,
    ];
}
