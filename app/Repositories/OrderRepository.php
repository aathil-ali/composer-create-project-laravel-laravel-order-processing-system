<?php

// Declare the namespace for the OrderRepository class
namespace App\Repositories;

// Import necessary classes
use App\Models\Order;

// Define the OrderRepository class
class OrderRepository
{
    /**
     * Save an order instance.
     *
     * @param Order $order The order instance to be saved.
     * @return void
     */
    public function save(Order $order)
    {
        // Save the order instance
        $order->save();
    }

    /**
     * Find an order by its ID.
     *
     * @param int $id The ID of the order to find.
     * @return Order|null The found order instance, or null if not found.
     */
    public function find($id)
    {
        // Find and return the order by its ID
        return Order::find($id);
    }
}
