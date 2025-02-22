<?php

declare(strict_types=1);

namespace Mattbit\Zinq;

use Illuminate\Support\Str;
use Illuminate\View\Compilers\ComponentTagCompiler;
use Livewire\Drawer\Regexes;

class ZinqTagPrecompiler extends ComponentTagCompiler
{
    public function __invoke($value): mixed
    {
        $value = $this->compileSelfClosingTags($value);
        $value = $this->compileOpeningTags($value);
        $value = $this->compileClosingTags($value);

        return $value;
    }

    protected function compileSelfClosingTags(string $value)
    {
        $pattern = '/'.Regexes::$livewireSelfClosingTag.'/x';
        $pattern = Str::replace('livewire', 'zinq', $pattern);

        return preg_replace_callback($pattern, function (array $matches) {
            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            // Convert to x-zinq::component
            $matches[1] = 'zinq::' . $matches[1];

            return $this->componentString($matches[1], $attributes)."\n@endComponentClass##END-COMPONENT-CLASS##";
        }, $value);
    }

    protected function compileOpeningTags(string $value)
    {
        $pattern = '/'.Regexes::$livewireOpeningTag.'/x';
        $pattern = Str::replace('livewire', 'zinq', $pattern);

        return preg_replace_callback($pattern, function (array $matches) {
            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            // Convert to x-zinq::component
            $matches[1] = 'zinq::' . $matches[1];

            return $this->componentString($matches[1], $attributes);
        }, $value);
    }

    protected function compileClosingTags(string $value)
    {
        return preg_replace("/<\/zinq[:\w\-\.]*\s*>/", ' @endComponentClass##END-COMPONENT-CLASS##', $value);
    }
}
