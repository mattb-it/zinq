<?php

declare(strict_types=1);

namespace Mattbit\Zinq\Utilities;

class ZinqModal
{
    use ResolvesCurrentLaravelComponent;

    private const OPEN_MODAL_EVENT = 'open-modal';

    public function openModal(string $modal): void
    {
        $this
            ->getCurrentLivewireComponent()
            ->dispatch(self::OPEN_MODAL_EVENT, $modal)
            ->to(null);
    }
}
