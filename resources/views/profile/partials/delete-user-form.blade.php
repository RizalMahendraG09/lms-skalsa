<section class="space-y-4">
    <header>
        <h2 class="text-lg font-semibold text-error">{{ __('Delete Account') }}</h2>
        <p class="mt-1 text-sm text-base-content/60">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn btn-error"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h3 class="text-lg font-semibold text-base-content">{{ __('Are you sure you want to delete your account?') }}</h3>
            <p class="mt-2 text-sm text-base-content/60">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="form-control mt-6">
                <label class="label" for="delete-password">
                    <span class="label-text">{{ __('Password') }}</span>
                </label>
                <input id="delete-password" name="password" type="password"
                    class="input input-bordered w-full @error('password', 'userDeletion') input-error @enderror"
                    placeholder="{{ __('Password') }}" />
                @error('password', 'userDeletion')
                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" class="btn btn-ghost" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="btn btn-error">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
