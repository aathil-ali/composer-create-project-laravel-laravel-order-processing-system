<?php

// Declare the namespace for the UpdateInventory listener
namespace App\Listeners;

// Import necessary classes
use App\Events\OrderCreated;

// Define the UpdateInventory class
class UpdateInventory
{
    /**
     * Handle the OrderCreated event.
     *
     * @param OrderCreated $event The event instance containing the order data.
     */
    public function handle(OrderCreated $event)
    {
        // Loop through each item in the order
        foreach ($event->order->items as $item) {
            // Retrieve the product associated with the item
            $product = $item->product;
            
            // Decrease the product's stock by the quantity ordered
            $product->stock -= $item->quantity;
            
            // Save the updated product stock
            $product->save();
        }
    }
}
