<?php

namespace App\View\ViewModels;

use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class CatalogViewModel extends ViewModel
{
    public function __construct(
        public Category $category,
    ) {
    }

    public function categories(): Collection|array
    {
        return Category::query()
            ->select(['id', 'title', 'slug'])
            ->has('products')
            ->get();
    }

    public function products(): LengthAwarePaginator
    {
        return Product::search(request('search'))
            ->query(function (Builder $query) {
                $query->select(['id', 'title', 'slug', 'price', 'thumbnail', 'json_properties'])
                    ->withCategory($this->category)
                    ->filtered()
                    ->sorted();
            })
            ->paginate(6);
    }
}
