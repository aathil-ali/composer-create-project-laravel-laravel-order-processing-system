<?php

// Declare the namespace for the OrderFulfillmentPipeline class
namespace App\Pipelines;

// Import necessary classes
use App\Models\Order;

// Define the OrderFulfillmentPipeline class which implements FulfillmentPipelineInterface
class OrderFulfillmentPipeline implements FulfillmentPipelineInterface
{
    /**
     * Handle the order fulfillment process.
     *
     * @param Order $order The order instance to be fulfilled.
     * @return Order The updated order instance after fulfillment.
     */
    public function handle(Order $order)
    {
        // Stage 1: Validate order
        $order = $this->validateOrder($order);

        // Stage 2: Process order
        $order = $this->processOrder($order);

        // Stage 3: Ship order
        $this->shipOrder($order);

        // Return the updated order instance after fulfillment
        return $order;
    }

    /**
     * Validate the order.
     *
     * @param Order $order The order instance to be validated.
     * @return Order The updated order instance after validation.
     */
    protected function validateOrder(Order $order)
    {
        // Example validation logic
        if (!$order->is_validated) {
            // Perform validation tasks
            $order->is_validated = true;
            $order->save();
        }

        // Return the updated order instance after validation
        return $order;
    }

    /**
     * Process the order.
     *
     * @param Order $order The order instance to be processed.
     * @return Order The updated order instance after processing.
     */
    protected function processOrder(Order $order)
    {
        // Example processing logic
        if (!$order->is_processed) {
            // Perform processing tasks
            $order->is_processed = true;
            $order->save();
        }

        // Return the updated order instance after processing
        return $order;
    }

    /**
     * Ship the order.
     *
     * @param Order $order The order instance to be shipped.
     */
    protected function shipOrder(Order $order)
    {
        // Example shipping logic
        if (!$order->is_shipped) {
            // Perform shipping tasks
            $order->is_shipped = true;
            $order->save();
        }
    }
}
