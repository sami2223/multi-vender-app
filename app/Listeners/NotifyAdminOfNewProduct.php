<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Models\User;
use App\Notifications\NewProductPendingApproval;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminOfNewProduct implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ProductCreated $event): void
    {
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewProductPendingApproval($event->product));
        }
    }
}
