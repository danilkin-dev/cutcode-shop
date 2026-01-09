<?php

namespace Database\Seeders;

use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\OptionFactory;
use Database\Factories\OptionValueFactory;
use Database\Factories\ProductFactory;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use MoonShine\Laravel\Models\MoonshineUser;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->isLocal()) {
            MoonshineUser::updateOrCreate(
                ['email' => 'admin@dev.ru'],
                [
                    'moonshine_user_role_id' => 1,
                    'name' => 'admin',
                    'password' => Hash::make('admin'),
                ]
            );
        }

        BrandFactory::new()->count(20)
            ->create();

        $properties = PropertyFactory::new()->count(10)->create();

        OptionFactory::new()->count(2)->create();

        $optionValues = OptionValueFactory::new()->count(10)->create();

        CategoryFactory::new()->count(count: 10)
            ->has(
                ProductFactory::new()
                    ->count(rand(5, 15))
                    ->hasAttached($optionValues)
                    ->hasAttached($properties, function () {
                        return ['value' => ucfirst(fake()->word())];
                    })
            )
            ->create();
    }
}
