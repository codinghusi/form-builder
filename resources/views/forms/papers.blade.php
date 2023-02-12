<x-app-layout>
    <x-slot name="title">
        {{ __('form.papers.header') }}
    </x-slot>

    <x-slot name="controls">
        <x-secondary-button tag="a" :href="route('dashboard')">
            Zurück
        </x-secondary-button>
        <x-secondary-button tag="a" :href="route('form.view', ['id' => $id])">
            Zum Formular
        </x-secondary-button>
        <x-create-button :href="route('paper.create', ['id' => $id])">
            {{__('paper.create.link')}}
        </x-create-button>
    </x-slot>

    <x-slot name="content">
        <ul class="list-none">
            @foreach ($papers as $paper)
                @include('papers.list-item', $paper)
            @endforeach
        </ul>
    </x-slot>
</x-app-layout>
