<?php
namespace App\Traits;

use App\Models\NotificationHistory;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasNotificationHistory {
    /**
     * Get the notification history for the notifiable.
     */
    public function notificationHistory(): HasMany
    {
        return $this->hasMany(NotificationHistory::class);
    }
}