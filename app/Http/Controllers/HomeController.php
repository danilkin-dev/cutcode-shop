<?php

namespace App\Http\Controllers;

use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Domain\Product\ViewModels\ProductViewModel;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $categories = CategoryViewModel::make()
            ->homePage();

        $products = ProductViewModel::make()
            ->homePage();

        $brands = BrandViewModel::make()
            ->homePage();

        return view('index', compact(
            'categories',
            'products',
            'brands'
        ));
    }
}
