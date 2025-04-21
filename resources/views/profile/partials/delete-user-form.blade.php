<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Account löschen') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Beim Löschen deines Accounts gehen sämtliche Daten verloren.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Account löschen') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Bist du dir sicher, dass du deinen Account löschen möchtest?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Wenn dein Account einmal gelöscht ist, können die Daten nicht mehr wiederhergestellt werden. Bitte gib dein Passwort ein, um deinen Account endgültig zu löschen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Passwort') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Abbrechen') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Account endgültig löschen') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
