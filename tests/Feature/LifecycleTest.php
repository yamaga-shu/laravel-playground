<?php

use Illuminate\Support\Facades\Route;

beforeEach(function () {
    // ルート定義を明示的に記述（テスト用）
    Route::get('/hello', function () {
        return 'Hello, Lifecycle!';
    });
});

it('responds to a GET request via the HTTP kernel', function () {
    $response = $this->get('/hello');

    $response->assertOk();
    $response->assertSee('Hello, Lifecycle!');
});

it('Laravel binds the correct Kernel class', function () {
    $kernel = app()->make(\Illuminate\Contracts\Http\Kernel::class);

    expect($kernel)->toBeInstanceOf(\Illuminate\Foundation\Http\Kernel::class);
});

it('can manually pass a request to the Kernel and get a response', function () {
    $kernel = app()->make(\Illuminate\Contracts\Http\Kernel::class);
    $request = Illuminate\Http\Request::create('/hello', 'GET');

    $response = $kernel->handle($request);

    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBe('Hello, Lifecycle!');
});
