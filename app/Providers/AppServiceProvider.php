<?php

// Declare the namespace for the AppServiceProvider class
namespace App\Providers;

// Import necessary classes
use Illuminate\Support\ServiceProvider;
use App\Services\InvoiceServiceInterface;
use App\Services\PDFInvoiceService;
use App\Pipelines\FulfillmentPipelineInterface;
use App\Pipelines\OrderFulfillmentPipeline;

// Define the AppServiceProvider class which extends ServiceProvider
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind InvoiceServiceInterface to PDFInvoiceService implementation
        $this->app->bind(InvoiceServiceInterface::class, function ($app) {
            return new PDFInvoiceService();
        });

        // Bind FulfillmentPipelineInterface to OrderFulfillmentPipeline implementation
        $this->app->bind(FulfillmentPipelineInterface::class, function ($app) {
            return new OrderFulfillmentPipeline();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Any bootstrapping code can be placed here
    }
}
