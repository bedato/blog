<?php

declare(strict_types=1);

namespace App\Repositories\Post;

use ArrayAccess;
use App\Models\Post;

interface PostsRepositoryInterface
{
    /**
     * Retrieve all posts.
     *
     * @return ArrayAccess<Post>
     */
    public function getAll(): ArrayAccess;

    /**
     * Retrieve posts that correspond to criteria.
     *
     * @param array $searchCriteria
     * @return ArrayAccess<Post>
     */
    public function searchPosts(array $searchCriteria): ArrayAccess;

    /**
     * Retrieve posts by Id.
     *
     * @param int $id
     */
    public function getById(int $id);

    /**
     * Retrieve total count of posts.
     *
     * @return int
     */
    public function getTotal(): int;

    /**
     * Update post with provided parameters.
     *
     * @param int $id
     * @param array $parameters
     * @return void
     */
    public function updatePost(int $id, array $parameters): void;

    /**
     * Create post with provided parameters.
     *
     * @param array $parameters
     * @return void
     */
    public function createPost(array $parameters): void;

    /**
     * Delete post with provided parameters.
     *
     * @param int $id
     * @return void
     */
    public function deletePost(int $id): void;
}
