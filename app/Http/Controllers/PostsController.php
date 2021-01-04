<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResourceCollection;
use App\Http\Requests\SearchPostsRequest;
use App\Repositories\Merchant\MerchantsRepositoryInterface;
use App\Repositories\Post\PostsRepositoryInterface;
use App\Repositories\User\UsersRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class PostsController extends Controller
{
    private $postsRepository;
    private $post;
    protected $usersRepository;
    protected $merchantsRepository;

    /**
     * PostsController constructor.
     *
     * @param PostsRepositoryInterface $postsRepository
     * @param UsersRepositoryInterface $usersRepository
     * @param MerchantsRepositoryInterface $merchantsRepository
     */
    public function __construct(
        PostsRepositoryInterface $postsRepository,
        UsersRepositoryInterface $usersRepository,
        MerchantsRepositoryInterface $merchantsRepository
    )
    {
        $this->repository = $postsRepository;
        $this->usersRepository = $usersRepository;
        $this->merchantsRepository = $merchantsRepository;
        $this->post = new Post();
    }

    /**
     * Get posts list
     *
     * @param SearchPostsRequest $request
     * @return PostsResourceCollection
     * @throws ValidationException
     */
    public function index(SearchPostsRequest $request): PostsResourceCollection
    {
        $posts = $this->repository->searchPosts(
            $request->validated()
        );

        return new PostsResourceCollection($posts);
    }

    /**
     * Store post.
     *
     * @param CreatePostRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(CreatePostRequest $request): JsonResponse
    {
        $merchant = $this->merchantsRepository->getByToken(
            $request->header('X-Access-Token')
        );

        $user = $this->usersRepository->getByUserCode(
            $merchant->id,
            $request->header('X-User-Code')
        );

        $data = $request->validated();
        $data['user_id'] = $user->id;

        $this->repository->createPost($data);

        return response()->json('Post created successfully');
    }

    /**
     * Get specific post by id.
     *
     * @return PostResource
     */
    public function show(int $id): PostResource
    {
        return new PostResource($this->repository->getById($id));
    }

    /**
     * Delete post.
     *
     * @param int     $id      - Post id
     * @param Request $request - Incoming request
     *
     * @return JsonResponse
     */
    public function destroy(int $id, Request $request): JsonResponse
    {
        $merchant = $this->merchantsRepository->getByToken(
            $request->header('X-Access-Token')
        );

        $user = $this->usersRepository->getByUserCode(
            $merchant->id,
            $request->header('X-User-Code')
        );

        $post = $this->postsRepository->getById($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => Lang::get('Post not found')
            ]);
        }

        if ($post->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => Lang::get('Deleting Post not allowed')
            ]);
        }

        $this->postsRepository->deletePost($id);

        return response()->json([
            'success' => true,
            'message' => Lang::get('Post Deleted Successfully')
        ]);
    }
}
