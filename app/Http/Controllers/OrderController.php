<?php

// Declare the namespace for the OrderController class
namespace App\Http\Controllers;

// Import necessary classes
use App\Models\Order;
use Illuminate\Http\Request;
use App\Pipelines\FulfillmentPipelineInterface;

// Define the OrderController class which extends the base Controller class
class OrderController extends Controller
{
    // Protected property to hold the fulfillment pipeline instance
    protected $fulfillmentPipeline;

    /**
     * Constructor method to initialize the OrderController object.
     *
     * @param FulfillmentPipelineInterface $fulfillmentPipeline The fulfillment pipeline interface instance.
     */
    public function __construct(FulfillmentPipelineInterface $fulfillmentPipeline)
    {
        // Set the fulfillmentPipeline property
        $this->fulfillmentPipeline = $fulfillmentPipeline;
    }

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View The view for the orders index.
     */
    public function index()
    {
        // Retrieve all orders for the authenticated user
        $orders = Order::where('user_id', auth()->id())->get();

        // Return the orders index view with the retrieved orders
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param int $id The ID of the order to display.
     * @return \Illuminate\View\View The view for the specific order.
     */
    public function show($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        // Return the order show view with the retrieved order
        return view('orders.show', compact('order'));
    }

    /**
     * Fulfill the specified order.
     *
     * @param int $orderId The ID of the order to fulfill.
     * @return \Illuminate\Http\RedirectResponse The redirect response to the order show view with a status message.
     */
    public function fulfillOrder($orderId)
    {
        // Find the order by ID
        $order = Order::find($orderId);

        // Process order fulfillment through the pipeline
        $this->fulfillmentPipeline->handle($order);

        // Redirect to the order show view with a success status message
        return redirect()->route('orders.show', $order->id)->with('status', 'Order fulfilled successfully!');
    }
}
