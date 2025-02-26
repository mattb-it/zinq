<?php

declare(strict_types=1);

namespace Mattbit\Zinq;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mattbit\Zinq\Utilities\ZinqModal;

class ZinqManager
{
    public function __construct(
        private readonly ZinqModal $modal,
    ) {
    }

    public function openModal(string $modal): void
    {
        $this->modal->openModal($modal);
    }

    public function findAsset(string $name, string $extension): ?string
    {
        return collect(File::files(__DIR__ . '/../dist/assets/'))
            ->map(fn ($file) => $file->getFilename())
            ->first(fn (string $filename) => Str::startsWith($filename, $name) && Str::endsWith($filename, $extension));
    }

    public function extractVersionFromFile(string $file): ?string
    {
        return preg_match('/([^-]+)\.[^.]*$/', $file, $matches) ? $matches[1] : '';
    }
}
