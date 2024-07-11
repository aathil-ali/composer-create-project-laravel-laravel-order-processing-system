<?php

// Declare the namespace for the GenerateInvoice listener
namespace App\Listeners;

// Import necessary classes
use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\InvoiceServiceInterface;

// Define the GenerateInvoice class which implements ShouldQueue for async handling
class GenerateInvoice implements ShouldQueue
{
    // Protected property to hold the invoice service instance
    protected $invoiceService;

    /**
     * Constructor method to initialize the GenerateInvoice listener.
     *
     * @param InvoiceServiceInterface $invoiceService The invoice service interface instance.
     */
    public function __construct(InvoiceServiceInterface $invoiceService)
    {
        // Set the invoiceService property
        $this->invoiceService = $invoiceService;
    }

    /**
     * Handle the OrderCreated event.
     *
     * @param OrderCreated $event The event instance containing the order data.
     */
    public function handle(OrderCreated $event)
    {
        // Generate an invoice using the invoice service for the order in the event
        $this->invoiceService->generateInvoice($event->order);
    }
}
