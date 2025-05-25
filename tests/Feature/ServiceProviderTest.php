<?php

use Illuminate\Support\Facades\App;
use App\Providers\ExampleServiceProvider;

it('registers services via custom provider', function () {
    // 明示的にServiceProviderを登録
    App::register(ExampleServiceProvider::class);

    $greet = App::make('greet');

    expect($greet->hello())->toBe('Hello from service provider');
});