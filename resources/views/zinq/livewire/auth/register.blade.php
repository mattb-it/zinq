<div class="flex flex-col items-center px-2 sm:px-0 py-12 sm:py-24">
    <span class="h3">Create an account</span>
    <span class="pt-6">Already have an account? <a href="{{ route('login') }}" wire:navigate>Log in</a></span>
    <zinq:text-divider class="mt-6">Register with</zinq:text-divider>
    <zinq:form action="register" class="w-full mt-6" block>
        <zinq:input focus size="lg" wire:model="name" placeholder="Name">Name</zinq:input>
        <zinq:input size="lg" wire:model="email" placeholder="Email address">Email</zinq:input>
        <zinq:input size="lg" wire:model="password" placeholder="Password" type="password">Password</zinq:input>
        <zinq:button primary lg loading>Continue</zinq:button>
    </zinq:form>
    <span class="mt-4 text-zinc-600 text-sm">
        By signing up, you agree with our <a href="#">terms of service</a>.
    </span>
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
