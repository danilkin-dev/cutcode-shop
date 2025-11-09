<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductJsonProperties implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    public function __construct(
        public Product $product
    ) {
    }

    public function handle(): void
    {
        $properties = $this->product->properties
            ->mapWithKeys(fn ($property) => [$property->title => $property->pivot->value]);

        $this->product->updateQuietly(['json_properties' => $properties]);
    }

    public function uniqueId(): mixed
    {
        return $this->product->getKey();
    }
}
