<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class UserService
{
    /**
     * Get paginated users with their roles.
     */
    public function getPaginatedUsers(int $perPage = 10): LengthAwarePaginator
    {
        return User::query()
            ->with('roles')
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Get all available roles.
     *
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return Role::query()
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    /**
     * Update user base data and roles.
     */
    public function updateUser(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        $user->syncRoles($data['roles']);

        return $user->fresh('roles');
    }

    /**
     * Delete user.
     */
    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}
