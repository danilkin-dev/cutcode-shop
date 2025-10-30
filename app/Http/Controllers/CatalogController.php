<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function __invoke(?Category $category): View
    {
        $brands = Brand::query()
            ->select(['id', 'title'])
            ->has('products')
            ->get();

        $categories = Category::query()
            ->select(['id', 'title', 'slug'])
            ->has('products')
            ->get();

        $products = Product::search(request('search'))
            ->query(function (Builder $query) use ($category) {
                $query->select(['id', 'title', 'slug', 'price', 'thumbnail'])
                    ->when($category->exists, function (Builder $query) use ($category) {
                        $query->whereRelation(
                            'categories',
                            'categories.id',
                            '=',
                            $category->id
                        );
                    })
                    ->filtered()
                    ->sorted();
            })
            ->paginate(6);

        return view('catalog.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'category' => $category,
        ]);
    }
}
