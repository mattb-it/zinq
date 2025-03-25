<div class="flex flex-col items-center px-2 sm:px-0 py-12 sm:py-24">
    <span class="h3">Log in</span>
    <span class="pt-6">
        Don't have an account?
        <a href="{{ route('register') }}" wire:navigate>Sign up</a>
    </span>
    <zinq:form block action="login" class="w-full mt-6">
        <zinq:input size="lg" wire:model="email" placeholder="Email address" focus>Email</zinq:input>
        <zinq:button lg loading primary>Continue</zinq:button>
    </zinq:form>
    <a href="{{ route('password.request') }}" wire:navigate class="mt-6">Forgot your password?</a>
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
