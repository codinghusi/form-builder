<x-app-layout>
    <x-slot name="title">
        {{ __('form.list') }}
    </x-slot>

    <x-slot name="controls">
        <a class="flex gap-1 rounded bg-green-700 px-4 py-2 pl-3 font-bold"
           href="{{ route('form.create') }}">
            @svg('uiw-plus-square-o', 'h-6 w-9')
            {{__('form.create.link')}}
        </a>
    </x-slot>

    <x-slot name="content">
        <ul class="list-none">
            @foreach ($forms as $form)
                @include('forms.list-item', $form)
            @endforeach
        </ul>
    </x-slot>
</x-app-layout>
