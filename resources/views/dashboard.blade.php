<x-app-layout>
    <x-slot name="title">
        {{ __('form.list') }}
    </x-slot>

    <x-slot name="controls">
        <x-create-button :href="route('form.create')">
            {{__('form.create.link')}}
        </x-create-button>
    </x-slot>

    <x-slot name="content">
        <ul class="list-none">
            @foreach ($forms as $form)
                @include('forms.list-item', $form)
            @endforeach
        </ul>
    </x-slot>
</x-app-layout>
