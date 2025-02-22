<?php

declare(strict_types=1);

namespace Mattbit\Zinq\Utilities;

use Livewire\Component;
use Livewire\Livewire;
use RuntimeException;

trait ResolvesCurrentLaravelComponent
{
    protected function getCurrentLivewireComponent(): ?Component
    {
        if (!Livewire::current() instanceof Component) {
            throw new RuntimeException('Cannot toast outside of a Livewire component');
        }
        return Livewire::current();
    }
}
