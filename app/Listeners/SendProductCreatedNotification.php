<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Models\User;
use App\Notifications\NewProductPendingApproval;

class SendProductCreatedNotification
{
  public function handle(ProductCreated $event): void
  {
    $admins = User::query()->where('role', 'admin')->get();
    foreach ($admins as $admin) {
      $admin->notify(new NewProductPendingApproval($event->product));
    }
  }
}
