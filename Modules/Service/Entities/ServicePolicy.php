<?php

namespace Modules\Service\Entities;

use App\Models\User;
use Modules\Service\Entities\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_service::service::request');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Service\Entities\Service  $service
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Service $service)
    {
        return $user->can('view_service::service::request');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_service::service::request');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Service\Entities\Service  $service
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Service $service)
    {
        return $user->can('update_service::service::request');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Service\Entities\Service  $service
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Service $service)
    {
        return $user->can('delete_service::service::request');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_service::service::request');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Service\Entities\Service  $service
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Service $service)
    {
        return $user->can('force_delete_service::service::request');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_service::service::request');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Service\Entities\Service  $service
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Service $service)
    {
        return $user->can('restore_service::service::request');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_service::service::request');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Service\Entities\Service  $service
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Service $service)
    {
        return $user->can('replicate_service::service::request');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_service::service::request');
    }

}