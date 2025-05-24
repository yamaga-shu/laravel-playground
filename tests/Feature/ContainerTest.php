<?php

use Illuminate\Container\Container;

it("resolves a bound class each time with bind()", function () {
    $container = new Container();

    $container->bind("example", fn() => new stdClass());

    $a = $container->make("example");
    $b = $container->make("example");

    expect($a)->not()->toBe($b); // 別インスタンス
});

it("resolves a singleton class only once", function () {
    $container = new Container();

    $container->singleton("example", fn() => new stdClass());

    $a = $container->make("example");
    $b = $container->make("example");

    expect($a)->toBe($b); // 同一インスタンス
});
