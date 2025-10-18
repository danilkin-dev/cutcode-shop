<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Faker\FakerImageProvider;
use Faker\Factory;
use Faker\Generator;

class TestingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        app()->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));
            return $faker;
        });
    }

    public function boot(): void
    {
        //
    }
}
