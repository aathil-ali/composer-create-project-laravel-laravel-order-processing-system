<?php

namespace App\Strategies;

// Import necessary classes
use App\Models\Order;
use App\Events\PaymentProcessed;

// Define the StripePaymentStrategy class implementing PaymentStrategyInterface
class StripePaymentStrategy implements PaymentStrategyInterface
{
    /**
     * Process payment using Stripe for the given order.
     *
     * @param Order $order The order instance for which to process payment.
     * @return void
     */
    public function pay(Order $order)
    {
        // Implement Stripe payment logic
        $order->status = 'paid'; // Set order status to 'paid'
        $order->save(); // Save the updated order status

        // Dispatch the PaymentProcessed event
        event(new PaymentProcessed($order));
    }
}
