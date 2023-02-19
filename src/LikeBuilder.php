<?php

namespace Mpietrucha\LaravelEloquentLikeBuilder;


class LikeBuilder
{
    protected const INDICATOR = '%';

    protected const LIKE = 'like';
    protected const NOT_LIKE = 'not like';

    public function __construct(protected Builder $builder, protected ?string $start = null, protected ?string $end = null, protected string $method = self::LIKE)
    {
    }

    public function __call(string $method, array $arguments): Builder
    {
        if (count($arguments) !== 1) {
            throw new Exception('Like builder expects only one argument as value');
        }

        return $this->builder->where($method, $this->method, collect([
            $this->start, ...$arguments, $this->end,
        ])->toWord()->toString());
    }

    public function not(): self
    {
        $this->method = self::NOT_LIKE;

        return $this;
    }

    public static function full(Builder $builder): self
    {
        return new self($builder, self::INDICATOR, self::INDICATOR);
    }

    public static function start(Builder $builder): self
    {
        return new self($builder, end: self::INDICATOR);
    }

    public static function end(Builder $builder): self
    {
        return new self($builder, start: self::INDICATOR);
    }
}
