<?php

namespace Domain\Order\Processes;

use Domain\Order\Contacts\OrderProcessContract;
use Domain\Order\Exceptions\OrderProcessException;
use Domain\Order\Models\Order;

final class CheckOrderQuantities implements OrderProcessContract
{
    public function handle(Order $order, $next)
    {
        foreach (cart()->items() as $item) {
            if ($item->product->quantity < $item->quantity) {
                throw new OrderProcessException('Не осталось товаров');
            }
        }

        return $next($order);
    }
}
