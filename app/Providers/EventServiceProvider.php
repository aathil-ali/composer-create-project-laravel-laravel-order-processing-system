<?php 

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\OrderCreated::class => [
            \App\Listeners\UpdateInventory::class,
            \App\Listeners\SendOrderConfirmation::class,
        ],
        \App\Events\PaymentProcessed::class => [
            \App\Listeners\UpdateOrderStatus::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}