<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Snippet;
use App\Models\User;
use App\Transformers\Snippets\SnippetTransformer;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    public function index(User $user, Request $request)
    {
        return fractal()
            ->collection(
                $user->snippets()->public()->get()
            )
            ->transformWith(new SnippetTransformer())
            ->toArray()
        ;
    }
}
