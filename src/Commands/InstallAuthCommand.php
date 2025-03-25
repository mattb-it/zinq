<?php

declare(strict_types=1);

namespace Mattbit\Zinq\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAuthCommand extends Command
{
    protected $signature = 'zinq:install:auth {--no-password} {--no-email-verification}';

    protected $description = 'Install Zinq authentication components.';

    public function handle(): void
    {
        $stubs = collect([
            'auth/login.stub' => app_path('Livewire/Auth/Login.php'),
            'auth/login-email.stub' => app_path('Livewire/Auth/LoginEmail.php'),
            'auth/register.stub' => app_path('Livewire/Auth/Register.php'),
        ]);

        $views = collect([
            'auth/login.blade.php' => resource_path('views/livewire/auth/login.blade.php'),
            'auth/login-email.blade.php' => resource_path('views/livewire/auth/login-email.blade.php'),
            'auth/register.blade.php' => resource_path('views/livewire/auth/register.blade.php'),
        ]);

        if (!$this->option('no-password')) {
            $stubs->put('auth/password/forgot-password.stub', app_path('Livewire/Auth/ForgotPassword.php'));
            $stubs->put('auth/password/reset-password.stub', app_path('Livewire/Auth/ResetPassword.php'));

            $views->put('auth/password/forgot.blade.php', resource_path('views/livewire/auth/forgot-password.blade.php'));
            $views->put('auth/password/reset.blade.php', resource_path('views/livewire/auth/reset-password.blade.php'));
        }

        if (!$this->option('no-email-verification')) {
            $stubs->put('auth/email-verification/notice.stub', app_path('Livewire/Auth/EmailVerificationNotice.php'));

            $views->put('auth/email-verification/notice.blade.php', resource_path('views/livewire/auth/email-verification-notice.blade.php'));
        }

        $stubs->each(fn (string $destination, string $stub) => $this->copyStub($stub, $destination));
        $views->each(fn (string $destination, string $view) => $this->copyView($view, $destination));

        $this->callSilently('vendor:publish', ['--tag' => 'zinq-layouts']);

        $this->newLine();
        $this->line($this->buildGradientLine('  Zinq Toolkit  '));
        $this->newLine();
        $this->info('Authentication components installed successfully!');

        $this->comment('Visit Zinq docs to set up proper routing 👉 https://zinq.dev/docs/layouts/authentication');
    }

    private function copyStub(string $stub, string $destination): void
    {
        File::ensureDirectoryExists(dirname($destination));

        $placeholders = [
            '{{NAMESPACE}}' => $this->laravel->getNamespace() . 'Livewire\Auth',
        ];
        $stubPath = __DIR__ . "/../../resources/stubs/livewire/$stub";
        $stubContent = File::get($stubPath);
        $content = str_replace(array_keys($placeholders), array_values($placeholders), $stubContent);

        File::put($destination, $content);
    }

    private function copyView(string $view, string $destination): void
    {
        File::ensureDirectoryExists(dirname($destination));

        $viewPath = __DIR__ . "/../../resources/views/zinq/livewire/$view";
        $viewContent = File::get($viewPath);

        File::put($destination, $viewContent);
    }


    protected function buildGradientLine(string $text): string
    {
        $colors = [214, 208, 202, 208, 214];

        $chars = mb_str_split($text);
        $charCount = count($chars);
        $colorCount = count($colors);

        $gradient = '';

        foreach ($chars as $i => $char) {
            $colorIndex = intval(($i / max($charCount - 1, 1)) * ($colorCount - 1));
            $color = $colors[$colorIndex] ?? 214;

            // bold + white text + background color
            $gradient .= "\033[1m\033[48;5;{$color}m\033[30m{$char}";
        }

        $gradient .= "\033[0m"; // reset formatting

        return $gradient;
    }
}
