<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\Test\Util;

final class IterableUtil
{
    /**
     * @phpstan-template T
     *
     * @phpstan-param iterable<T> $iterable
     *
     * @phpstan-return array<T>
     */
    public static function iterableToArray(iterable $iterable): array
    {
        return $iterable instanceof \Traversable ? iterator_to_array($iterable) : (array) $iterable;
    }
}
