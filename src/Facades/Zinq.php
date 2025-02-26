<?php

declare(strict_types=1);

namespace Mattbit\Zinq\Facades;

use Illuminate\Support\Facades\Facade;
use Mattbit\Zinq\ZinqManager;

/**
 * @see ZinqManager
 * @method static openModal(string $modal): void
 * @method static findAsset(string $name, string $extension): ?string
 * @method static extractVersionFromFile(string $file): ?string
 */
class Zinq extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'zinq';
    }
}
