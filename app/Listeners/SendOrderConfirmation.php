<?php

// Declare the namespace for the SendOrderConfirmation listener
namespace App\Listeners;

// Import necessary classes
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Mail;

// Define the SendOrderConfirmation class
class SendOrderConfirmation
{
    /**
     * Handle the OrderCreated event.
     *
     * @param OrderCreated $event The event instance containing the order data.
     */
    public function handle(OrderCreated $event)
    {
        // Send an email notification to the user who placed the order
        Mail::to($event->order->user->email)->send(new \App\Mail\OrderConfirmation($event->order));
    }
}
