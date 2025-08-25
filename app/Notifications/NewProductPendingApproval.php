<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewProductPendingApproval extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Product $product) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New product pending approval')
            ->greeting('Hello Admin,')
            ->line("A new product has been submitted by {$this->product->user->name}.")
            ->line("Product: {$this->product->name} ({$this->product->code})")
            ->action('Review Products', url('/admin/products'))
            ->line('Thanks!');
    }
}
