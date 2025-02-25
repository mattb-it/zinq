<?php

declare(strict_types=1);

namespace Mattbit\Zinq;

use Livewire\Livewire;
use Mattbit\Zinq\Facades\Zinq;

final class ZinqScripts
{
    public function generateHead(): string
    {
        return <<<HTML
<script>
    (function() {
        const isDarkMode = localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isDarkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    })();
</script>
HTML;

    }

    public static function generate(): string
    {
        // Force Livewire to inject its assets - we need alpinejs.
        Livewire::forceAssetInjection();

        $scriptsFile = Zinq::findAsset('zinq', 'js');
        $scriptsHash = $scriptsFile ? Zinq::extractVersionFromFile($scriptsFile) : 'static';
        return '<script type="module" src="/zinq.js?v=' . $scriptsHash . '"></script>';
    }
}
