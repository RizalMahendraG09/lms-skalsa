<x-app-layout>
    <x-slot name="header">
        {{ __('Profile') }}
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-error/20">
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
