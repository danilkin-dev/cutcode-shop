<?php

namespace Domain\Order\States;

final class CancelledOrderState extends OrderState
{
    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): string
    {
        return 'cancelled';
    }

    public function humanValue(): string
    {
        return 'Отменен';
    }
}
