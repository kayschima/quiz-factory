<?php

use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Notification::fake();
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    Http::fake([
        'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response(['success' => true]),
    ]);

    $response = $this->post(route('register.store'), [
        'name' => 'Registration User',
        'email' => 'registration@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'cf-turnstile-response' => 'fake-token',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home', absolute: false));
});

test('registration fails without turnstile', function () {
    $response = $this->from(route('register'))->post(route('register.store'), [
        'name' => 'Registration User',
        'email' => 'registration@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors('cf-turnstile-response');
    $this->assertGuest();
});

test('registration fails when turnstile verification is invalid', function () {
    Http::fake([
        'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response(['success' => false]),
    ]);

    $response = $this->from(route('register'))->post(route('register.store'), [
        'name' => 'Registration User',
        'email' => 'registration@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'cf-turnstile-response' => 'fake-token',
    ]);

    $response->assertSessionHasErrors('cf-turnstile-response');
    $this->assertGuest();
});
