<x-guest-layout>
    <x-slot name="title">
        Home
    </x-slot>

    <x-slot name="content">
            <form class="flex flex-col gap-1">
                <x-primary-button :formaction="route('login')"> Anmelden </x-primary-button>
                <x-secondary-button type="submit" :formaction="route('register')"> Registrieren </x-secondary-button>
            </form>
    </x-slot>
</x-guest-layout>
