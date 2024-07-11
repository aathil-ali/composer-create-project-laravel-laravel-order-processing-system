<?php
namespace App\Pipelines;

use App\Models\Order;

interface FulfillmentPipelineInterface
{
    public function handle(Order $order);
}