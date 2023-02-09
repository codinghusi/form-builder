<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <x-slot name="controls">
        <a class="flex gap-1 rounded bg-green-700 px-4 py-2 pl-3 font-bold"
           href="{{ route('entry.create.form') }}">
            @svg('uiw-plus-square-o', 'h-6 w-9')
            {{__('entry.create.link')}}
        </a>
    </x-slot>

    <x-slot name="content">
        <ul class="list-none">
            @foreach ($entries as $entry)
                @include('entries.list-item', $entry)
            @endforeach
        </ul>
    </x-slot>
</x-app-layout>
