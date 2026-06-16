<?php

namespace App\Traits;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Throwable;

trait SendsNotificationSafely
{
    /**
     * Kirim notifikasi hanya jika email penerima valid dan real.
     * Skip tanpa error jika email fake (.test, .local, .invalid, dll).
     */
    protected function notifySafely(object $notifiable, Notification $notification): void
    {
        $email = $notifiable->email ?? null;

        if (!$email || !$this->isRealEmail($email)) {
            Log::info('Notification skipped: fake or invalid email', [
                'email' => $email,
                'notification' => class_basename($notification),
            ]);
            return;
        }

        try {
            $notifiable->notify($notification);
        } catch (Throwable $e) {
            // Jangan crash aplikasi hanya karena notifikasi gagal
            Log::warning('Notification failed to send', [
                'email'        => $email,
                'notification' => class_basename($notification),
                'error'        => $e->getMessage(),
            ]);
        }
    }

    /**
     * Cek apakah email menggunakan domain real (bukan fake/testing).
     */
    private function isRealEmail(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $fakeTlds = ['.test', '.local', '.invalid', '.localhost', '.example', '.internal'];
        foreach ($fakeTlds as $tld) {
            if (str_ends_with(strtolower($email), $tld)) {
                return false;
            }
        }

        return true;
    }
}
