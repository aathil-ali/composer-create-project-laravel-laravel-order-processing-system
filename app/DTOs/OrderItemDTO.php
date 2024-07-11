<?php

// Declare the namespace for the OrderItemDTO class
namespace App\DTOs;

// Define the OrderItemDTO class
class OrderItemDTO
{
    // Public properties to hold the product ID, quantity, and price
    public $productId;
    public $quantity;
    public $price;

    /**
     * Constructor method to initialize the OrderItemDTO object.
     *
     * @param mixed $productId The ID of the product.
     * @param mixed $quantity The quantity of the product.
     * @param mixed $price The price of the product.
     */
    public function __construct($productId, $quantity, $price)
    {
        // Set the productId property
        $this->productId = $productId;
        
        // Set the quantity property
        $this->quantity = $quantity;
        
        // Set the price property
        $this->price = $price;
    }
}
