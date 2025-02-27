<?php

namespace App\Models;

use App\Transformers\Snippets\SnippetTransformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Snippet extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['uuid', 'title', 'is_public'];

    public static function boot(): void
    {
        parent::boot();

        static::created(function (Snippet $snippet) {
            $snippet->steps()->create([
                'order' => 1
            ]);
        });

        static::creating(function (Snippet $snippet) {
            $snippet->uuid = Str::uuid();
        });
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return fractal()
            ->item($this)
            ->transformWith(new SnippetTransformer())
            ->parseIncludes(['author', 'steps'])
            ->toArray()
        ;
    }

    public function isPublic()
    {
        return $this->is_public;
    }

    public function scopePublic(Builder $builder): Builder
    {
        return $builder->where('is_public', true);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class)->orderBy('order', 'asc');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
