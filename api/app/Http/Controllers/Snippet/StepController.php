<?php

namespace App\Http\Controllers\Snippet;

use App\Http\Controllers\Controller;
use App\Models\Snippet;
use App\Models\Step;
use App\Transformers\Snippets\StepTransformer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * @param Snippet $snippet
     * @param Step $step
     * @param Request $request
     */
    public function update(Snippet $snippet, Step $step, Request $request): void
    {
        $this->authorize('update', $step);

        $step->update($request->only('title', 'body'));
    }

    /**
     * @param Snippet $snippet
     * @param Request $request
     * @return array
     */
    public function store(Snippet $snippet, Request $request): array
    {
        $this->authorize('storeStep', $snippet);

        $step = $snippet->steps()->create(array_merge(
            $request->only('title', 'body'),
            ['order' => $this->getOrder($request)]
        ));

        return fractal()
            ->item($step)
            ->transformWith(new StepTransformer())
            ->toArray()
        ;
    }

    /**
     * @param Snippet $snippet
     * @param Step $step
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Snippet $snippet, Step $step)
    {
        $this->authorize('destroy', $step);

        if ($snippet->steps->count() === 1) {
            return response()->json(['error' => 'You cannot delete the only step'], 400);
        }

        $step->delete();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getOrder(Request $request)
    {
        return Step::where('uuid', $request->before)
            ->orWhere('uuid', $request->after)
            ->first()
            ->{($request->before ? 'before' : 'after') . 'Order'}()
        ;
    }
}
