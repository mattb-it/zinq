<div class="flex flex-col items-center px-2 sm:px-0 py-12 sm:py-24">
    <p class="h3">@if ($reset) Reset password @else Check your inbox @endif</p>
    <p class="mt-4 text-center">
        @if ($reset)
            Provide your email address, and we'll send you a link to reset your password.
        @else
            We sent you a link to reset your password.
        @endif
    </p>
    @if ($reset)
        <div class="mt-8 w-full">
            <zinq:form action="send" block>
                <zinq:input size="lg" wire:model="email" placeholder="Email address" required focus />
                <zinq:button lg primary loading>Send</zinq:button>
            </zinq:form>
        </div>
        <p class="mt-6">
            <a href="{{ route('login') }}" wire:navigate>Back to log in</a>
        </p>
    @else
        <div class="mt-8 w-full flex justify-center">
            <zinq:badge success>{{ $email }}</zinq:badge>
        </div>
        <p class="mt-6">
            <a href="{{ route('login') }}" wire:navigate>Back to log in</a>
        </p>
    @endif
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
