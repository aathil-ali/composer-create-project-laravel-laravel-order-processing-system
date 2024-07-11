<?php

// Specify the namespace for the PaymentService class
namespace App\Services;

// Import necessary classes
use App\Strategies\PaymentStrategyInterface;
use App\Models\Order;

// Define the PaymentService class
class PaymentService
{
    protected $paymentStrategy;

    /**
     * Constructor for PaymentService class.
     *
     * @param PaymentStrategyInterface $paymentStrategy The payment strategy to use.
     */
    public function __construct(PaymentStrategyInterface $paymentStrategy)
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    /**
     * Process payment for an order using the injected payment strategy.
     *
     * @param Order $order The order instance for which to process payment.
     * @return mixed The result of the payment processing.
     */
    public function processPayment(Order $order)
    {
        // Delegate payment processing to the injected payment strategy
        return $this->paymentStrategy->pay($order);
    }
}
