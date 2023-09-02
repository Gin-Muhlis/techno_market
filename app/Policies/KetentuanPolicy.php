<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ketentuan;
use Illuminate\Auth\Access\HandlesAuthorization;

class KetentuanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ketentuan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list ketentuans');
    }

    /**
     * Determine whether the ketentuan can view the model.
     */
    public function view(User $user, Ketentuan $model): bool
    {
        return $user->hasPermissionTo('view ketentuans');
    }

    /**
     * Determine whether the ketentuan can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create ketentuans');
    }

    /**
     * Determine whether the ketentuan can update the model.
     */
    public function update(User $user, Ketentuan $model): bool
    {
        return $user->hasPermissionTo('update ketentuans');
    }

    /**
     * Determine whether the ketentuan can delete the model.
     */
    public function delete(User $user, Ketentuan $model): bool
    {
        return $user->hasPermissionTo('delete ketentuans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete ketentuans');
    }

    /**
     * Determine whether the ketentuan can restore the model.
     */
    public function restore(User $user, Ketentuan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the ketentuan can permanently delete the model.
     */
    public function forceDelete(User $user, Ketentuan $model): bool
    {
        return false;
    }
}
