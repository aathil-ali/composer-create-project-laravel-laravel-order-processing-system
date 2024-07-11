<?php

// Declare the namespace for the InvoiceServiceInterface
namespace App\Services;

// Import necessary classes
use App\Models\Order;

// Define the InvoiceServiceInterface interface
interface InvoiceServiceInterface
{
    /**
     * Generate an invoice for an order.
     *
     * @param Order $order The order instance for which to generate the invoice.
     * @return void
     */
    public function generateInvoice(Order $order);
}
