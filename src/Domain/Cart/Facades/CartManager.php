<?php

namespace Domain\Cart\Facades;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Builder run(Builder $query)
 *
 * @see /Domain/Cart
 */
final class CartManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Domain\Cart\CartManager::class;
    }
}
