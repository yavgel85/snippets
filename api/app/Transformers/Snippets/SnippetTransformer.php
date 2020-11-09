<?php

namespace App\Transformers\Snippets;

use App\Models\Snippet;
use App\Transformers\Users\PublicUserTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;

class SnippetTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'steps',
        'author',
        'user',
    ];

    /**
     * A Fractal transformer.
     *
     * @param Snippet $snippet
     * @return array
     */
    public function transform(Snippet $snippet): array
    {
        return [
            'uuid'        => $snippet->uuid,
            'title'       => $snippet->title ?: '',
            'steps_count' => $snippet->steps->count(),
            'is_public'   => $snippet->is_public,
        ];
    }

    public function includeSteps(Snippet $snippet): Collection
    {
        return $this->collection($snippet->steps, new StepTransformer());
    }

    public function includeAuthor(Snippet $snippet): Item
    {
        return $this->item($snippet->user, new PublicUserTransformer());
    }

    public function includeUser(Snippet $snippet): Primitive
    {
        return $this->primitive('user', function () use ($snippet) {
           return [
               'data' => [
                   'owner' => $snippet->user_id === optional(auth()->user())->id,
               ]
           ];
        });
    }
}
