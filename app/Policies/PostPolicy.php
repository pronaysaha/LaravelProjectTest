<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        // Allow the user to create a new post
        return true;
    }

    public function update(User $user, Post $post)
    {
        // Allow the user to update their own posts
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        // Allow the user to delete their own posts
        return $user->id === $post->user_id;
    }
}
