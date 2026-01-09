<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Illuminate\View\View;

final class NavigationComposer
{
    public function compose(View $view): void
    {
        if (request()->is('admin*')) {
            return;
        }

        $menu = Menu::make()
            ->add(MenuItem::make(route('home'), 'Главная'))
            ->add(MenuItem::make(route('catalog'), 'Каталог'))
            ->add(MenuItem::make(route('cart'), 'Корзина'));

        $view->with('menu', $menu);
    }
}
