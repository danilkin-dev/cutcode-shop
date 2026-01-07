<?php

namespace Domain\Order\Contacts;

use Domain\Order\Models\Order;

interface OrderProcessContract
{
    public function handle(Order $order, $next);
}
