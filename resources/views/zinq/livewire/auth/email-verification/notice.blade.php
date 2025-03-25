<div class="flex flex-col items-center px-2 sm:px-0 py-12 sm:py-24">
    <span class="h3">Verify your email</span>
    <span class="pt-6">
        We've sent you an email to verify your account.
    </span>
    <zinq:button loading wire:click="sendVerificationNotification" class="mt-6">Resend email</zinq:button>
    @if($successMessage)
        <div class="mt-4 text-sm text-green-600">
            {{ $successMessage }}
        </div>
    @endif
    <div class="mt-24 flex items-center justify-between w-full">
        <div class="flex-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <zinq:button xs>Logout</zinq:button>
            </form>
        </div>
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
