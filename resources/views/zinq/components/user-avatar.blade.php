@php use Illuminate\Support\Str; @endphp
@props([
    'user',
    'avatar' => 'avatar_url',
    'name' => 'name',
    'email' => 'email',
])
@php
    $userAvatar = $user->{$avatar};
    $name = $user->{$name};
    $email = $user->{$email};

    $letterAvatar = null;
    if (!$userAvatar && $name) {
        $letterAvatar = Str::substr($name, 0, 1);
    } else if (!$userAvatar && $email) {
        $letterAvatar = Str::substr($email, 0, 1);
    } else if (!$userAvatar) {
        // Random letter: no avatar, no name and no email.
        $letterAvatar = Str::random(1);
    }
@endphp
<span class="flex flex-row text-wrap justify-start space-x-2 items-center">
    @if ($userAvatar)
        <zinq:avatar src="{{ $userAvatar }}"/>
    @elseif ($letterAvatar)
        <zinq:avatar-string>{{ $letterAvatar }}</zinq:avatar-string>
    @endif
    <span class="text-left">{{ $name ?: $email }}</span>
</span>
