<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Product\Pages;

use App\MoonShine\Resources\Brand\BrandResource;
use App\MoonShine\Resources\Product\ProductResource;
use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use Throwable;

/**
 * @extends FormPage<ProductResource>
 */
class ProductFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),

            BelongsTo::make(
                __('moonshine::ui.resource.brand'),
                'brand',
                formatted: static fn (Brand $model) => $model->title,
                resource: BrandResource::class,
            )
                ->creatable()
                ->valuesQuery(static fn (Builder $q) => $q->select(['id', 'title'])),

                Flex::make([
                    Text::make(__('moonshine::ui.resource.title'), 'title')
                        ->required(),

                    Slug::make(__('moonshine::ui.resource.slug'), 'slug')
                        ->required(),

                    Text::make(__('moonshine::ui.resource.text'), 'text'),

                    Text::make(__('moonshine::ui.resource.price'), column: 'price'),

                    Number::make(__('moonshine::ui.resource.quantity'), 'quantity'),
                ]),

                Image::make(__('moonshine::ui.resource.thumbnail'), 'thumbnail')
                    ->disk('images')
                    ->dir('products'),

                Number::make(__('moonshine::ui.resource.sorting'), 'sorting')
                    ->default(0),

                Checkbox::make(__('moonshine::ui.resource.on_home_page'), 'on_home_page'),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [];
    }

    /**
     * @param FormBuilder $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer(),
        ];
    }
}
