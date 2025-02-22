<?php

declare(strict_types=1);

namespace Mattbit\Zinq;

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
}
