<?php

namespace App\Transformers\Snippets;

use App\Models\Snippet;
use App\Models\Step;
use League\Fractal\TransformerAbstract;

class StepTransformer extends TransformerAbstract
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
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param Step $step
     * @return array
     */
    public function transform(Step $step): array
    {
        return [
            'uuid'  => $step->uuid,
            'order' => (float) $step->order,
            'title' => $step->title ?: '',
            'body'  => $step->body ?: '',
        ];
    }
}
