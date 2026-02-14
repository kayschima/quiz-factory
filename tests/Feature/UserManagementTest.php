<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;

test('users index is forbidden without delete users permission', function () {
    $user = User::factory()->create();
    $user->assignRole('user');

    actingAs($user)
        ->get(route('users.index'))
        ->assertForbidden();
});

test('users index is available with delete users permission', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $managedUser = User::factory()->create();
    $managedUser->assignRole('user');

    actingAs($admin)
        ->get(route('users.index'))
        ->assertSuccessful()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Users/Index')
            ->where('users.data', fn ($users) => collect($users)->contains('email', $managedUser->email))
        );
});

test('authorized user can update user data and roles', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $managedUser = User::factory()->create([
        'name' => 'Old Name',
        'email' => 'old@example.com',
    ]);
    $managedUser->assignRole('user');

    actingAs($admin)
        ->put(route('users.update', $managedUser), [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'roles' => ['editor'],
        ])
        ->assertRedirect(route('users.index'));

    $managedUser->refresh();

    expect($managedUser->name)->toBe('New Name');
    expect($managedUser->email)->toBe('new@example.com');
    expect($managedUser->hasRole('editor'))->toBeTrue();
    expect($managedUser->hasRole('user'))->toBeFalse();
});

test('authorized user can delete a user', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $managedUser = User::factory()->create();
    $managedUser->assignRole('user');

    actingAs($admin)
        ->delete(route('users.destroy', $managedUser))
        ->assertRedirect(route('users.index'));

    expect(User::query()->whereKey($managedUser->id)->exists())->toBeFalse();
});

test('edit, update and delete are forbidden without delete users permission', function () {
    $user = User::factory()->create();
    $user->assignRole('user');

    $managedUser = User::factory()->create();
    $managedUser->assignRole('user');

    actingAs($user)
        ->get(route('users.edit', $managedUser))
        ->assertForbidden();

    actingAs($user)
        ->put(route('users.update', $managedUser), [
            'name' => 'Blocked',
            'email' => 'blocked@example.com',
            'roles' => ['user'],
        ])
        ->assertForbidden();

    actingAs($user)
        ->delete(route('users.destroy', $managedUser))
        ->assertForbidden();
});
