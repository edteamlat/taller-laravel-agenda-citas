<?php

namespace App\Policies;

use App\Models\Scheduler;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulerPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Scheduler $scheduler)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Scheduler $scheduler)
    {
        if ($scheduler->from->diffInHours() < 24) {
            return false;
        }

        if (($scheduler->client_user_id == $user->id) OR ($scheduler->staff_user_id == $user->id)) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Scheduler $scheduler)
    {
        if ($scheduler->to->isPast()) {
            return false;
        }

        if ($scheduler->from->diffInHours() < 24) {
            return false;
        }

        if (($scheduler->client_user_id == $user->id) OR ($scheduler->staff_user_id == $user->id)) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Scheduler $scheduler)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scheduler  $scheduler
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Scheduler $scheduler)
    {
        //
    }
}
