<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Illuminate\View\View;

final class NavigationComposer
{
    public function compose(View $view): void
    {
        $menu = Menu::make()
            ->add(MenuItem::make(route('home'), 'Главная'))
            ->add(MenuItem::make('#', 'Каталог'))
            ->add(MenuItem::make('#', 'Корзина'));

        $view->with('menu', $menu);
    }
}
