<?php

use Illuminate\Support\Facades\Http;

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    Http::fake([
        'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => true]),
    ]);

    $response = $this->post(route('register.store'), [
        'name' => 'Registration User',
        'email' => 'registration@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'g-recaptcha-response' => 'fake-token',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home', absolute: false));
});

test('registration fails without recaptcha', function () {
    $response = $this->from(route('register'))->post(route('register.store'), [
        'name' => 'Registration User',
        'email' => 'registration@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors('g-recaptcha-response');
    $this->assertGuest();
});
