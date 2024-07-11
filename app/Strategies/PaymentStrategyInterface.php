<?php

namespace App\Strategies;

// Import necessary classes
use App\Models\Order;

// Define the PaymentStrategyInterface interface
interface PaymentStrategyInterface
{
    /**
     * Process payment for the given order.
     *
     * @param Order $order The order instance for which to process payment.
     * @return mixed The result of the payment processing.
     */
    public function pay(Order $order);
}
