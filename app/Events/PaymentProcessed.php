<?php

// Declare the namespace for the PaymentProcessed event
namespace App\Events;

// Import the Order model class from the App\Models namespace
use App\Models\Order;

// Import the SerializesModels trait from the Illuminate\Queue namespace
use Illuminate\Queue\SerializesModels;

// Define the PaymentProcessed event class
class PaymentProcessed
{
    // Include the SerializesModels trait for serialization of the model
    use SerializesModels;

    // Public property to hold the order instance
    public $order;

    /**
     * Constructor method to initialize the PaymentProcessed event object.
     *
     * @param Order $order The Order model instance associated with the event.
     */
    public function __construct(Order $order)
    {
        // Set the order property
        $this->order = $order;
    }
}
