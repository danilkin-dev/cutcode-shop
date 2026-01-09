<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Product;

use App\MoonShine\Resources\Product\Pages\ProductFormPage;
use App\MoonShine\Resources\Product\Pages\ProductIndexPage;
use Domain\Product\Models\Product;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\Icon;

/**
 * @extends ModelResource<Product, ProductIndexPage, ProductFormPage>
 */
#[Icon('cube')]
#[Group('moonshine::ui.resource.shop', 's.building-storefront', translatable: true)]
#[Order(0)]
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $column = 'title';

    protected string $sortColumn = 'sorting';

    protected array $with = ['brand'];

    public function getTitle(): string
    {
        return __('moonshine::ui.resource.products_title');
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ProductIndexPage::class,
            ProductFormPage::class,
        ];
    }

    protected function search(): array
    {
        return [
            'id',
            'title',
        ];
    }
}
