<section>
    <header>
        <h2 class="text-lg font-semibold text-base-content">{{ __('Profile Information') }}</h2>
        <p class="mt-1 text-sm text-base-content/60">{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('patch')

        <div class="form-control">
            <label class="label" for="name">
                <span class="label-text">{{ __('Name') }}</span>
            </label>
            <input id="name" name="name" type="text" class="input input-bordered w-full @error('name') input-error @enderror"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="text-error text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-control">
            <label class="label" for="email">
                <span class="label-text">{{ __('Email') }}</span>
            </label>
            <input id="email" name="email" type="email" class="input input-bordered w-full @error('email') input-error @enderror"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <div class="text-error text-sm mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-base-content/70">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="link link-primary text-sm px-0">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-2 shadow-lg text-sm">
                            <span>{{ __('A new verification link has been sent to your email address.') }}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success font-medium">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
