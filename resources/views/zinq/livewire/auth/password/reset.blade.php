<div class="flex flex-col items-center px-2 sm:px-0 py-12 sm:py-24">
    <p class="h3">Set your new password</p>
    <div class="mt-4">
        <zinq:badge success>{{ $email }}</zinq:badge>
    </div>
    <div class="w-full mt-8">
        <zinq:form action="update" block>
            <zinq:input size="lg" type="password" wire:model="password" placeholder="New password" required />
            <zinq:button lg primary loading>Set password</zinq:button>
        </zinq:form>
    </div>
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
