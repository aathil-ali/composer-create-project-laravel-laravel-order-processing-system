<?php

// Specify the namespace for the OrderApiController class
namespace App\Http\Controllers\API;

// Import necessary classes
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Pipelines\FulfillmentPipelineInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

// Define the OrderApiController class extending Controller
class OrderApiController extends Controller
{
    protected $fulfillmentPipeline;

    /**
     * Constructor for OrderApiController class.
     *
     * @param FulfillmentPipelineInterface $fulfillmentPipeline The fulfillment pipeline to handle order processing.
     */
    public function __construct(FulfillmentPipelineInterface $fulfillmentPipeline)
    {
        $this->fulfillmentPipeline = $fulfillmentPipeline;
    }

    /**
     * Fulfill an order through the API.
     *
     * @param Request $request The HTTP request object.
     * @param int $orderId The ID of the order to fulfill.
     * @return \Illuminate\Http\JsonResponse JSON response indicating success or failure.
     */
    public function fulfillOrder(Request $request, $orderId)
    {
        try {
            // Find the order by ID or throw an exception if not found
            $order = Order::findOrFail($orderId);

            // Process order fulfillment through pipeline
            $this->fulfillmentPipeline->handle($order);

            // Return success response with order details
            return successResponse(['order' => $order], 'Order fulfilled successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            // Return error response on failure
            return errorResponse('Failed to fulfill order', Response::HTTP_INTERNAL_SERVER_ERROR, [
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Create a new order through the API.
     *
     * @param Request $request The HTTP request object containing order data.
     * @return \Illuminate\Http\JsonResponse JSON response indicating success or failure.
     */
    public function createOrder(Request $request)
    {
        try {
            // Validate incoming request data here if needed
            $order = Order::create([
                'customer_name' => $request->input('customer_name'),
                'total_amount' => $request->input('total_amount'),
                // Add other required fields based on your application logic
            ]);

            return successResponse(['order' => $order], 'Order created successfully', Response::HTTP_CREATED);
        } catch (Exception $e) {
            return errorResponse('Failed to create order', Response::HTTP_INTERNAL_SERVER_ERROR, [
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Get an order by its ID through the API.
     *
     * @param int $orderId The ID of the order to fetch.
     * @return \Illuminate\Http\JsonResponse JSON response indicating success or failure.
     */
    public function getOrder($orderId)
    {
        try {
            // Find the order by ID or throw an exception if not found
            $order = Order::findOrFail($orderId);

            return successResponse(['order' => $order], 'Order fetched successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            return errorResponse('Failed to fetch order', Response::HTTP_NOT_FOUND, [
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update an order's status through the API.
     *
     * @param Request $request The HTTP request object containing updated status.
     * @param int $orderId The ID of the order to update.
     * @return \Illuminate\Http\JsonResponse JSON response indicating success or failure.
     */
    public function updateOrderStatus(Request $request, $orderId)
    {
        try {
            // Find the order by ID or throw an exception if not found
            $order = Order::findOrFail($orderId);

            // Update order status based on request input
            $order->status = $request->input('status');
            $order->save();

            return successResponse(['order' => $order], 'Order status updated successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            return errorResponse('Failed to update order status', Response::HTTP_INTERNAL_SERVER_ERROR, [
                'message' => $e->getMessage(),
            ]);
        }
    }
}
