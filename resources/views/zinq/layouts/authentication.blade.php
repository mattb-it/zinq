<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}" class="min-h-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zinq: Authentication Layout</title>

    @zinqStyles
    @zinqHeadScripts
</head>
<body class="min-h-screen">
<div class="mx-auto max-w-sm pt-8 sm:pt-16">
    <div class="flex justify-center">
        <a href="{{ url('/') }}" title="{{ env('APP_NAME') }}" class="flex items-center space-x-2 rounded-md bg-none! border-none! font-normal!">
            <span class="text-base">{{ env('APP_NAME') }}</span>
        </a>
    </div>
    @yield('content')
</div>
</body>
</html>
