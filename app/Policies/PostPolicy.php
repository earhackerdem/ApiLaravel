<?php

namespace App\Policies;

use App\Models\Api\V1\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Post $post)
    {
        return $post->user_id === $user->id;
    }

}
