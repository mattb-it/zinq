<?php

declare(strict_types=1);

namespace Mattbit\Zinq;

use Illuminate\Container\Attributes\Config;

final readonly class ZinqStyles
{
    public function __construct(
        #[Config('zinq.colors')] private array $colors,
        #[Config('zinq.inject_fonts')] private bool $injectFonts = true,
    ) {
    }

    public function generate(): string
    {
        return $this->generateVariables() . "\n" . $this->generateLinkTags();
    }

    private function generateVariables(): string
    {
        $output = '';
        foreach ($this->colors as $name => $value) {
            $output .= "{$name}: {$value};\n";
        }

        return <<<HTML
            <style>
                :root {
                    {$output}
                }
            </style>
            HTML;
    }

    private function generateLinkTags(): string
    {
        $styles = collect();
        if ($this->injectFonts) {
            $styles->push('/zinq-fonts.css');
        }

        $styles->push('/zinq.css?id=' . uniqid());

        return $styles
            ->map(fn (string $style) => '<link rel="preload" as="style" href="' . $style . '" /><link rel="stylesheet" href="' . $style . '" data-navigate-track="reload"/>')
            ->join("\n");
    }
}
