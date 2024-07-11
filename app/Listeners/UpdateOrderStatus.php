<?php

// Declare the namespace for the UpdateOrderStatus listener
namespace App\Listeners;

// Import necessary classes
use App\Events\PaymentProcessed;

// Define the UpdateOrderStatus class
class UpdateOrderStatus
{
    /**
     * Handle the PaymentProcessed event.
     *
     * @param PaymentProcessed $event The event instance containing the processed order data.
     */
    public function handle(PaymentProcessed $event)
    {
        // Update the order status to 'completed'
        $event->order->status = 'completed';
        
        // Save the updated order status
        $event->order->save();
    }
}
