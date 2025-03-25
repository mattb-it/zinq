<div class="flex flex-col items-center px-2 sm:px-0 py-12 sm:py-24">
    <p class="h3">Hi there!</p>
    <div class="mt-4">
        <zinq:badge success>{{ $email }}</zinq:badge>
    </div>
    <div class="mt-4">
        <a href="{{ route('login') }}" wire:navigate>Use another account</a>
    </div>
    <div class="mt-8 w-full">
        <zinq:form action="login" block>
            <zinq:input size="lg" type="password" wire:model="password" placeholder="Password" required focus />
            <zinq:button lg primary loading>Log in</zinq:button>
        </zinq:form>
    </div>
    <p class="mt-6">
        <a href="{{ route('password.request') }}" wire:navigate>Forgot your password?</a>
    </p>
    <div class="mt-24 flex items-center justify-between w-full">
        <div class="flex-1"></div>
        <div class="text-center flex-1">
            <span class="text-sm">
                &copy; {{ date('Y') }} {{ env('APP_NAME') }}
            </span>
        </div>
        <div class="text-right flex-1">
            <zinq:theme-switcher />
        </div>
    </div>
</div>
