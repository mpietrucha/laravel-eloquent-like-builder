<?php

namespace Mpietrucha\LaravelEloquentLikeBuilder;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Mpietrucha\LaravelEloquentLikeBuilder\LikeBuilder;

class LikeBuilderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Builder::macro('whereLike', fn () => LikeBuilder::full($this));
        Builder::macro('whereEndLike', fn () => LikeBuilder::end($this));
        Builder::macro('whereStartLike', fn () => LikeBuilder::start($this));
    }

    public function register(): void
    {

    }
}
