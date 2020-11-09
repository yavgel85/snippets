<?php

namespace App\Policies;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SnippetPolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @param Snippet $snippet
     * @return bool
     */
    public function show(?User $user, Snippet $snippet): bool
    {
        if ($snippet->isPublic()) {
            return true;
        }

        return optional($user)->id === $snippet->user_id;
    }

    /**
     * @param User $user
     * @param Snippet $snippet
     * @return bool
     */
    public function update(User $user, Snippet $snippet): bool
    {
        return $user->id === $snippet->user_id;
    }

    /**
     * @param User $user
     * @param Snippet $snippet
     * @return bool
     */
    public function storeStep(User $user, Snippet $snippet): bool
    {
        return $user->id === $snippet->user_id;
    }
}
