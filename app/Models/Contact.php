<?php

namespace App\Models;

use App\Events\ContactCreated;
use App\Traits\HasNotificationHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory, HasUuids, Notifiable, HasNotificationHistory;
    
    protected $fillable = [
        'id',
        'username',
        'email'
    ];

    protected $dispatchesEvents = [
        'created' => ContactCreated::class,
    ];
}
