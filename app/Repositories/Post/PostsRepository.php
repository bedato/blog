<?php

declare(strict_types=1);

namespace App\Repositories\Post;

use ArrayAccess;
use App\Models\Post;

class PostsRepository implements PostsRepositoryInterface
{
    protected $posts;

    /**
     * PostsRepository constructor.
     *
     * @param Post $posts - instantiate Model
     */
    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Retrieve all posts.
     *
     * @return ArrayAccess<Post>
     */
    public function getAll(): ArrayAccess
    {
        return $this->posts->all();
    }

    /**
     * Retrieve posts that correspond to criteria.
     *
     * @return ArrayAccess<Post>
     */
    public function searchPosts(array $searchCriteria): ArrayAccess
    {
        $search = $this->posts->query();

        $sortBy = null;
        $sortRule = null;
        $perPage = null;
        $offset = null;
        $page = 1;

        if (array_key_exists('page', $searchCriteria)) {
            $page = $searchCriteria['page'];
            unset($searchCriteria['page']);
        }

        if (array_key_exists('sort_by', $searchCriteria) && array_key_exists('sort_rule', $searchCriteria)) {
            $sortBy = $searchCriteria['sort_by'];
            $sortRule = $searchCriteria['sort_rule'];

            unset($searchCriteria['sort_by']);
            unset($searchCriteria['sort_rule']);
        }

        if (array_key_exists('per_page', $searchCriteria)) {
            $perPage = (int) $searchCriteria['per_page'];
            unset($searchCriteria['per_page']);
        }

        if (array_key_exists('random', $searchCriteria)) {
            if ($searchCriteria['random'] == 1) {
                $search = $search->inRandomOrder();
            }
            unset($searchCriteria['random']);
        }

        if ($offset) {
            $search = $search->where('id', '>=', $offset);
        }

        $result = $search->where($searchCriteria);
        $result = $result->skip($perPage * ($page - 1))->take($perPage);

        if ($sortBy && $sortRule) {
            $result = $result->orderBy($sortBy, $sortRule);
        }

        return $result->paginate($perPage);
    }

    /**
     * Retrieve Post by Id.
     *
     * @param int $id
     * @return Post
     */
    public function getById(int $id): Post
    {
        return $this->posts->findOrFail($id);
    }

    /**
     * Retrieve total count of posts.
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->posts->count();
    }

    /**
     * Update post with provided parameters.
     *
     * @param int   postId     - id of the record.
     * @param array $parameters - data to update the record with.
     *
     * @return void
     */
    public function updatePost(int $postId, array $parameters): void
    {
        $posts = $this->getById($postId);

        $posts->update($parameters);
    }

    /**
     * Create post with provided parameters.
     *
     * @param array $parameters - data to create record.
     *
     * @return void
     */
    public function createPost(array $parameters): void
    {
        $this->posts->create($parameters);
    }

    /**
     * Delete post with provided parameters.
     *
     * @param int $postId - id of record to delete.
     *
     * @return void
     */
    public function deletePost(int $postId): void
    {
        $this->posts->destroy($postId);
    }
}
