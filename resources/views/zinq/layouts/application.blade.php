<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}" class="min-h-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zinq: Application Layout</title>

    @zinqStyles
    @zinqHeadScripts
</head>
<body class="min-h-screen">
<div x-data="toggleMobileNav()" class="relative isolate lg:flex min-h-svh w-full">
    <div x-ref="nav" class="zinq-sidebar z-20 opacity-0 hidden lg:flex flex-col fixed inset-y-0 left-0 w-full bg-white dark:bg-zinc-950 transition-all duration-300 lg:duration-0 lg:transition-none lg:bg-transparent lg:w-64 lg:opacity-100">
        <div class="mx-2.5 pt-14 pb-4 lg:py-4">
            <zinq:dropdown smLinks class="w-full">
                <x-slot name="trigger">
                    <button class="mx-2 px-3 py-1.5 rounded-md w-full text-sm hover:bg-zinc-100 hover:text-black dark:hover:bg-zinc-800 dark:hover:text-white">
                        <span class="w-full flex flex-row justify-between items-center">
                            <span class="flex flex-row items-center">
                                <zinq:avatar src="https://i.pravatar.cc/80?img=8" />
                                <span class="ml-2">John Smith</span>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </button>
                </x-slot>
                <zinq:dropdown.link href="#" icon="Account">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </zinq:dropdown.link>
                <zinq:dropdown.separator />
                <zinq:dropdown.link href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" icon="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                </zinq:dropdown.link>
                <form id="logout-form" action="#" method="POST" class="hidden">
                    @csrf
                </form>
            </zinq:dropdown>
        </div>
        <hr class="w-full inline-flex border-zinc-100 dark:border-zinc-800" />
        <zinq:nav class="mt-4">
            <zinq:nav.link active wire:navigate href="#" icon="Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
            </zinq:nav.link>
            <zinq:nav.link wire:navigate href="#" icon="Orders">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </zinq:nav.link>
            <zinq:nav.link wire:navigate href="#" icon="Products">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </zinq:nav.link>
            <zinq:nav.link wire:navigate href="#" icon="Analytics">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
            </zinq:nav.link>
            <zinq:nav.link wire:navigate href="#" icon="Settings">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </zinq:nav.link>
            <zinq:nav.link wire:navigate href="#" icon="Users">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </zinq:nav.link>
        </zinq:nav>
        <div class="my-2.5">
            <zinq:nav class="mb-2">
                <zinq:theme-switcher>
                    <x-slot name="light">
                        <li>
                            <a href="#">
                                <span class="w-full flex flex-row space-x-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                    </svg>
                                    <span>Light mode</span>
                                </span>
                            </a>
                        </li>
                    </x-slot>
                    <x-slot name="dark">
                        <li>
                            <a href="#">
                                <span class="w-full flex flex-row space-x-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                    </svg>
                                    <span>Dark mode</span>
                                </span>
                            </a>
                        </li>
                    </x-slot>
                </zinq:theme-switcher>
            </zinq:nav>
            <hr class="w-full border-zinc-100 dark:border-zinc-800 mb-2" />
            <div class="px-4 mx-2.5 flex flex-row items-center justify-between pt-1">
                <a href="{{ url('/') }}" title="Zinq" class="logo-link sm">
                    <img src="{{ asset('logo.svg') }}" alt="Zinq" class="logo-image" />
                    <span class="text-xs text-zinc-600 dark:text-zinc-400">zinq</span>
                </a>
                <span class="text-xs text-zinc-400">v1.0.0</span>
            </div>
        </div>
    </div>
    <div class="lg:ml-2 lg:ml-64 lg:my-2 lg:mr-2 grow lg:rounded-lg lg:border border-zinc-200 lg:shadow-2xs dark:shadow-zinc-800/80 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-950/30 p-3 lg:p-8">
        <div x-ref="btn" class="lg:hidden absolute z-20 top-2 right-2 flex items-center">
            <zinq:button @click="toggleMenu" bare>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </zinq:button>
        </div>

        @yield('content')
    </div>
</div>
@zinqScripts
<script>
    function toggleMobileNav() {
        return {
            toggleMenu() {
                if (this.$refs.nav.classList.contains('opacity-0')) {
                    // Show
                    this.$refs.nav.classList.remove('hidden');
                    this.$refs.nav.classList.remove('opacity-0');

                    if (this.$refs.btn.classList.contains('right-2')) {
                        this.$refs.btn.classList.remove('right-2');
                        this.$refs.btn.classList.add('left-2');
                    }

                    setTimeout(() => {
                        this.$refs.nav.classList.remove('hidden');
                    }, 300);
                } else {
                    // Hide
                    this.$refs.nav.classList.add('opacity-0');

                    if (this.$refs.btn.classList.contains('left-2')) {
                        this.$refs.btn.classList.remove('left-2');
                        this.$refs.btn.classList.add('right-2');
                    }

                    setTimeout(() => {
                        this.$refs.nav.classList.add('hidden');
                    }, 300);
                }
            }
        };
    }
</script>
</body>
</html>
