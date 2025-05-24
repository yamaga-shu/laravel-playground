<?php

use Illuminate\Container\Container;

/**
 * ====================
 */
class Engine {
    public function type(): string {
        return 'V8';
    }
}

class Car {
    public function __construct(public Engine $engine) {}
}

it('resolves dependencies automatically via constructor', function () {
    $container = new Container();

    $car = $container->make(Car::class);

    expect($car->engine->type())->toBe('V8');
});

/**
 * ====================
 */
interface Notifier {
    public function notify(): string;
}

class EmailNotifier implements Notifier {
    public function notify(): string {
        return 'sent email';
    }
}

it('resolves interface to bound implementation', function () {
    $container = new Container();

    $container->bind(Notifier::class, EmailNotifier::class);

    $notifier = $container->make(Notifier::class);

    expect($notifier->notify())->toBe('sent email');
});

/**
 * ====================
 */
class SmsNotifier implements Notifier {
    public function notify(): string {
        return 'sent sms';
    }
}

class NotificationService {
    public function __construct(public Notifier $notifier) {}
}

it('can contextually bind a notifier implementation', function () {
    $container = new Container();

    $container->when(NotificationService::class)
              ->needs(Notifier::class)
              ->give(SmsNotifier::class);

    $service = $container->make(NotificationService::class);

    expect($service->notifier)->toBeInstanceOf(SmsNotifier::class);
});
