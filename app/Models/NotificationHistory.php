<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationHistory extends Model
{
    use HasFactory, HasUuids;
    
    protected $fillable = [
        'contact_id',
        'notification',
        'channel',
    ];

    protected $table = 'notification_history';

    /**
     * Get the contact that owns the notification history.
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(related: Contact::class, foreignKey: 'contact_id', ownerKey: 'id');
    }
}
