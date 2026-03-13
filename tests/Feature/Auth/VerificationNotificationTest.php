<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    Notification::fake();
});

test('sends verification notification', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->post(route('verification.send'))
        ->assertRedirect(route('home'));

    Notification::assertSentTo($user, VerifyEmail::class);
});

test('does not send verification notification if email is verified', function () {
    $user = User::factory()->create();

    Notification::fake();

    $this->actingAs($user)
        ->post(route('verification.send'))
        ->assertRedirect(route('home', absolute: false));

    Notification::assertNothingSent();
});
