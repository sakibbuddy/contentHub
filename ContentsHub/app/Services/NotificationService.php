<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Send a notification to a user.
     */
    public function sendToUser(User $user, string $type, string $message, array $data = []): Notification
    {
        return $user->notifications()->create([
            'type' => $type,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(Notification $notification): void
    {
        $notification->update(['read_at' => now()]);
    }

    /**
     * Mark all notifications as read for a user.
     */
    public function markAllAsRead(User $user): void
    {
        $user->notifications()->whereNull('read_at')->update(['read_at' => now()]);
    }
}
