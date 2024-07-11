<?php

namespace App\Strategies;

// Import necessary classes
use App\Models\Order;
use App\Events\PaymentProcessed;

// Define the PaypalPaymentStrategy class implementing PaymentStrategyInterface
class PaypalPaymentStrategy implements PaymentStrategyInterface
{
    /**
     * Process payment using PayPal for the given order.
     *
     * @param Order $order The order instance for which to process payment.
     * @return void
     */
    public function pay(Order $order)
    {
        // Implement PayPal payment logic
        $order->status = 'paid'; // Set order status to 'paid'
        $order->save(); // Save the updated order status

        // Dispatch the PaymentProcessed event
        event(new PaymentProcessed($order));
    }
}
