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
        <a class="flex gap-1 rounded bg-green-700 px-4 py-2 pl-3 font-bold"
           href="{{ route('paper.create', ['id' => $id]) }}">
            @svg('uiw-plus-square-o', 'h-6 w-9')
            {{__('paper.create.link')}}
        </a>
    </x-slot>

    <x-slot name="content">
        <ul class="list-none">
            @foreach ($papers as $paper)
                @include('papers.list-item', $paper)
            @endforeach
        </ul>
    </x-slot>
</x-app-layout>
