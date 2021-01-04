<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Infrastructure\Resources\WithApiWrapping;
use App\Infrastructure\Resources\WithDataFormatters;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    use WithApiWrapping, WithDataFormatters;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $post = $this->resource;

        return [
            'id' => (int) $post->id,
            'author' => $post->author,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'content' => $post->content,
            'image_url' => $post->image_url,
            'is_featured' => $post->is_featured,
            'created_at' => $this->formatDate($post->created_at),
            'updated_at' => $this->formatDate($post->updated_at)
        ];
    }
}

