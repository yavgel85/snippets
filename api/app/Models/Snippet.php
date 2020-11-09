<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Snippet extends Model
{
    use HasFactory;

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

    public function isPublic()
    {
        return $this->is_public;
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
