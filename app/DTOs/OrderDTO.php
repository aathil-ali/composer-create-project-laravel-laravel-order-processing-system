<?php

// Declare the namespace for the OrderDTO class
namespace App\DTOs;

// Define the OrderDTO class
class OrderDTO
{
    // Public properties to hold the user ID and items
    public $userId;
    public $items;

    /**
     * Constructor method to initialize the OrderDTO object.
     *
     * @param mixed $userId The ID of the user associated with the order.
     * @param array $items An array of items in the order.
     */
    public function __construct($userId, array $items)
    {
        // Set the userId property
        $this->userId = $userId;
        
        // Set the items property
        $this->items = $items;
    }
}
