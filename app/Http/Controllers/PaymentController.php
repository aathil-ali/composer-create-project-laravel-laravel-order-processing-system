<?php

// Declare the namespace for the ProductController class
namespace App\Http\Controllers;

// Import necessary classes
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\PaymentService;
use App\Strategies\PaypalPaymentStrategy;
use App\Strategies\StripePaymentStrategy;

// Define the ProductController class which extends the base Controller class
class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View The view for the products index.
     */
    public function index()
    {
        // Retrieve all products
        $products = Product::all();

        // Return the products index view with the retrieved products
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View The view for creating a product.
     */
    public function create()
    {
        // Return the products create view
        return view('products.create');
    }

    /**
     * Store a newly created product in the database.
     *
     * @param \Illuminate\Http\Request $request The request object containing the form data.
     * @return \Illuminate\Http\RedirectResponse The redirect response to the products index.
     */
    public function store(Request $request)
    {
        // Create a new product with the request data
        Product::create($request->all());

        // Redirect to the products index
        return redirect()->route('products.index');
    }

    /**
     * Process the payment for a specific order.
     *
     * @param \Illuminate\Http\Request $request The request object containing the payment data.
     * @param int $orderId The ID of the order to process payment for.
     * @return \Illuminate\Http\RedirectResponse The redirect response to the order show view with a status message.
     * @throws \Exception if the payment method is invalid.
     */
    public function process(Request $request, $orderId)
    {
        // Find the order by ID
        $order = Order::find($orderId);

        // Get the payment method from the request
        $paymentMethod = $request->input('payment_method');

        // Determine the payment strategy based on the payment method
        switch ($paymentMethod) {
            case 'paypal':
                $paymentService = new PaymentService(new PaypalPaymentStrategy());
                break;
            case 'stripe':
                $paymentService = new PaymentService(new StripePaymentStrategy());
                break;
            default:
                throw new \Exception('Invalid payment method'); // Throw an exception if the payment method is invalid
        }

        // Process the payment using the selected payment service
        $paymentService->processPayment($order);

        // Redirect to the order show view with a success status message
        return redirect()->route('orders.show', $order->id)->with('status', 'Payment processed successfully!');
    }
}
