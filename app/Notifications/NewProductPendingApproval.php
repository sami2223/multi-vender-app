<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductPendingApproval extends Notification implements ShouldQueue
{
  use Queueable;

  public function __construct(public Product $product) {}

  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->subject('New product pending approval')
      ->line('A new product has been created and is pending approval:')
      ->line('Product: ' . $this->product->name . ' (' . $this->product->code . ')')
      ->action('View Admin Panel', url('/admin/products'));
  }
}
