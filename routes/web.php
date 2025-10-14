<?php

use App\Services\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:web'])->group(function () {
    Route::get('/', function () {
        throw new TelegramBotApiException('123');
        return view('welcome');
    });
});
