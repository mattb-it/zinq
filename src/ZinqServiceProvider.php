<?php

declare(strict_types=1);

namespace Mattbit\Zinq;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Mattbit\Zinq\Facades\Zinq;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ZinqServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/zinq.php' => config_path('zinq.php'),
        ]);

        $this->app->alias(ZinqManager::class, 'zinq');
        $this->app->singleton(ZinqManager::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('Zinq', Zinq::class);

        Blade::directive('zinqStylesTailwind', function (string $expression) {
            return "<?php echo app(\Mattbit\Zinq\ZinqStyles::class)->generateWithTailwind(); ?>";
        });
        Blade::directive('zinqStyles', function (string $expression) {
            return "<?php echo app(\Mattbit\Zinq\ZinqStyles::class)->generate(); ?>";
        });
        Blade::directive('zinqHeadScripts', function (string $expression) {
            return "<?php echo app(\Mattbit\Zinq\ZinqScripts::class)->generateHead(); ?>";
        });
        Blade::directive('zinqScripts', function (string $expression) {
            return "<?php echo app(\Mattbit\Zinq\ZinqScripts::class)->generate(); ?>";
        });

        if (File::isDirectory(resource_path('views/zinq/components'))) {
            Blade::anonymousComponentPath(resource_path('views/zinq/components'), 'zinq');
        } else {
            Blade::anonymousComponentPath(__DIR__ . '/../resources/views/zinq/components', 'zinq');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views/zinq/builders', 'zinq');

        $this->publishes([
            __DIR__.'/../config/zinq.php' => config_path('zinq.php'),
        ], 'zinq-config');

        $this->publishes([
            __DIR__.'/../resources/fonts' => public_path('vendor/zinq'),
        ], 'zinq-fonts');

        $this->publishes([
            __DIR__.'/../resources/views/zinq/layouts' => resource_path('views/vendor/zinq/layouts'),
        ], 'zinq-layouts');

        Blade::precompiler(app(ZinqTagPrecompiler::class));

        Route::get('/zinq.css', fn () => $this->serveCssStyles('zinq'));
        Route::get('/zinq-fonts.css', fn () => $this->serveCssStyles('fonts'));
        Route::get('/zinq.js', fn () => $this->serveJsScripts('zinq'));
        Route::get('/zinq-editor.js', fn () => $this->serveJsScripts('zinq-editor'));
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/zinq.php', 'zinq',
        );
    }

    private function serveCssStyles(string $name): BinaryFileResponse
    {
        $cssFile = $this->findAsset($name, '.css');
        if (!$cssFile) {
            abort(Response::HTTP_NOT_FOUND);
        }
        return response()->file(__DIR__ . '/../dist/assets/' . $cssFile, [
            'Content-Type' => 'text/css',
            'Cache-Control' => 'public, max-age=31536000',
            'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000),
        ]);
    }

    private function serveJsScripts(string $name): BinaryFileResponse
    {
        $jsFile = $this->findAsset($name, '.js');
        if (!$jsFile) {
            abort(Response::HTTP_NOT_FOUND);
        }
        return response()->file(__DIR__ . '/../dist/assets/' . $jsFile, [
            'Content-Type' => 'text/javascript',
            'Cache-Control' => 'public, max-age=31536000',
            'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000),
        ]);
    }

    private function findAsset(string $name, string $extension): ?string
    {
        return collect(File::files(__DIR__ . '/../dist/assets/'))
            ->map(fn ($file) => $file->getFilename())
            ->first(fn (string $filename) => Str::startsWith($filename, $name) && Str::endsWith($filename, $extension));
    }
}
