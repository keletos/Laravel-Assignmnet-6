<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Moderators can view any article.
     * Users can only view their own articles.
     */
    public function view(User $user, Article $article): bool
    {
        if ($user->isModerator()) {
            return true;
        }

        return $user->id === $article->user_id;
    }

    /**
     * Only users (not moderators) can create articles.
     */
    public function create(User $user): bool
    {
        return $user->isUser();
    }

    /**
     * Both roles can update, but users only their own.
     */
    public function update(User $user, Article $article): bool
    {
        if ($user->isModerator()) {
            return true;
        }

        return $user->id === $article->user_id;
    }

    /**
     * Both roles can delete, but users only their own.
     */
    public function delete(User $user, Article $article): bool
    {
        if ($user->isModerator()) {
            return true;
        }

        return $user->id === $article->user_id;
    }
}
