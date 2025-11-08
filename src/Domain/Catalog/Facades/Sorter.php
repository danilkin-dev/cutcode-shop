<?php

namespace Domain\Catalog\Facades;

use Illuminate\Support\Facades\Facade;

final class Sorter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Domain\Catalog\Sorters\Sorter::class;
    }
}
