<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kontak;
use Illuminate\Auth\Access\HandlesAuthorization;

class KontakPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the kontak can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list kontaks');
    }

    /**
     * Determine whether the kontak can view the model.
     */
    public function view(User $user, Kontak $model): bool
    {
        return $user->hasPermissionTo('view kontaks');
    }

    /**
     * Determine whether the kontak can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create kontaks');
    }

    /**
     * Determine whether the kontak can update the model.
     */
    public function update(User $user, Kontak $model): bool
    {
        return $user->hasPermissionTo('update kontaks');
    }

    /**
     * Determine whether the kontak can delete the model.
     */
    public function delete(User $user, Kontak $model): bool
    {
        return $user->hasPermissionTo('delete kontaks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete kontaks');
    }

    /**
     * Determine whether the kontak can restore the model.
     */
    public function restore(User $user, Kontak $model): bool
    {
        return false;
    }

    /**
     * Determine whether the kontak can permanently delete the model.
     */
    public function forceDelete(User $user, Kontak $model): bool
    {
        return false;
    }
}
