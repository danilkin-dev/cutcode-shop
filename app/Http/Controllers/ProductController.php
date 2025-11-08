<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __invoke(Product $product): View
    {
        $product->load('optionValues.option');

        $viewedProducts = collect();

        if (session('viewed_products')) {
            $viewedProducts = Product::query()
                ->whereIn('id', session('viewed_products'))
                ->where('id', '!=', $product->id)
                ->limit(10)
                ->get();
        }

        $options = $product->optionValues->mapToGroups(function ($item) {
            return [$item->option->title => $item];
        });

        session()->put('viewed_products.' . $product->id, $product->id);

        return view('product.show', [
            'product' => $product,
            'options' => $options,
            'viewedProducts' => $viewedProducts,
        ]);
    }
}
