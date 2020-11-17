<?php

use App\Http\Controllers\Auth\{SignInController, MeController, SignOutController};
use App\Http\Controllers\Keys\AlgoliaKeyController;
use App\Http\Controllers\Me\SnippetController as Me;
use App\Http\Controllers\Snippet\{SnippetController, StepController};
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('signin', SignInController::class);
    Route::get('me', MeController::class);
    Route::post('signout', SignOutController::class);
});

Route::group(['prefix' => 'snippets'], function () {
    Route::get('', [SnippetController::class, 'index']);
    Route::post('', [SnippetController::class, 'store']);
    Route::delete('{snippet:uuid}', [SnippetController::class, 'destroy']);
    Route::get('{snippet:uuid}', [SnippetController::class, 'show']);
    Route::patch('{snippet:uuid}', [SnippetController::class, 'update']);

    Route::patch('{snippet:uuid}/steps/{step:uuid}', [StepController::class, 'update']);
    Route::post('{snippet:uuid}/steps', [StepController::class, 'store']);
    Route::delete('{snippet:uuid}/steps/{step:uuid}', [StepController::class, 'destroy']);
});

Route::group(['prefix' => 'me'], function () {
    Route::get('snippets', [Me::class, 'index']);
});

Route::group(['prefix' => 'keys'], function () {
    Route::get('algolia', AlgoliaKeyController::class);
});
