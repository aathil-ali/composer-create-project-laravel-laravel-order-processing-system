<?php

// Specify the namespace for the OrderService class
namespace App\Services;

// Import necessary classes
use App\DTOs\OrderDTO;
use App\Factories\OrderFactory;
use App\Repositories\OrderRepository;
use App\Events\OrderCreated;

// Define the OrderService class
class OrderService
{
    protected $orderRepository;

    /**
     * Constructor for OrderService class.
     *
     * @param OrderRepository $orderRepository The repository for orders.
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Create a new order based on the provided OrderDTO.
     *
     * @param OrderDTO $orderDTO The data transfer object containing order details.
     * @return mixed The created Order instance.
     */
    public function createOrder(OrderDTO $orderDTO)
    {
        // Create an order using the OrderFactory
        $order = OrderFactory::create($orderDTO);

        // Calculate total price of the order
        $total = 0;
        foreach ($orderDTO->items as $item) {
            // Create order items and calculate total
            $order->items()->create($item);
            $total += $item['quantity'] * $item['price'];
        }

        // Set the total price for the order
        $order->total = $total;

        // Save the order using the OrderRepository
        $this->orderRepository->save($order);

        // Dispatch the OrderCreated event
        event(new OrderCreated($order));

        // Return the created Order instance
        return $order;
    }
}
