<?php

namespace App\Policies;

use App\Models\Step;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StepPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Step $step
     * @return bool
     */
    public function update(User $user, Step $step): bool
    {
        return $user->id === $step->snippet->user_id;
    }

    /**
     * @param User $user
     * @param Step $step
     * @return bool
     */
    public function destroy(User $user, Step $step): bool
    {
        return $user->id === $step->snippet->user_id;
    }
}
