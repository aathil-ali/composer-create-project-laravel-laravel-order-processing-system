<?php

// Declare the namespace for the OrderFactory class
namespace App\Factories;

// Import the Order model class from the App\Models namespace
use App\Models\Order;

// Import the OrderDTO class from the App\DTOs namespace
use App\DTOs\OrderDTO;

// Define the OrderFactory class
class OrderFactory
{
    /**
     * Static method to create a new Order instance from an OrderDTO.
     *
     * @param OrderDTO $orderDTO The data transfer object containing order data.
     * @return Order The newly created Order model instance.
     */
    public static function create(OrderDTO $orderDTO)
    {
        // Return a new Order instance, initializing it with data from the OrderDTO
        return new Order([
            'user_id' => $orderDTO->userId, // Set the user_id from the OrderDTO's userId property
            'status' => 'pending',          // Set the status to 'pending' by default
            'total' => 0                    // Initialize the total to 0 by default
        ]);
    }
}
