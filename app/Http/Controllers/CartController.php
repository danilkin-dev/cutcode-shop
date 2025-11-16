<?php

namespace App\Http\Controllers;

use Domain\Cart\Facades\CartManager;
use Domain\Cart\Models\CartItem;
use Domain\Product\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view('cart.index', [
            'items' => CartManager::items(),
        ]);
    }

    public function add(Product $product): RedirectResponse
    {
        CartManager::add(
            $product,
            request('quantity', 1),
            request('options', [])
        );

        flash()->info('Товар добавлен в корзину');

        return redirect()
            ->intended(route('cart'));
    }

    public function quantity(CartItem $item): RedirectResponse
    {
        CartManager::quantity($item, request('quantity', 1));

        flash()->info('Кол-во товаров изменено');

        return redirect()
            ->intended(route('cart'));
    }

    public function delete(CartItem $item): RedirectResponse
    {
        CartManager::delete($item);

        flash()->info('Удалено из корзины');

        return redirect()
            ->intended(route('cart'));
    }

    public function truncate(): RedirectResponse
    {
        CartManager::truncate();

        flash()->info('Корзина очищена');

        return redirect()
            ->intended(route('cart'));
    }
}
